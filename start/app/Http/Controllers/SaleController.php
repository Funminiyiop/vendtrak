<?php

namespace App\Http\Controllers;


use Auth, Session;
//use App\Models\Book;
//use App\Models\Cart;
//use App\Models\Sale;
use App\SalesRobot\Robot;
use App\SalesRobot\FormMan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SaleController extends Controller
{
    //use AuthenticatesUsers;
    // protected $redirectTo = '/home';

    public function selectCustomer(Request $request)
	{
        $robot = new Robot;
        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, Not Allowed!'); return back(); }
        if($request['customer'] === [] || $request['customer'] === null) {
			Session::flash('message', 'Please select a customer to proceed!'); return back();
		}

        // if no selected customer...
        if(Session::get('table.customer') === [] || Session::get('table.customer') === null) {
            Session::put('table.customer', $request->input('customer')); return back();
		}

        // if saved is same as selected
        if(Session::get('table.customer')  === $request->input('customer')) { return back(); }
        

        // if selected customer && not same as saved, 
        $getSavedCustomerCartDetails = $robot->getCartDetailsByAgentAndCustomer(Auth::user()->email, Session::get('table.customer'));
        //dd($getSavedCustomerCartDetails->toArray());
        //exit;
        if($getSavedCustomerCartDetails->toArray() === [] || $getSavedCustomerCartDetails->toArray() === null) {
            Session::put('table.customer', $request->input('customer')); 
            return back();
		}

        $deleteSavedCustomerCart = $robot->deleteCartDetailsByAgentAndCustomer(Auth::user()->email, Session::get('table.customer'));
        if($deleteSavedCustomerCart === 'unsuccessful'){ 
            Session::flash('message', 'Failed! We could not process your request'); return back();
        }
        Session::put('table.customer', $request->input('customer')); 
        return back();
    }
    
    
    public function addCart(Request $request)
	{
		$select = "Select";
        $robot = new Robot;
        $forman = new FormMan;

        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, Not Allowed!'); return back(); }
        
        if($request['customer'] === [] || $request['customer'] === null) {
			Session::flash('message', 'Please select a customer to proceed!'); return back();
		}

        if($request->input('bookQty') === null || $request->input('bookQty') === '0'){ 
            Session::flash('message', 'Please specify quantity!'); return back(); 
        }

        $inputItem = $request->input('bookID');
        $itemTitle = $robot->getBookDetailsByCode($request->input('bookID'))[0]->title;
        $cart = [	
            'agent' => $request->input('salesAgent'),
            'customer' => $request->input('customer'),
            'item' => $request->input('bookID'),
            'title' => $itemTitle,
            'qty' => (int) $request->input('bookQty'), // qty selected shows if exist in cart
            'price' => (int) $request->input('bookPrice'),
            'discount' => 0,
            'subtotal' => (int)$request->input('bookQty') * (int)$request->input('bookPrice'),
		];

		//Session::put('table.cartref', $cartRef);
		//Session::put('table.ref', $e);

        $cartDetails = $robot->getCartDetailsByAgentCustomerAndItem(Auth::user()->email, $request->input('customer'), $request->input('bookID'));
        
        // ----------  if cart is null, save new cart data
        if($cartDetails === null){ 
            $status = $robot->doSaveCart($cart);
            if($status === 'unsuccessful'){ Session::flash('message', 'Item not saved to cart'); return back();}
            Session::flash('message', 'Item saved to cart'); 
            //Session::put('table.customer', $request->input('customer')); 
            return back();
        }
        
        // --------  If cart not null, update cart with new item Qty and SubTotal
        $sameItemInCart = $robot->getCartItemByAgentCustomerAndItemID(Auth::user()->email, $request->input('customer'), $request->input('bookID'));
        
        $newQty = (int)$cart['qty'] + (int)$sameItemInCart[0]['qty'];
        $newSubTotal = $cart['price'] * $newQty;
        $cartUpdate = [	
            'qty' => (int) $newQty, 
            'subtotal' => (int)$newSubTotal,
		];
        
        $status = $robot->doCartUpdate(Auth::user()->email, $request->input('customer'), $request->input('bookID'), $cartUpdate);
        if($status === 'unsuccessful'){ Session::flash('message', 'Failure: Cart item update failed'); return back();}
        Session::flash('message', 'Successful: Cart item updated'); 
        //Session::put('table.customer', $request->input('customer')); 
        return back();
    }

    public function viewCart()
    {
        $robot = new Robot;
        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, Not Allowed!'); return back(); }
        
        $cusID = Session::get('table.customer');
        //Session::forget('table.ref');

        /*
        $cart = $robot->getCartDetailsByAgentAndCustomer(Auth::user()->email, $cusID)->toArray();
        $cartTotal = 0;
        foreach ($cart as $item) {
            $cartTotal += $item['subtotal'];
        }
        */
        
        return view('pages.cart.cart')
        //->withCart($cart)->withCartTotal($cartTotal)
        ;        
    }


    public function updateCart(Request $request)
    {
        $robot = new Robot;
        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, Not Allowed!'); return back(); }
		if($request->input('qty') === null) { Session::flash('message', 'Select quantity for your update'); return back(); }
        
        // Validate input, if fail, return back
        $checkPostRequestInput = $robot->validateCartUpdateRequest($request);
        if ($checkPostRequestInput->fails()) 
        {
            Session::flash('message', 'Qty fields nust be a number not less that 1.'); 
            return back(); 
        } 
        $cart = [	
            'qty' => (int) $request->input('qty'), 
            'item' => $request->input('item'),
            'customer' => $request->input('customer'),
		];

        $sameItemInCart = $robot->getCartItemByAgentCustomerAndItemID(Auth::user()->email, $request->input('customer'), $request->input('item'));
        if($sameItemInCart[0]['qty'] === $cart['qty']){ return back(); }
        $newQty = (int)$cart['qty'];
        $newSubTotal = $sameItemInCart[0]['price'] * $newQty;
        $cartUpdate = [	
            'qty' => (int) $newQty, 
            'subtotal' => (int)$newSubTotal,
		];
        
        $status = $robot->doCartUpdate(Auth::user()->email, $request->input('customer'), $request->input('item'), $cartUpdate);
        if($status === 'unsuccessful'){ Session::flash('message', 'Failure: Cart item update failed'); return redirect('/cart');}
        
        /*
        $cart = $robot->getCartDetailsByAgentAndCustomer(Auth::user()->email, $request->input('customer'))->toArray();
        $cartTotal = 0;
        foreach ($cart as $item) {
            $cartTotal += $item['subtotal'];
        }
        */
        Session::flash('message', 'Successful: Cart item updated'); 
        return redirect('/');
    }

    
    public function removeCartItem(Request $request)
    {
        $robot = new Robot;
        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, Not Allowed!'); return back(); }
        $cartItem = [	
            'agent' => $request->input('agent'), 
            'item' => $request->input('item'),
            'customer' => $request->input('customer'),
		];
        
        $sameItemInCart = $robot->getCartDetailsByAgentCustomerAndItem(Auth::user()->email, $request->input('customer'), $request->input('item'));

        if(
            $sameItemInCart['agent'] === Auth::user()->email &&
            $sameItemInCart['customer'] === $request->input('customer') &&
            $sameItemInCart['item'] === $request->input('item') ){ 
            // delete from cart.
            $status = $robot->doCartItemRemove(Auth::user()->email, $request->input('customer'), $request->input('item'));
            if($status === 'unsuccessful'){ Session::flash('message', 'Failure: Cart item removal failed'); return redirect('/cart');}
            Session::flash('message', 'Success: Cart item removed!'); return redirect('/'); 
        }
        Session::flash('message', 'Not Allowed!'); 
        return redirect('/cart');
    }

    public function checkout(Request $request)
    {
        $robot = new Robot;
        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, Not Allowed!'); return back(); }
        return view('pages.cart.checkout');  
    }


    public function postOrderRequest(Request $request)
	{
		//$select = "Select";
		//$choose = "Choose";
        $robot = new Robot;
        $forman = new FormMan;

        if(
            $request['customer'] === [] || $request['customer'] === null || 
            $request['agent'] === [] || $request['agent'] === null || 
            $request['paymentchoice'] === [] || $request['paymentchoice'] === null
        ) {
			Session::flash('message', 'Something went wrong, try again'); return back();
		}

        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, Not Allowed!'); return back(); }
        
		$checkOrderInput = $robot->validateOrderRequest($request);
		if ($checkOrderInput->fails()) 
		{
			Session::flash('message', 'Something went wrong, try again.');
			return back(); 
		} 
        // get cart details
        $cartDetails = $robot->getOrderDetailsByAgentAndCustomer(Auth::user()->email, $request['customer'])->toArray();
        $cartTotal = 0;
        foreach ($cartDetails as $item) {
            $cartTotal += $item['subtotal'];
        }
        
        $orderDetails = [	
            'tID' => 'VENDtrak'.Str::random(12),
            'agent' => Auth::user()->email,
            'customer' => $request->input('customer'), 
            'invoice' => $robot->generateInvoiceNo(),
            'items' => json_encode($cartDetails), 
            'date' => date("Y-m-d"),
            'status' => 'Not Shipped',
		];

        $invoiceDetails = [	
            'invoice' => $orderDetails['invoice'],
            'agent' => Auth::user()->email,
            'customer' => $request->input('customer'), 
            'tID' => $orderDetails['tID'],
            'total' => $cartTotal,
            'paychoice' => $request->input('paymentchoice'),
            'payment' => 'Unpaid',  
            'date' => date("Y-m-d"),
			'pay_amount' => 0,
		];

        //dd($request->toArray());
        //dd('VENDtrak'.Str::random(8));
        //dd($orderDetails['invoice']);
        //exit;

		DB::beginTransaction();
        try
        {
            $order = $robot->doNewOrderData($orderDetails);
            $invoice = $robot->doNewInvoiceData($invoiceDetails);
            
            // if payment choice is PAY NOW
            if($invoice['pay_option'] === 'paynow'){ 
                //$reg = $order['order_id'];
                //$paylink = 'http://localhost/websites/2024/alxProject/pay/'.$reg;
                //return redirect()->away($paylink); 
                Session::flash('message', 'Sorry! Our online payment is not available at the moment, please try again later.'); 
                return redirect('/');
            }
        
            // if payment option is PAY LATER
            $order->save();
            $invoice->save();
            // delete cart details
            $cartDelete = $robot->deleteCartDetailsByAgentAndCustomer(Auth::user()->email, $request['customer']);
            if($cartDelete === 'unsuccessful'){ 
                Session::flash('message', 'Failed! We could not process your order'); return redirect('/cart');
            }
            
            Session::flash('message', 'Success: Order placed successfully!');
            return redirect('/books');
        }
        catch(Exception $e)
        {
            DB::rollback(); 
	        return back();
        }
    }
    







    














    /**
     * Display a listing of the resource.
     */
    public function order(Request $request, $id)
    { 
        $robot = new Robot;
        $forman = new FormMan;
        $cc = $forman->FormInput($id);
        $verifyBook = $robot->doesBookExist($cc);
        $salesRep = $robot->checkAgentValidity(Auth::user()->email);
        if($verifyBook !== 'isValid' || $salesRep !== 'isValid' )
        {
            return redirect('/');
        }
        $BookID = $robot->getBookDetailsByCode($cc)[0];
        $RepID = $robot->getSalesRepDetailsByEmail(Auth::user()->email);
        $OrderID = $robot->generateTransactionID();
        $tempOrderData = [	
			'BookID' => $BookID,
			'RepID' => $RepID,
			'OrderID' => $OrderID,
		];
        
        // dd($tempOrderData);
        // exit;

        // Todo
        // Generate transaction id as OrderID   -- Done
        // Get RepID, BookID                    -- Done
        // Generate customer's details via a form -- BuyerID, Qty         
        // Sale Date, Supply Status
        // Agent place an order 
        return view('pages.order')->withTempOrderData($tempOrderData);
    }


















    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
