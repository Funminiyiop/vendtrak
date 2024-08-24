<?php namespace App\SalesRobot;

//use Mail;
use Session;
use Auth, DB;
use Validator;
use App\Models\User;
use App\Models\Cart;
use App\Models\Book;
use App\Models\Buyer;
use App\Models\Sale;
use App\Models\Invoice;
use App\Models\SalesRep;
use Illuminate\Support\Str;


use App\SalesRobot\FormMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


// use App\Score;
// use App\Shuffle;
// use App\Question;
// use App\User;
// use App\Bizpage;
// use App\Regpage;
// use App\Paidapplicant;
// use App\Salestraining;
// use App\Vacancyapplication;

class Robot
{
	// Protected Functions
    protected function gatePass()
    {	
        $mstadm = 901906;
        $adm = 203096;
		$rep = 202330;
		$au = Auth::user();

        if($au === null){ $accessLevel = 'notAllowed'; return $accessLevel; }
		if($au->level === 'null' || $au->level === '') { $accessLevel = 'notAllowed'; return $accessLevel; }
		if($au->level === $mstadm) { $accessLevel = 'MasterAdmin'; return $accessLevel; }
		if($au->level === $adm) { $accessLevel = 'Admin'; return $accessLevel; }
		if($au->level === $rep) { $accessLevel = 'SalesRep'; return $accessLevel; } 
    }
    	
	protected function checkCartDetails($email, $customer, $item)
	{
		$status = Cart::where('agent', $email)->where('customer', $customer)->where('item', $item)->first();
		return $status;
	}

	protected function existingItemInCartByItemID($email, $customer, $item)
	{
		$cart = Cart::where('agent', $email)->where('customer', $customer)->where('item', $item)
		->select('item', 'price', 'qty', 'discount', 'subtotal')
		->get()->toArray();
		return $cart;
	}

















	protected function checkUserStatusIfVeried($email)
	{
		$status = User::where('email', $email)->first();
		return $status;
	}

	protected function checkAgentIdentity($email)
	{
		$status = SalesRep::where('email', $email)->first();
		return $status;
	}
	
	/*
	protected function updateCart($email, $cartUpdate)
	{
		Cart::where('agent', $email)->update($cartUpdate);
	}


	*/
	
	protected function markBookAsDeleted($cc, $data)
	{
		Book::where('book_id', $cc)->update($data);
	}


	
	
	
	
	
	
	


	
	
	
	
	
	
	// Public Functions
	public function getAccessLevel()
    { 
		$level = $this->gatePass();
        return $level;
    }
	
	public function getAllBooks()
	{
		$books = DB::table('sys_books')->where('deleted', 0)->get()
		//->paginate(15)
		;
		return $books;
	}

	public function getInvoicesByAgent($agent)
	{
		$invoice = DB::table('sys_invoices')->where('rep_id', $agent)->get();
		return $invoice;
	}
	
	public function getInvoicesByAgentInvoice($agent, $invoice)
	{
		$invoice = DB::table('sys_invoices')->where('rep_id', $agent)->where('invoice_id', $invoice)->get();
		return $invoice;
	}
	
	public function getDetailedInvoicesByAgentCustomer($invoice, $agent, $customer)
	{
		$custDetails = $this->getCustomerDetailsByCustomerID($customer)[0]; 
		$invoiceDetails = $this->getInvoicesByAgentInvoice($agent, $invoice)->toArray()[0];
		//dd($custDetails->company);
		$getItemOrdered = $this->getSalesItemByInvoiceID($invoice, $agent, $customer)[0];
		$itemOrdered = json_decode($getItemOrdered->items, true);
		
        $detailedInvoice = [	
            'date' => date("Y-m-d"),
            'invoice' => $invoiceDetails->invoice_id,
            'status' => $invoiceDetails->status, 
            'customer_name' => $custDetails->company,
            'customer_email' => $custDetails->email,
            'customer_phone' => $custDetails->phone1 .' '. $custDetails->phone2,
            'customer_address' => $custDetails->h_no .', '. $custDetails->street .' Street, '. $custDetails->area1 .' '. $custDetails->area2,
			'customer_city' => $custDetails->city .', '. $custDetails->state .', '. $custDetails->country,
			'items' => $itemOrdered,
            'subtotal' => $invoiceDetails->subtotal,
            'vat' => $invoiceDetails->vat,
            'total' => $invoiceDetails->total, 
		];
		return $detailedInvoice;
	}
	
	
	public function getAllCustomers()
	{
		$customers = DB::table('sys_buyers')->where('deleted', 0)->get();
		return $customers;
	}

	public function doesBookExist($cc)
	{
		$book = DB::table('sys_books')->where('book_id', $cc)->where('deleted', 0)->get()->toArray();
		if($book === [] || $book === null) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}
	
	public function doesCustomerExistByEmail($cc)
	{
		$customer = DB::table('sys_buyers')->where('email', $cc)->where('deleted', 0)->get()->toArray();
		if($customer === [] || $customer === null) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}

	public function doesCustomerExistByID($cc)
	{
		$customer = DB::table('sys_buyers')->where('customer_id', $cc)->where('deleted', 0)->get()->toArray();
		if($customer === [] || $customer === null) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}

	public function getBookDetailsByCode($cc)
	{
		$book = DB::table('sys_books')->where('book_id', $cc)->where('deleted', 0)->get()->toArray();
		return $book;
	}
	
	public function getCustomerDetailsByCustomerID($cc)
	{
		$book = DB::table('sys_buyers')->where('customer_id', $cc)->where('deleted', 0)->get()->toArray();
		return $book;
	}

	public function getAllCustomersByAgentID($agentEmail)
	{
		$customers = DB::table('sys_buyers')->where('agent', $agentEmail)->where('deleted', 0)->get()->toArray();
		return $customers;
	}
	
	public function getSalesItemByTransID($transID)
	{
		$salesItem = DB::table('sys_sales')->where('order_id', $transID)->get()->toArray();
		return $salesItem;
	}
	
	public function getAllSalesByAgentID($agent)
	{
		$salesItem = DB::table('sys_sales')->where('rep_id', $agent)->get()->toArray();
		return $salesItem;
	}
	
	public function getAllSalesDetailsByAgentID($agent)
	{
		$sales = DB::table('sys_sales')->where('sys_sales.rep_id', $agent)
		->leftJoin('sys_buyers', 'sys_sales.buyer_id', '=', 'sys_buyers.customer_id')
		->join('sys_invoices', 'sys_sales.invoice_id', '=', 'sys_invoices.invoice_id')
		->select('sys_sales.*', 'sys_buyers.agent','sys_buyers.email','sys_buyers.customer_id','sys_buyers.company','sys_invoices.total')
		->get()->toArray();
		
		return $sales;
	}

	public function getSalesItemByInvoiceID($invoice, $agent, $customer)
	{
		$salesItem = DB::table('sys_sales')->where('invoice_id', $invoice)->where('rep_id', $agent)->where('buyer_id', $customer)->get()->toArray();
		return $salesItem;
	}


	function checkPostAnswer ($data1, $data2, $data3) 
	{ // $data1 = no1 (Que 1), $data2 = no2 (Que 2), $data3 = qna (Answer)
		$ans = $data1 + $data2;
		$answered = $data3;
		return intval($answered) === intval($ans);
	}

    public function getPostingEditBookData($request)
    {
		$p = date("Y-m-d"); 
        $forman = new FormMan;
		$BookID = $forman->FormInput($request->input('BookID'));
		$BookTitle = $forman->FormInput($request->input('BookTitle'));
		$BookAuthor = $forman->FormInput($request->input('BookAuthor'));
		$BookDescription = $forman->FormInput($request->input('BookDescription'));
		$BookGenre = $forman->FormInput($request->input('BookGenre'));
		$BookPrice = $request->input('BookPrice');
		$BookQty = $forman->FormInput($request->input('BookQty'));

		$data = 
		[	
			'book_id' => $BookID,
			'title' => $BookTitle,
			'author' => $BookAuthor,
			'description' => $BookDescription,
			'genre' => $BookGenre,
			'price' => $BookPrice,
			'availableQty' => $BookQty,
			'deleted' => 0,
			'deleted_by' => NULL,
			'deleted_date' => NULL,
			'updated_at' => date("Y-m-d H:i:s"),
		];
		return ($data);
	}

	public function doEditBookDetails($book, $bookID)
	{
		$action = Book::where('book_id', $bookID)->update( $book );
		if(! $action) {
			$status = 'unsuccessful';
		} else {
			$status = 'successful';
		}
		return $status;
	}

	public function doEditCustomerDetails($customer, $customerID)
	{
		$action = Buyer::where('customer_id', $customerID)->update( $customer );
		if(! $action) {
			$status = 'unsuccessful';
		} else {
			$status = 'successful';
		}
		return $status;

	}

    public function getPostingAddBookData($request)
    {
		$p = date("Y-m-d"); 
		$select = "Select";
		$choose = "Choose";
        $forman = new FormMan;
		$BookID = $forman->FormInput($request->input('BookID'));
		$BookTitle = $forman->FormInput($request->input('BookTitle'));
		$BookAuthor = $forman->FormInput($request->input('BookAuthor'));
		$BookDescription = $forman->FormInput($request->input('BookDescription'));
		$BookGenre = $forman->FormInput($request->input('BookGenre'));
		$BookPrice = $request->input('BookPrice');
		$BookQty = $forman->FormInput($request->input('BookQty'));
		$qna = $forman->FormInput($request->input('qna'));

		$data = 
		[	
			'book_id' => $BookID,
			'title' => $BookTitle,
			'author' => $BookAuthor,
			'description' => $BookDescription,
			'genre' => $BookGenre,
			'price' => $BookPrice,
			'availableQty' => $BookQty,
			'deleted' => 0,
			'deleted_by' => NULL,
			'deleted_date' => NULL,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		];
		return ($data);
	}
	
    public function getAddCustomerDetails($request, $agent)
    {
		$p = date("Y-m-d"); 
		$select = "Select";
		$choose = "Choose";
        $forman = new FormMan;
		//$h_no = $request->input('h_no');
		//$customerID = $forman->FormInput($request->input('customerID'));
		$company = $forman->FormInput($request->input('company'));
		$h_no = $forman->FormInput($request->input('h_no'));
		$street = $forman->FormInput($request->input('street'));
		$area1 = $forman->FormInput($request->input('area1'));
		$area2 = $forman->FormInput($request->input('area2'));
		$city = $forman->FormInput($request->input('city'));
		$state = $forman->FormInput($request->input('state'));
		$country = $forman->FormInput($request->input('country'));
		$email = $request->input('email');
		$phone1 = $forman->FormInput($request->input('phone1'));
		$phone2 = $forman->FormInput($request->input('phone2'));
		$cptitle = $forman->FormInput($request->input('cptitle'));
		$cpfname = $forman->FormInput($request->input('cpfname'));
		$cplname = $forman->FormInput($request->input('cplname'));
		$cpemail = $request->input('cpemail');
		$cpphone1 = $forman->FormInput($request->input('cpphone1'));
		$cpphone2 = $forman->FormInput($request->input('cpphone2'));
		
		$data = 
		[	
			'agent' => $agent,
			'email' => $email,
			'customer_id' => 'VENDtrak'.Str::random(8),
			'company' => $company,
			'h_no' => $h_no,
			'street' => $street,
			'area1' => $area1,
			'area2' => $area2,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'phone1' => $phone1,
			'phone2' => $phone2,
			'cptitle' => $cptitle,
			'cpfname' => $cpfname,
			'cplname' => $cplname,
			'cpemail' => $cpemail,
			'cpphone1' => $cpphone1,
			'cpphone2' => $cpphone2,			
			'deleted' => 0,
			'deleted_by' => NULL,
			'deleted_date' => NULL,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		];
		return ($data);
	}

	public function doSaveBook($book)
	{
		// add book details to cart column
		// DB::statement('ALTER TABLE carts ADD COLUMN `'.$book['book_id'].'` TEXT;');
		// DB::statement('ALTER TABLE carts ADD COLUMN `'.$book['book_id'].'_price'.'` DOUBLE;');
		// DB::statement('ALTER TABLE carts ADD COLUMN `'.$book['book_id'].'_discount'.'` DOUBLE;');
		// DB::statement('ALTER TABLE carts ADD COLUMN `'.$book['book_id'].'_sub_total'.'` DOUBLE;');
		// ALTER TABLE <table_name> DROP COLUMN <column_name>;
		
		$action = Book::insert( $book );
		if(! $action) {
			$status = 'unsuccessful';
		} else {
			$status = 'successful';
		}
		return $status;

	}

	public function doSaveCustomer($customerDetails)
	{
		$action = Buyer::insert( $customerDetails );
		if(! $action) {
			$status = 'unsuccessful';
		} else {
			$status = 'successful';
		}
		return $status;
	}

	public function doBookDeleteByBookID($cc, $data)
	{
		$action = Book::where('book_id', $cc)->update( $data );
	}
	
	public function doCustomerDeleteBycustomerID($cc, $data)
	{
		$action = Buyer::where('customer_id', $cc)->update( $data );
	}

	public function checkBookDeleteByBookID($cc)
	{
		$checkDelete = $this->checkDeletedBookDetailsByCode($cc)[0]->deleted;
		if($checkDelete === 1) {
			$status = 'isDeleted';
		} else {
			$status = 'notDeleted';
		}
		return $status;
	}

	public function checkCustomerDeleteByBookID($cc)
	{
		$checkDelete = $this->checkDeletedCustomerDetailsByCode($cc)[0]->deleted;
		if($checkDelete === 1) {
			$status = 'isDeleted';
		} else {
			$status = 'notDeleted';
		}
		return $status;
	}


	public function checkDeletedBookDetailsByCode($cc)
	{
		$book = DB::table('sys_books')->where('book_id', $cc)->get()->toArray();
		return $book;
	}
	
	public function checkDeletedCustomerDetailsByCode($cc)
	{
		$customer = DB::table('sys_buyers')->where('customer_id', $cc)->get()->toArray();
		return $customer;
	}
	
	
	public function validateBookAddingRequest(Request $request)
    {
        return $validator = Validator::make($request->all(), [
			// 'BookID' => 'required|string',
            'BookID' => ['required', 'string'],
            'BookTitle' => ['required', 'string'],
            'BookAuthor' => ['required', 'string'],
            'BookDescription' => ['required', 'string'],
            'BookGenre' => ['required', 'string'],
            'BookPrice' => ['required'],
            'BookQty' => ['required', 'numeric'],
            'qna' => ['required'],
			]
		);
    }

	public function validateCartUpdateRequest(Request $request)
    {
        return $validator = Validator::make($request->all(), [
            'qty' => ['required', 'numeric'],
			]
		);
    }

	public function validateCustomerRegistrationRequest(Request $request)
    {
		//dd($request->toArray());
		//exit;

        return $validator = Validator::make($request->all(), [
            'company' => ['required', 'string'],
			'h_no' => ['required', 'string'],
			'street' => ['required', 'string'],
			'area1' => ['required', 'string'],
			'city' => ['required', 'string'],
			'state' => ['required', 'string'],
			'country' => ['required', 'string'],
			'email' => ['required', 'email'],
			'phone1' => ['required', 'string'],
			'cptitle' => ['required', 'string'],
			'cpfname' => ['required', 'string'],
			'cplname' => ['required', 'string'],
			'cpemail' => ['required', 'email'],
			'cpphone1' => ['required', 'string'],
			'qna' => ['required', 'string'],
			]
		);
    }

	public function getCartDetailsByAgentCustomerAndItem($email, $customer, $item)
	{
		$agent = $this->checkCartDetails($email, $customer, $item);
		return $agent;
	}

	public function getCartDetailsByAgentAndCustomer($agentEmail, $customer)
	{
		$cartDetails = Cart::where('agent', $agentEmail)->where('customer', $customer)
		->select('agent', 'customer', 'item', 'title', 'qty', 'price', 'discount', 'subtotal')
		->get();
		return $cartDetails;
	}

	public function doSaveCart($cart)
	{
		$action = Cart::insert( $cart );
		if(! $action) {
			$status = 'unsuccessful';
		} else {
			$status = 'successful';
		}
		return $status;	
	}
	
	public function getCartItemByAgentCustomerAndItemID($email, $customer, $item)
	{
		$cartDetails = $this->existingItemInCartByItemID($email, $customer, $item);
		return $cartDetails;
	}

	public function doCartUpdate($email, $customer, $item, $cartUpdate)
	{
		$action = Cart::where('agent', $email)->where('customer', $customer)->where('item', $item)->update($cartUpdate);
		if(! $action) {
			$status = 'unsuccessful';
		} else {
			$status = 'successful';
		}
		return $status;
	}

	public function doCartItemRemove($email, $customer, $item)
	{
		$action = Cart::where('agent', $email)->where('customer', $customer)->where('item', $item)->delete();
		if(! $action) {
			$status = 'unsuccessful';
		} else {
			$status = 'successful';
		}
		return $status;
	}
	
	public function validateOrderRequest(Request $request)
    {
        return $validator = Validator::make($request->all(), [
			'paymentchoice' => 'required|string',
			'customer' => 'required|string',
			'agent' => 'required|email',
			]
		);
    }
	
	public function getOrderDetailsByAgentAndCustomer($agentEmail, $customer)
	{
		$cartDetails = Cart::where('agent', $agentEmail)->where('customer', $customer)
		->select('item', 'title', 'qty', 'price', 'subtotal')
		->get();
		return $cartDetails;
	}

	public function generateInvoiceNo()
	{
		$day = date("md"); 
		$time = date("Gis"); 
		$characters1 = '123456789';
		$charactersLength1 = strlen($characters1);
		$code1 = '';
		for ($i = 0; $i < 8; $i++) {
			$code1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$invoiceNo = $day.$code1;//'VENDtrak'.Str::random(8)
		return $invoiceNo;
	}

	public function doNewOrderData(array $data)
    {
        $neworder = new Sale;
        $neworder->order_id = $data['tID'];
        $neworder->rep_id = $data['agent'];
        $neworder->buyer_id = $data['customer'];
        $neworder->invoice_id = $data['invoice'];
		$neworder->items = $data['items'];
        $neworder->sales_date = $data['date'];
        $neworder->status = $data['status'];
        $neworder->created_at = $data['date'];
        return $neworder;
	}

	public function doNewInvoiceData(array $data)
    {
        $newinvoice = new Invoice;
        $newinvoice->invoice_id = $data['invoice'];
        $newinvoice->rep_id = $data['agent'];
        $newinvoice->buyer_id = $data['customer'];
        $newinvoice->order_id = $data['tID'];
        $newinvoice->subtotal = $data['subtotal'];
        $newinvoice->vat = $data['vat'];
        $newinvoice->total = $data['total'];
        $newinvoice->pay_option = $data['paychoice'];
        $newinvoice->status = $data['payment'];
        $newinvoice->invoice_date = $data['date'];
        $newinvoice->pay_amount = $data['pay_amount'];
        $newinvoice->created_at = $data['date'];
        return $newinvoice;
	}

	public function deleteCartDetailsByAgentAndCustomer($agentEmail, $customer)
	{
		$action = Cart::where('agent', $agentEmail)->where('customer', $customer)->delete();
		if(! $action) {
			$status = 'unsuccessful';
		} else {
			$status = 'successful';
		}
		return $status;
	}


























































































	public function generateTransactionID()
	{
		$day = date("ynj"); 
		$time = date("Gis"); 
		$characters1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$code1 = '';
		for ($i = 0; $i < 3; $i++) {
			$code1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$characters2 = '123456789';
		$charactersLength2 = strlen($characters2);
		$code2 = '';
		for ($i = 0; $i < 3; $i++) {
			$code2 .= $characters2[rand(0, $charactersLength2 - 1)];
		}
		$transaction_id = 'Order'.$code2.$day.'VENDtrak'.Str::random(8).$code1.$time;
		return $transaction_id;
	}



	// Book Functions
	public function checkUserIfVeried($email)
	{
		return $this->checkUserStatusIfVeried($email);
	}

	public function checkUserIfExist($email)
	{
		$check = $this->checkUserStatusIfVeried($email);
		if($check === [] || $check === null) { $status = 'No'; } else { $status = 'Yes'; }
		return $status;
	}
	

	public function updateNewUserEmailToken($email, $emailtoken)
	{
		User::where('email', $email)->update($emailtoken);
	}



	
	public function checkAgentValidity($email)
	{
		$user = $this->checkUserStatusIfVeried($email)->toArray();
		$agent = $this->checkAgentIdentity($email)->toArray();
		
		if($user['email'] != $agent['email']) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}
	
	public function getSalesRepDetailsByEmail($email)
	{
		$agent = $this->checkAgentIdentity($email)->toArray();
		return $agent;
	}
	
	

	public function verifyExistingItemInCartByItemID($email, $itemID)
	{
		// $checker = $this->existingItemInCartByItemID($email, $itemID)[0][$itemID];
		$checker = $this->existingItemInCartByItemID($email, $itemID);
		if($checker === null || $checker === ""){ 
			$status = 'invalid'; 
		} else {
			$status = 'valid'; 
		}
		return $status;
	}






	
	
	
	
	

	






	function TestTestcheckPhoneCount($phone) 
	{
        $forman = new FormMan;
		$number = $forman->FormInput($phone);
		if(strlen($number) <> 11) { $status = 'false'; }
		if(strlen($number) === 11) { $status = 'true'; }
		return $status;
	}
	public function TestTestdoNewApplicantData(array $data)
    {
        $newuser = new Applicant;
        $newuser->datetime =  date("Y-m-d");
        $newuser->reg_type = $data['reg_type'];
        $newuser->reg_id = $data['reg_id'];
		$newuser->course = $data['course'];
        $newuser->amount = $data['amount'];
        $newuser->paid = $data['paid'];
        $newuser->fname = $data['fname'];
        $newuser->lname = $data['lname'];
		$newuser->onames = $data['onames'];
        $newuser->identity_document = $data['identity_document'];
        $newuser->document_number = $data['document_number'];
        $newuser->document_issued_date = $data['document_issued_date'];
        $newuser->marital_status = $data['marital_status'];
		$newuser->gender = $data['gender'];
        $newuser->dob = $data['dob'];
        $newuser->nationality = $data['nationality'];
        $newuser->sailor = $data['sailor'];
		$newuser->rank = $data['rank'];
        $newuser->houseno = $data['houseno'];
        $newuser->streetname = $data['streetname'];
        $newuser->area = $data['area'];
        $newuser->city = $data['city'];
        $newuser->state = $data['state'];
        $newuser->country = $data['country'];
        $newuser->email = $data['email'];
        $newuser->phone1 = $data['phone1'];
        $newuser->phone2 = $data['phone2'];
        $newuser->education_qulification = $data['education_qulification'];
        $newuser->year = $data['year'];
        $newuser->institution = $data['institution'];
        $newuser->emergency_name = $data['emergency_name'];
        $newuser->emergency_phone = $data['emergency_phone'];
        $newuser->emergency_relationship = $data['emergency_relationship'];
        return $newuser;
	}

	// =========== 



	

    public function getCourseRegistrationData($request)
    {
		$p = date("Y-m-d"); 
		$select = "Select";
		$choose = "Choose";
        $forman = new FormMan;
		$BookTitle = $forman->FormInput($request->input('BookTitle'));
		$BookID = $forman->FormInput($request->input('BookID'));
		$BookAuthor = $forman->FormInput($request->input('BookAuthor'));
		$BookPrice = $request->input('BookPrice');
		$BookQty = $forman->FormInput($request->input('BookQty'));
		$salesRepName = $forman->FormInput($request->input('salesRepName'));
		$RepID = $request->input('RepID');
		$companyName = $forman->FormInput($request->input('companyName'));
		$customerHouseNo = $forman->FormInput($request->input('customerHouseNo'));
		$customerStreetName = $forman->FormInput($request->input('customerStreetName'));
		$customerArea1 = $forman->FormInput($request->input('customerArea1'));
		$customerArea2 = $forman->FormInput($request->input('customerArea2'));
		$customerCity = $forman->FormInput($request->input('customerCity'));
		$customerState = $forman->FormInput($request->input('customerState'));
		$customerCountry = $forman->FormInput($request->input('customerCountry'));
		$customerEmail = $request->input('customerEmail');
		$customerWebsite = $request->input('customerWebsite');
		$customerPhone1 = $forman->FormInput($request->input('customerPhone1'));
		$customerPhone2 = $forman->FormInput($request->input('customerPhone2'));
		$customerContactPersonName = $forman->FormInput($request->input('customerContactPersonName'));
		$customerContactPersonPhone1 = $forman->FormInput($request->input('customerContactPersonPhone1'));
		$customerContactPersonPhone2 = $forman->FormInput($request->input('customerContactPersonPhone2'));
		$qna = $forman->FormInput($request->input('qna'));

		$data = 
		[	
			'reg_type' => 'New',
			'datetime' => $p,
			'reg_id' => $this->generateRegistrationID(),
			'course' => $course,
			'amount' => $amount,
		];
		return ($data);
	}













	protected function packLoginData($fname, $email, $password)
	{
		$data = [	
			'name' => $fname,
			'email' => $email,
			'password' => $password,
		];
		return $data; 
	}
	
    protected function validateLoginDetails(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

	protected function checkOnlineTrackRegCodeByEmail ($regcode, $email)
	{
		$code = Onlinetrackapplicant::where('reg_id', $regcode)->where('email', $email)->first();
		return $code;
	}

	protected function getPaidOnlineTrackUserDetailsByEmail ($email)
	{
		$POTUser = Onlinetrackpaidapplicant::where('email', $email)->first();
		return $POTUser;
	}
	
	
	protected function checkUserDetailsByEmail($email)
	{
		$applicantInfo = Onlinetrackpaidcourse::where('email', $email)->first();
		return $applicantInfo;
	}
	
	protected function checkUserScoreDetailsByEmail($email)
	{
		$applicantScore = Onlinetrackpaidapplicantsscore::where('email', $email)->first();
		return $applicantScore;
	}
	
	protected function insertDefaultUserShuffledAccount($email)
	{
		$data = ['email' => $email,];
		Onlinetrackquestionshuffle::insert($data);
	}
	
	protected function checkUserQuestionShuffleDetailsByEmail($email)
	{
		$shuffleDetails = Onlinetrackquestionshuffle::where('email', $email)->first();
		return $shuffleDetails;
	}

	protected function insertDefaultUserScoreAccount($email)
	{
		$data = ['email' => $email,];
		Onlinetrackpaidapplicantsscore::insert($data);
	}
	
	protected function insertAndPopulateUserWith20RandomShuffledQuestionsNumbers($email, $course, $shuffled)
	{
		$checkShuffle = $this->checkUserQuestionShuffleDetailsByEmailandCourse($email, $course);
		$ids = array_keys($checkShuffle[0]);
		$shuffledDAta = array_combine($ids, $shuffled);
		Onlinetrackquestionshuffle::where('email', $email)->update(
			$shuffledDAta
		);
	}

	protected function doPopulateScoreRecordForUser($email, $score_data)
	{
		Onlinetrackpaidapplicantsscore::where('email', $email)->update(
			$score_data
		);
	}
	
	protected function checkUserQuestionShuffleDetailsByEmailandCourse($email, $course)
	{
		$check = Onlinetrackquestionshuffle::where('email', $email)->select(''.$course.'_1', ''.$course.'_2', ''.$course.'_3', ''.$course.'_4', ''.$course.'_5', ''.$course.'_6', ''.$course.'_7', ''.$course.'_8', ''.$course.'_9', ''.$course.'_10', ''.$course.'_11', ''.$course.'_12', ''.$course.'_13', ''.$course.'_14', ''.$course.'_15', ''.$course.'_16', ''.$course.'_17', ''.$course.'_18', ''.$course.'_19', ''.$course.'_20')->get()->toArray();
		return $check;
	}

	protected function checkUserCourseAttemptExitByEmail($email, $course)
	{
		$check = Onlinetrackpaidapplicantsscore::where('email', $email)->select(''.$course.'_exi')->get()->toArray();
		return $check;
	}

	protected function checkUsersCourseScoreDetailsByEmailandCourse($email, $course)
	{
		$check = Onlinetrackpaidapplicantsscore::where('email', $email)->select(''.$course.'_ans', ''.$course.'_1', ''.$course.'_2', ''.$course.'_3', ''.$course.'_4', ''.$course.'_5', ''.$course.'_6', ''.$course.'_7', ''.$course.'_8', ''.$course.'_9', ''.$course.'_10', ''.$course.'_11', ''.$course.'_12', ''.$course.'_13', ''.$course.'_14', ''.$course.'_15', ''.$course.'_16', ''.$course.'_17', ''.$course.'_18', ''.$course.'_19', ''.$course.'_20')->get()->toArray();
		return $check;
	}

	protected function checkCourseQuestionNumberForUser($email, $course, $number)
	{
		$checkDefault = Onlinetrackpaidapplicantsscore::where('email', $email)->select(''.$course.'_1', ''.$course.'_2', ''.$course.'_3', ''.$course.'_4', ''.$course.'_5', ''.$course.'_6', ''.$course.'_7', ''.$course.'_8', ''.$course.'_9', ''.$course.'_10', ''.$course.'_11', ''.$course.'_12', ''.$course.'_13', ''.$course.'_14', ''.$course.'_15', ''.$course.'_16', ''.$course.'_17', ''.$course.'_18', ''.$course.'_19', ''.$course.'_20')->get()->toArray()[0];
		$number1 = 1; $number2 = 2; $number3 = 3; $number4 = 4; $number5 = 5; $number6 = 6; $number7 = 7; $number8 = 8; $number9 = 9; $number10 = 10;	$number11 = 11; $number12 = 12; $number13 = 13; $number14 = 14; $number15 = 15; $number16 = 16; $number17 = 17; $number18 = 18; $number19 = 19; $number20 = 20;
		if($checkDefault[''.$course.'_'.$number1.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number1, ];
		} elseif($checkDefault[''.$course.'_'.$number2.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number2, ];
		} elseif($checkDefault[''.$course.'_'.$number3.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number3, ];
		} elseif($checkDefault[''.$course.'_'.$number4.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number4, ];
		} elseif($checkDefault[''.$course.'_'.$number5.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number5, ];
		} elseif($checkDefault[''.$course.'_'.$number6.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number6, ];
		} elseif($checkDefault[''.$course.'_'.$number7.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number7, ];
		} elseif($checkDefault[''.$course.'_'.$number8.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number8, ];
		} elseif($checkDefault[''.$course.'_'.$number9.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number9, ];
		} elseif($checkDefault[''.$course.'_'.$number10.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number10, ];
		} elseif($checkDefault[''.$course.'_'.$number11.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number11, ];
		} elseif($checkDefault[''.$course.'_'.$number12.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number12, ];
		} elseif($checkDefault[''.$course.'_'.$number13.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number13, ];
		} elseif($checkDefault[''.$course.'_'.$number14.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number14, ];
		} elseif($checkDefault[''.$course.'_'.$number15.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number15, ];
		} elseif($checkDefault[''.$course.'_'.$number16.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number16, ];
		} elseif($checkDefault[''.$course.'_'.$number17.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number17, ];
		} elseif($checkDefault[''.$course.'_'.$number18.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number18, ];
		} elseif($checkDefault[''.$course.'_'.$number19.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number19, ];
		} elseif($checkDefault[''.$course.'_'.$number20.''] === 0) {
			$data = [ 'Attempt_Status' => 'No', 'questionNumber' => $number20, ];
		} else {
			$data = [ 'Attempt_Status' => 'Yes', 'questionNumber' => $number20, ];
		}
		return $data;
	}


	// Update this code-block with other courses later
	// with the courses in Onlinetrackcourses table. 
	protected function checkOnlineTrackCourseByEmail($regcode, $email)
	{	
		$course = Onlinetrackapplicant::where('reg_id', $regcode)->where('email', $email)->first()->course;
		if($course === 'Crew Security Awareness with Designated Duties') {
			$result = 'csa';
		}
		if($course === 'Company Security Officer') {
			$result = 'cso';
		}
		if($course === 'Ship Security Officer') {
			$result = 'sso';
		}
		if($course === 'Port Facility Security Officer') {
			$result = 'pfso';
		}
		if($course === 'Maritime Security Awareness') {
			$result = 'msa';
		}
		return $result;
	}

	protected function getAllPaidCourses($email)
	{
		$applicantInfo = $this->checkUserDetailsByEmail($email);
		// $applicantInfo = Onlinetrackpaidcourse::where('email', $email)->first();
		$paid = 1; $unpaid = 0;
		
		$csa = ($applicantInfo->csa_pay_status === 'Paid') ? 1 : 0;
		$cso = ($applicantInfo->cso_pay_status === 'Paid') ? 1 : 0;
		$msa = ($applicantInfo->msa_pay_status === 'Paid') ? 1 : 0;
		$pfso = ($applicantInfo->pfso_pay_status === 'Paid') ? 1 : 0;
		$sso = ($applicantInfo->sso_pay_status === 'Paid') ? 1 : 0;
		$data = [	
			'pcsa' => $csa,
			'pcso' => $cso,
			'pmsa' => $msa,
			'ppfso' => $pfso,
			'psso' => $sso,
		];
		return $data;
	}

	protected function getCourseScoreHintsFOrUserByEmail($email, $applicantScore)
	{
		$coret = 2;
		$allScoreCSA = array_values($this->checkUsersCourseScoreDetailsByEmailandCourse($email, 'csa'));
		$allScoreCSO = array_values($this->checkUsersCourseScoreDetailsByEmailandCourse($email, 'cso'));
		$allScoreMSA = array_values($this->checkUsersCourseScoreDetailsByEmailandCourse($email, 'msa'));
		$allScorePFSO = array_values($this->checkUsersCourseScoreDetailsByEmailandCourse($email, 'pfso'));
		$allScoreSSO = array_values($this->checkUsersCourseScoreDetailsByEmailandCourse($email, 'sso'));

		$coretScoreCSA = (in_array($coret, $allScoreCSA[0])) ? $coretCSA = array_count_values($allScoreCSA[0])[$coret] : $coretCSA = 0;
		$coretScoreCSO = (in_array($coret, $allScoreCSO[0])) ? $coretCSO = array_count_values($allScoreCSO[0])[$coret] : $coretCSO = 0;
		$coretScoreMSA = (in_array($coret, $allScoreMSA[0])) ? $coretMSA = array_count_values($allScoreMSA[0])[$coret] : $coretMSA = 0;
		$coretScorePFSO = (in_array($coret, $allScorePFSO[0])) ? $coretPFSO = array_count_values($allScorePFSO[0])[$coret] : $coretPFSO = 0;
		$coretScoreSSO = (in_array($coret, $allScoreSSO[0])) ? $coretSSO = array_count_values($allScoreSSO[0])[$coret] : $coretSSO = 0;
		
		$score = [	
			'all' => $finish = 20,
			'csa' => $applicantScore->csa_ans, 
			'csa_correct' => $coretScoreCSA,
			'cso' => $applicantScore->cso_ans,
			'cso_correct' => $coretScoreCSO,
			'msa' => $applicantScore->msa_ans, 
			'msa_correct' => $coretScoreMSA,
			'pfso' => $applicantScore->pfso_ans, 
			'pfso_correct' => $coretScorePFSO,
			'sso' => $applicantScore->sso_ans,
			'sso_correct' => $coretScoreSSO, 
		];
		return $score;
	}




	// PUBLIC FUNCTIONS FOR ONLINE COURSES ...................
	
	function checkEmailFormat($anemail) 
	{
		$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
		return (bool)preg_match($pattern, $anemail);
	}

	function checkPhoneCount($phone) 
	{
        $forman = new FormMan;
		$number = $forman->FormInput($phone);
		if(strlen($number) <> 11) { $status = 'false'; }
		if(strlen($number) === 11) { $status = 'true'; }
		return $status;
	}
	
	public function doesOnlineTrackCourseExist($cc)
	{
		$c = 'y';
		$course = Onlinetrackcourse::where('status', $c)->where('code', $cc)->get()->toArray();
		if($course === [] || $course === null) { $status = 'notValid'; } else { $status = 'isValid'; }
		return $status;
	}
	
	public function getOnlineCourseByCourseCode($cc)
	{
		$c = 'y'; 
		$course = Onlinetrackcourse::where('status', $c)->where('code', $cc)->get()->toArray();
		return $course;
	}
	
	public function checkIfEmailAlreadyExistAsUser($email)
	{
		$check = User::where('email', $email)->first();
		if($check === [] || $check === null) { $status = 'No'; } else { $status = 'Yes'; }
		return $status;
	}

	public function checkIfEmailAlreadyExistAsUnpaidUser($email)
	{
		$check = Onlinetrackapplicant::where('email', $email)->first();
		if($check === [] || $check === null) { $status = 'No'; } else { $status = 'Yes'; }
		return $status;
	}

	public function createPaidOnlineTrackRegistrationData($email, $coss, $userDetails)
	{
		return $registrationData = [	
			'datetime' => date("Y-m-d"),
			'reg_id' => 'ONLINETrack'.Str::random(15),
			'duetime' => date("Y-m-d H:i:s", strtotime('+24 hours')),
			'course' => $coss->course,
			'amount' => $coss->cost,
			'paid' => 'No',
			'fname' => $userDetails->fname,
			'lname' => $userDetails->lname,
			'onames' => $userDetails->onames,
			'phone1' => $userDetails->phone1,
			'phone2' => $userDetails->phone2,
			'email' => $email,
		];
	}

	public function doNewPaidOnlineTrackApplicantData(array $data)
    {		
		$newuser = new Onlinetrackapplicant;
        $newuser->datetime =  date("Y-m-d");
        $newuser->reg_id = $data['reg_id'];
        $newuser->reg_type = 'Online Track';
		$newuser->course = $data['course'];
        $newuser->amount = $data['amount'];
        $newuser->duetime = $data['duetime']; // date("Y-m-d H:i:s", strtotime('+24 hours'));
        $newuser->paid = $data['paid'];
        $newuser->fname = $data['fname'];
        $newuser->lname = $data['lname'];
		$newuser->onames = $data['onames'];		
        $newuser->email = $data['email'];
        $newuser->phone1 = $data['phone1'];
        $newuser->phone2 = $data['phone2'];
        return $newuser;
	}
	
	public function validateOnlineaTrackCourseRegistration(Request $request)
    {
        return $validator = Validator::make($request->all(), [
			'captcha' => 'required|captcha',
			'fname' => 'required|string',
			'lname' => 'required|string',
			'identity_document' => 'required|string',
			'document_number' => 'required|string',
			'document_issued_date' => 'required|date',
			'marital_status' => 'required|string',
			'gender' => 'required|string',
			'dob' => 'required|date',
			'nationality' => 'required|string',
			'houseno' => 'required|string',
			'streetname' => 'required|string',
			'area' => 'required|string',
			'city' => 'required|string',
			'state' => 'required|string',
			'country' => 'required|string',
			'email' => 'required|email',
			'phone1' => 'required|string',
			'emergency_name' => 'required|string',
			'emergency_phone' => 'required|string',
			'emergency_relationship' => 'required|string',
			'declare' => 'required',
			'course' => 'required|string',
			'amount' => 'required',
			]
		);
    }

    public function getOnlineCourseRegistrationData($request)
    {
		$p = date("Y-m-d"); $select = "Select"; $choose = "Choose"; $forman = new FormMan;
		$fname = $forman->FormInput($request->input('fname')) ;
		$lname = $forman->FormInput($request->input('lname')) ;
		$onames = $forman->FormInput($request->input('onames')) ;
		$identity_document = $forman->FormInput($request->input('identity_document')) ;
		$document_number = $forman->FormInput($request->input('document_number')) ;
		$document_issued_date = $forman->FormInput($request->input('document_issued_date')) ;
		$marital_status = $forman->FormInput($request->input('marital_status')) ;
		$gender = $forman->FormInput($request->input('gender')) ;
		$dob = $forman->FormInput($request->input('dob')) ;
		$nationality = $forman->FormInput($request->input('nationality')) ;
		$sailor = $forman->FormInput($request->input('sailor')) ;
		$rank = $forman->FormInput($request->input('rank')) ;
		$houseno = $forman->FormInput($request->input('houseno')) ;
		$streetname = $forman->FormInput($request->input('streetname')) ;
		$area = $forman->FormInput($request->input('area')) ;
		$city = $forman->FormInput($request->input('city')) ;
		$state = $forman->FormInput($request->input('state')) ;
		$country = $forman->FormInput($request->input('country')) ;
		$email = $request->input('email');
		$phone1 = $forman->FormInput($request->input('phone1')) ;
		$phone2 = $forman->FormInput($request->input('phone2')) ;
		$loginemail = $request->input('loginemail');
		$password = $request->input('password');
		$password_confirmation = $request->input('password_confirmation');
		$education_qulification = $forman->FormInput($request->input('education_qulification')) ;
		$year = $forman->FormInput($request->input('year')) ;
		$institution = $forman->FormInput($request->input('institution')) ;
		$emergency_name = $forman->FormInput($request->input('emergency_name')) ;
		$emergency_phone = $forman->FormInput($request->input('emergency_phone')) ;
		$emergency_relationship = $forman->FormInput($request->input('emergency_relationship'));
		$course = $forman->FormInput($request->input('course')) ;
		$amount = $request->input('amount') ;
		
		$data = 
		[	
			'datetime' => $p,
			// 'reg_id' => $this->generateRegistrationID(),
			'reg_id' => 'ONLINETrack'.Str::random(15),
			'duetime' => date("Y-m-d H:i:s", strtotime('+24 hours')),
			'course' => $course,
			'amount' => $amount,
			'paid' => 'No',
			'fname' => $fname,
			'lname' => $lname,
			'onames' => $onames,
			'identity_document' => $identity_document,
			'document_number' => $document_number,
			'document_issued_date' => $document_issued_date,
			'marital_status' => $marital_status,
			'gender' => $gender,
			'dob' => $dob,
			'nationality' => $nationality,
			'sailor' => $sailor,
			'rank' => $rank,
			'houseno' => $houseno,
			'streetname' => $streetname,
			'area' => $area,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'email' => $email,
			'phone1' => $phone1,
			'phone2' => $phone2,
			'loginemail' => $loginemail,
			'password' => $password,
			'password_confirmation' => $password_confirmation,
			'education_qulification' => $education_qulification,
			'year' => $year,
			'institution' => $institution,
			'emergency_name' => $emergency_name,
			'emergency_phone' => $emergency_phone,
			'emergency_relationship' => $emergency_relationship,
		];
		return ($data);
	}

	public function createValidateLoginData($fname, $email, $password)
	{
		$data = $this->packLoginData($fname, $email, $password); 
		$dovalidate = $this->validateLoginDetails($data);
        if ($dovalidate->fails()) { $status = 'notAccepted'; }else { $status = 'accepted'; }
		return $status; 
	}

	public function doNewOnlineTrackApplicantData(array $data)
    {
		$newuser = new Onlinetrackapplicant;
        $newuser->datetime =  date("Y-m-d");
        $newuser->reg_id = $data['reg_id'];
        $newuser->reg_type = 'Online Track';
		$newuser->course = $data['course'];
        $newuser->amount = $data['amount'];
        $newuser->duetime = $data['duetime']; // date("Y-m-d H:i:s", strtotime('+24 hours'));
        $newuser->paid = $data['paid'];
        $newuser->fname = $data['fname'];
        $newuser->lname = $data['lname'];
		$newuser->onames = $data['onames'];
        $newuser->identity_document = $data['identity_document'];
        $newuser->document_number = $data['document_number'];
        $newuser->document_issued_date = $data['document_issued_date'];
        $newuser->marital_status = $data['marital_status'];
		$newuser->gender = $data['gender'];
        $newuser->dob = $data['dob'];
        $newuser->nationality = $data['nationality'];
        $newuser->sailor = $data['sailor'];
		$newuser->rank = $data['rank'];
        $newuser->houseno = $data['houseno'];
        $newuser->streetname = $data['streetname'];
        $newuser->area = $data['area'];
        $newuser->city = $data['city'];
        $newuser->state = $data['state'];
        $newuser->country = $data['country'];
        $newuser->email = $data['email'];
        $newuser->phone1 = $data['phone1'];
        $newuser->phone2 = $data['phone2'];
        $newuser->loginemail = $data['loginemail'];
        $newuser->password = $data['password'];
        $newuser->education_qulification = $data['education_qulification'];
        $newuser->year = $data['year'];
        $newuser->institution = $data['institution'];
        $newuser->emergency_name = $data['emergency_name'];
        $newuser->emergency_phone = $data['emergency_phone'];
        $newuser->emergency_relationship = $data['emergency_relationship'];
        return $newuser;
	}
	
	public function doesOnlineTrackRegIDExist($reg)
	{
		$id = Onlinetrackapplicant::where('reg_id', $reg)->first();
		if($id === [] || $id === null) { $status = 'notValid'; } else { $status = 'isValid'; }
		return $status; 
	}

	public function getOnlineTrackApplicantionDetail($reg)
	{
		$details = Onlinetrackapplicant::where('reg_id', $reg)->first();
		return $details;
	}

	public function convertAmountToKobo($amt)
	{
		$amount = $amt;
		$amount = (int) preg_replace('/\,/', '', $amt);
		return $amount * 100;
	}
	


















	public function getPaidOnlineTrackUserDetails($email)
	{
		$details = $this->getPaidOnlineTrackUserDetailsByEmail($email); 
		return $details; 
	}


	public function getOnlineCourseByCourseCodeFirst($cc)
	{
		$c = 'y'; 
		$course = Onlinetrackcourse::where('status', $c)->where('code', $cc)->first();
		return $course;
	}

	
	
	
	public function createLoginData($fname, $email, $password)
	{
		$data = $this->packLoginData($fname, $email, $password); 
		$dovalidate = $this->validateLoginDetails($data);
        if ($dovalidate->fails()) {
            $status = 'error';
        }else {
			$login = new Onlinetracklogindata;
			$login->name = $data['name'];
			$login->email = $data['email'];
			$login->password = $data['password'];
			$login->save();
			$status = $data;
		}
		return $status; 
	}
	
	
	public function deleteLoginData($email)
	{
		$data = Onlinetracklogindata::where('email', $email)->delete();
	}

	
	

	public function getOnlineTrackApplicantionDetailToArray($reg)
	{
		$details = Onlinetrackapplicant::where('reg_id', $reg)->first()->toArray();
		return $details;
	}
	
	public function checkIfOnlineTrackRegCodeExist ($regcode, $email)
	{
		$code = $this->checkOnlineTrackRegCodeByEmail($regcode, $email);
		if($code === [] || $code === null) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}
	
	public function checkIfOnlineTrackRegIsOver24Hrs ($regcode, $email)
	{
		$code = $this->checkOnlineTrackRegCodeByEmail($regcode, $email);
		// check if not more than 24hrs
		$dueTime = $code['duetime'];
		$den = strtotime($dueTime);
		$w = date("Y-m-d H:i:s");
		$now = strtotime($w);
		$ro = round(abs($den - $now) / 60,2);
		$registration = $ro / 60;
		if($registration > 24) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}

	/*
	public function checkPreviousPaymentForSameOnlineTrackCourse($regcode, $email)
	{	
		$courseApplied = $this->createAppliedCourseKeys($regcode, $email);
		$yes = 'Yes';
		$paid = 'Paid';
		$unpaid = 'Unpaid';
		$checkPayment = Onlinetrackpaidcourse::where('email', $email)->where($data['pay_status'], $paid)->first();
		if($checkPayment === [] || $checkPayment === null) {
			$status = 'notPaid';
		} else {
			$status = 'hasPaid';
		}
		return $status;
	}
	*/
	
	public function createOnlineTrackPaidApplicantData ($regcode, $email)
	{
		$link = $this->checkOnlineTrackRegCodeByEmail($regcode, $email);
		$data = 
		[	
			'reference' => Str::random(15),
			'fname' => $link['fname'],
			'lname' => $link['lname'],
			'onames' => $link['onames'],
			'identity_document' => $link['identity_document'],
			'document_number' => $link['document_number'],
			'document_issued_date' => $link['document_issued_date'],
			'marital_status' => $link['marital_status'],
			'gender' => $link['gender'],
			'dob' => $link['dob'],
			'nationality' => $link['nationality'],
			'sailor' => $link['sailor'],
			'rank' => $link['rank'],
			'houseno' => $link['houseno'],
			'streetname' => $link['streetname'],
			'area' => $link['area'],
			'city' => $link['city'],
			'state' => $link['state'],
			'country' => $link['country'],
			'email' => $link['email'],
			'phone1' => $link['phone1'],
			'phone2' => $link['phone2'],
			'education_qulification' => $link['education_qulification'],
			'year' => $link['year'],
			'institution' => $link['institution'],
			'emergency_name' => $link['emergency_name'],
			'emergency_phone' => $link['emergency_phone'],
			'emergency_relationship' => $link['emergency_relationship'],
		];
		return ($data);
	}
	
	public function doOnlineTrackPaidApplicantData(array $data)
    {
		$newuser = new Onlinetrackpaidapplicant;
        $newuser->reference = Str::random(15);
        $newuser->fname = $data['fname'];
        $newuser->lname = $data['lname'];
		$newuser->onames = $data['onames'];
        $newuser->identity_document = $data['identity_document'];
        $newuser->document_number = $data['document_number'];
        $newuser->document_issued_date = $data['document_issued_date'];
        $newuser->marital_status = $data['marital_status'];
		$newuser->gender = $data['gender'];
        $newuser->dob = $data['dob'];
        $newuser->nationality = $data['nationality'];
        $newuser->sailor = $data['sailor'];
		$newuser->rank = $data['rank'];
        $newuser->houseno = $data['houseno'];
        $newuser->streetname = $data['streetname'];
        $newuser->area = $data['area'];
        $newuser->city = $data['city'];
        $newuser->state = $data['state'];
        $newuser->country = $data['country'];
        $newuser->email = $data['email'];
        $newuser->phone1 = $data['phone1'];
        $newuser->phone2 = $data['phone2'];
        $newuser->education_qulification = $data['education_qulification'];
        $newuser->year = $data['year'];
        $newuser->institution = $data['institution'];
        $newuser->emergency_name = $data['emergency_name'];
        $newuser->emergency_phone = $data['emergency_phone'];
        $newuser->emergency_relationship = $data['emergency_relationship'];
        return $newuser;
	}

	public function createOnlineTrackPaidCourseData ($regcode, $email, $paidApplicantData, $payData)
	{
		$check = $this->checkOnlineTrackRegCodeByEmail($regcode, $email);
		$cos = $this->checkOnlineTrackCourseByEmail($regcode, $email); 
		// $cos = $this->getOnlineTrackCourse($regcode, $email); 
		/*
		$courseApplied = $this->checkOnlineTrackCourseByEmail($regcode, $email);
		if($courseApplied === 'csa') {
			$cos = 'csa';
		} 
		*/
		
		$course = new Onlinetrackpaidcourse;
        $course->email = $email;
        $course->reference = $paidApplicantData['reference'];
        $course[$cos.'_reg_id'] = $check['reg_id'];
        $course[$cos.'_pay_status'] = 'Paid';
        $course[$cos.'_pay_date'] = $payData['pay_date'];
        $course[$cos.'_pay_ref'] = $payData['pay_reference'];
        $course[$cos.'_pay_amount'] = $payData['pay_amount'];
        return $course;
	}
	
	public function updateOnlineTrackPaidCourseData ($regcode, $email, $payData)
	{
		$check = $this->checkOnlineTrackRegCodeByEmail($regcode, $email);
		$cos = $this->checkOnlineTrackCourseByEmail($regcode, $email); 
		$data = [	
			$cos.'_reg_id' => $check['reg_id'],
			$cos.'_pay_status' => 'Paid',
			$cos.'_pay_date' => $payData['pay_date'],
			$cos.'_pay_ref' => $payData['pay_reference'],
			$cos.'_pay_amount' => $payData['pay_amount'],
		];
		Onlinetrackpaidcourse::where('email', $email)->update($data);
	}



	/*
	public function doOnlineTrackPaidCourseData(array $data)
    {
		$course = new Onlinetrackpaidcourse;
        $course->email = $data['email'];
        $course->reference = $data['reference'];
        $course->csa_reg_id = $data['csa_reg_id'];
        $course->csa_pay_status = $data['csa_pay_status'];
        $course->csa_pay_date = $data['csa_pay_date'];
        $course->csa_pay_ref = $data['csa_pay_ref'];
        $course->csa_pay_amount = $data['csa_pay_amount'];
        return $course;
	}
	*/
	
	public function createOnlineTrackPaymentDetails ($regcode, $email, $payData)
	{
		$check = $this->checkOnlineTrackRegCodeByEmail($regcode, $email);
		$payDetails = [	
			'course' => $check['course'],
			'amount' => $check['amount'],
			'lname' => $check['lname'],
			'fname' => $check['fname'],
			'onames' => $check['onames'],
			'email' => $check['email'],
			'phone1' => $check['phone1'],
			'phone2' => $check['phone2'],
			'datetime' => $check['datetime'],
			'paid' => 'Paid',
			'pay_amount' => $payData['pay_amount'],
			'pay_date' => $payData['pay_date'],
			'pay_reference' => $payData['pay_reference'],
		]; 
		return ($payDetails);
	}

	public function deleteVerifiedDataFromApplicantsList ($regID, $email)
	{
		$verified = Onlinetrackapplicant::where('reg_id', $regID)->where('email', $email)->delete();
	}
	
	
	public function updateOnlineTrackUserEmailToken($email, $emailtoken)
	{
		User::where('email', $email)->update($emailtoken);
	}

	
	public function getTotalPaidOnlineTrackCourse($email)
	{	
		$paid = 1; $unpaid = 0;
		$data = $this->getAllPaidCourses($email);
		$allCourseStaus = array_values($data);
		if(in_array($paid, $allCourseStaus)){ $allPAidCourse = array_count_values($data)['1']; }
		return $allPAidCourse;
	}
	
	public function getAllPaidOnlineTrackCourseForUser($email)
	{	
		$paid = 1; $unpaid = 0;
		$data = $this->getAllPaidCourses($email);
		$allCourses = array_keys($data, $paid);
		return $allCourses;
	}
	
	public function doubleCheckPaidOnlineCourse($email, $courseID)
	{	
		$applicantInfo = $this->checkUserDetailsByEmail($email);
		$check = ($applicantInfo[''.$courseID.'_pay_status'] === 'Paid') ? 
		$status = 'Paid' : $status = 'Unpaid';
		return $check;
	}


	
	// Update this code-block with other courses later
	// with the courses in Onlinetrackcourses table. 
	public function getUserDetailsForPaidUser($email)
	{	
		$applicantInfo = $this->checkUserDetailsByEmail($email);

		$csa = ($applicantInfo->csa_pay_status === 'Paid') ? $pcsa = 'Crew Security Awareness with Designated Duties' : $pcsa = null;
		$cso = ($applicantInfo->cso_pay_status === 'Paid') ? $pcso = 'Company Security Officer' : $pcso = null;
		$msa = ($applicantInfo->msa_pay_status === 'Paid') ? $pmsa = 'Crew Security Awareness with Designated Duties' : $pmsa = null;
		$pfso = ($applicantInfo->pfso_pay_status === 'Paid') ? $ppfso = 'Port Facility Security Officer' : $ppfso = null;
		$sso = ($applicantInfo->sso_pay_status === 'Paid') ? $psso = 'Ship Security Officer' : $psso = null;
		$data = [	
			'csa' => $pcsa, 
			'cso' => $pcso,
			'msa' => $pmsa, 
			'pfso' => $ppfso, 
			'sso' => $psso, 
		];		
		return $data;
	}

	public function getUserScoreDetailsForPaidUser($email)
	{	
		$applicantScore = $this->checkUserScoreDetailsByEmail($email);
		if($applicantScore === [] || $applicantScore === null) { 
			$score = [	
				'all' => $finish = 20,
				'csa' => 0, 
				'csa_correct' => 0,
				'cso' => 0,
				'cso_correct' => 0,
				'msa' => 0, 
				'msa_correct' => 0,
				'pfso' => 0, 
				'pfso_correct' => 0,
				'sso' => 0,
				'sso_correct' => 0, 
			];
		} else 
		{
			/*
			$allScoreCSA = array_values($this->checkUserCsaScoreDetailsByEmail($email)->toArray());
			$allScoreCSO = array_values($this->checkUserCsoScoreDetailsByEmail($email)->toArray());
			$allScoreMSA = array_values($this->checkUserMsaScoreDetailsByEmail($email)->toArray());
			$allScorePFSO = array_values($this->checkUserPfsoScoreDetailsByEmail($email)->toArray());
			$allScoreSSO = array_values($this->checkUserssoScoreDetailsByEmail($email)->toArray());

			$coretScoreCSA = (in_array($coret, $allScoreCSA)) ? $coretCSA = array_count_values($allScoreCSA)[$coret] : $coretCSA = 0;
			$coretScoreCSO = (in_array($coret, $allScoreCSO)) ? $coretCSO = array_count_values($allScoreCSO)[$coret] : $coretCSO = 0;
			$coretScoreMSA = (in_array($coret, $allScoreMSA)) ? $coretMSA = array_count_values($allScoreMSA)[$coret] : $coretMSA = 0;
			$coretScorePFSO = (in_array($coret, $allScorePFSO)) ? $coretPFSO = array_count_values($allScorePFSO)[$coret] : $coretPFSO = 0;
			$coretScoreSSO = (in_array($coret, $allScoreSSO)) ? $coretSSO = array_count_values($allScoreSSO)[$coret] : $coretSSO = 0;
			*/
			
			$score = $this->getCourseScoreHintsFOrUserByEmail($email, $applicantScore);
		}
		return $score;
	}











	/// -----------   Assessment  -----------  ///
	
	public function checkIfUserEmailExistInScoreTable($email)
	{
		$check = $this->checkUserScoreDetailsByEmail($email); 
		return $check;
	}

	public function checkIfUserEmailExistInShuffleTable($email)
	{
		$check = $this->checkUserQuestionShuffleDetailsByEmail($email); 
		return $check;
	}

	public function createDefaultUserScoreAccount($email)
	{	
		$createDefault = $this->insertDefaultUserScoreAccount($email); 
		return $createDefault;
	}

	public function createDefaultUserShuffleAccount($email)
	{	
		$createDefault = $this->insertDefaultUserShuffledAccount($email); 
		return $createDefault;
	}

	public function checkIfUserAlreadyCompleteOrExitAttempt($email, $courseID)
	{
		$checkExitStatus = $this->checkUserCourseAttemptExitByEmail($email, $courseID);
		$status = ($checkExitStatus[0] === 1) ? 'True' : 'False';
		return $status;
	}
	
	public function generate20RandomQuestionNumbers()
	{
		$ids = range(1, 20);
		$availableQuestionNumbers = range(1, 20);
		shuffle($availableQuestionNumbers);
		$selectedQuestionNumbers = array_slice($availableQuestionNumbers, 0, 20);
        $selectedQuestionNumbersWithIDs = array_combine($ids, $selectedQuestionNumbers);
		return $selectedQuestionNumbersWithIDs;
	}

	public function checkIfUserAccountIsAlreadyPopulatedWithQuestionNumbers($email, $course)
	{		
		$checkShuffleDetailsForCourse = $this->checkUserQuestionShuffleDetailsByEmailandCourse($email, $course);
		$status = ($checkShuffleDetailsForCourse[0][''.$course.'_1'] > 0) ? 'True' : 'False';
		return $status;
	}

	public function insertAndPopulate20RandomNumbers($email, $course, $shuffled)
	{
		$doPopulate = $this->insertAndPopulateUserWith20RandomShuffledQuestionsNumbers($email, $course, $shuffled);
	}

	public function checkIfUserScoreRecordExist($email, $course)
	{
		$checkScoreDetailsForCourse = $this->checkUsersCourseScoreDetailsByEmailandCourse($email, $course);
		$status = ($checkScoreDetailsForCourse[0][''.$course.'_1'] > 0) ? 'True' : 'False';
		return $status;
	}

	public function prepareScoreRecordForUser($email, $course)
	{
		$zero = 0;
		$score_data = [
			$course.'_1' => $zero, $course.'_2' => $zero, $course.'_3' => $zero, $course.'_4' => $zero, $course.'_5' => $zero, 
			$course.'_6' => $zero, $course.'_7' => $zero, $course.'_8' => $zero, $course.'_9' => $zero, $course.'_10' => $zero,
			$course.'_11' => $zero, $course.'_12' => $zero, $course.'_13' => $zero, $course.'_14' => $zero, $course.'_15' => $zero, 
			$course.'_16' => $zero, $course.'_17' => $zero, $course.'_18' => $zero, $course.'_19' => $zero, $course.'_20' => $zero,
			$course.'_ans' => $zero,
			$course.'_exi' => Null,
		];
		$doPopulate = $this->doPopulateScoreRecordForUser($email, $score_data);

	}

	public function getQuestionDetails($email, $course, $number)
	{
		$getQuestionNumber = $this->checkCourseQuestionNumberForUser($email, $course, $number);		
		if($getQuestionNumber['Attempt_Status'] === 'No'){
			$questionData = [
				'questionNumber' => $getQuestionNumber['questionNumber'], // e.g -- No. 4
				'courseCode' => $course, // e.g -- csa
				'questionNumberCodeOnScoreTB' => $course.'_'.$getQuestionNumber['questionNumber'], // e.g -- csa_4
				'questionNumberOnShuffleListTB' => $getQuestionFromShuffleList = $this->checkUserQuestionShuffleDetailsByEmailandCourse($email, $course, $number)[0][$course.'_'.$getQuestionNumber['questionNumber']],
			];
		} else 
		{
			$attempted = $this->checkUserScoreDetailsByEmail($email)->toArray()[''.$course.'_attempts'];
			$scoreData = [	
				$course.'_attempts' => $attempted + 1,
				$course.'_exi' => 1,
			];
			$performUpdate = $this->doPopulateScoreRecordForUser($email, $scoreData);
			$questionData = 'ExitAttempt';
		}
		return $questionData;
	}

	public function checkIfUserScoreIsAlreadyRecorded($email, $courseCode, $questionNumber)
	{
		$performCheck = $this->checkUsersCourseScoreDetailsByEmailandCourse($email, $courseCode)[0];
		$status = ($performCheck[$courseCode.'_'.$questionNumber] > 0) ? 'True' : 'False';
		return $status;
	}

	public function updateScoreRecordWithUsersMark($mark, $email, $courseCode, $questionNumber)
	{
		$checkTotalAnswered = $this->checkUsersCourseScoreDetailsByEmailandCourse($email, $courseCode)[0];
		$scoreData = [	
			$courseCode.'_ans' => $checkTotalAnswered[$courseCode.'_ans'] + 1,
			$courseCode.'_'.$questionNumber => $mark,
		];
		$performUpdate = $this->doPopulateScoreRecordForUser($email, $scoreData);
	}

	public function checkUserCourseAssessmentGradeWithGradeLimit($score, $courseID)
	{	
		$scoreLimit = 80; 		
        $scorePercent = ($score[$courseID.'_correct'] / $score['all']) * 100 ; 	
		$status = ($scorePercent > 80 || $scorePercent === 80) ? 'True' : 'False';
		return $status;
	}

	public function sendCertificateRequestToSchoolAdmin($email, $courseDetail)
	{	
		$userDetials = $this->getPaidOnlineTrackUserDetailsByEmail($email);
		$userCoursePaymentDetials = $this->checkUserDetailsByEmail($email);
		$reg_id = $userCoursePaymentDetials[$courseDetail['code'].'_reg_id'];
		$payment_status = $userCoursePaymentDetials[$courseDetail['code'].'_pay_status'];
		$payment_date = $userCoursePaymentDetials[$courseDetail['code'].'_pay_date'];
		$pay_reference = $userCoursePaymentDetials[$courseDetail['code'].'_pay_ref'];
		$amount = $userCoursePaymentDetials[$courseDetail['code'].'_pay_amount'];
		
		$mdata = [	
			'recipient' => 'oladeleseo@gmail.com',
			'email' => $email,
			'name' => $userDetials['fname'],
			'lname' => $userDetials['lname'],
			'onames' => $userDetials['onames'],
			'phone' => $userDetials['phone1'],
			'phone2' => $userDetials['phone2'],
			'course' => $courseDetail['course'],
			'score_grade' => '80% and above',
			'reg_id' => $reg_id,
			'payment_status' => $payment_status,
			'payment_date' => $payment_date,
			'pay_reference' => $pay_reference,
			'amount' => $amount,
			'subject' => 'Certificate Request for Online Track Course',
			'datetime' => date("Y-m-d H:i:s"),
		];
		return $mdata;
	}
		




	


	// PUBLIC FUNCTIONS FOR STCW COURSES ...................
	


	public function getCertificateRenewalData($request)
    {
		$p = date("Y-m-d"); 
		$select = "Select";
		$choose = "Choose";
        $forman = new FormMan;
		$fname = $forman->FormInput($request->input('fname')) ;
		$lname = $forman->FormInput($request->input('lname')) ;
		$onames = $forman->FormInput($request->input('onames')) ;
		$identity_document = $forman->FormInput($request->input('identity_document')) ;
		$document_number = $forman->FormInput($request->input('document_number')) ;
		$document_issued_date = $forman->FormInput($request->input('document_issued_date')) ;
		$marital_status = $forman->FormInput($request->input('marital_status')) ;
		$gender = $forman->FormInput($request->input('gender')) ;
		$dob = $forman->FormInput($request->input('dob')) ;
		$nationality = $forman->FormInput($request->input('nationality')) ;
		$sailor = $forman->FormInput($request->input('sailor')) ;
		$rank = $forman->FormInput($request->input('rank')) ;
		$houseno = $forman->FormInput($request->input('houseno')) ;
		$streetname = $forman->FormInput($request->input('streetname')) ;
		$area = $forman->FormInput($request->input('area')) ;
		$city = $forman->FormInput($request->input('city')) ;
		$state = $forman->FormInput($request->input('state')) ;
		$country = $forman->FormInput($request->input('country')) ;
		$email = $request->input('email');
		$phone1 = $forman->FormInput($request->input('phone1')) ;
		$phone2 = $forman->FormInput($request->input('phone2')) ;
		
		$certfname = $forman->FormInput($request->input('certfname')) ;
		$certsname = $forman->FormInput($request->input('certsname')) ;
		$certonames = $forman->FormInput($request->input('certonames')) ;
		$cert_number = $forman->FormInput($request->input('cert_number')) ;
		$certcourse = $forman->FormInput($request->input('certcourse')) ;
		$cert_issued_date = $forman->FormInput($request->input('cert_issued_date')) ;
		$cert_valid_till = $forman->FormInput($request->input('cert_valid_till')) ;
		$cert_issuing_institution = $forman->FormInput($request->input('cert_issuing_institution')) ;
		$cert_issued_place = $forman->FormInput($request->input('cert_issued_place')) ;

		$course = $forman->FormInput($request->input('course')) ;
		$amount = $request->input('amount') ;
		
		$data = 
		[	
			'reg_type' => 'Renewal',
			'datetime' => $p,
			'reg_id' => $this->generateRegistrationID(),
			'course' => $course,
			'amount' => $amount,
			'paid' => 'No',
			'fname' => $fname,
			'lname' => $lname,
			'onames' => $onames,
			'identity_document' => $identity_document,
			'document_number' => $document_number,
			'document_issued_date' => $document_issued_date,
			'marital_status' => $marital_status,
			'gender' => $gender,
			'dob' => $dob,
			'nationality' => $nationality,
			'sailor' => $sailor,
			'rank' => $rank,
			'houseno' => $houseno,
			'streetname' => $streetname,
			'area' => $area,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'email' => $email,
			'phone1' => $phone1,
			'phone2' => $phone2,
			'certfname' => $certfname,
			'certsname' => $certsname,
			'certonames' => $certonames,
			'cert_number' => $cert_number,
			'certcourse' => $certcourse,
			'cert_issued_date' => $cert_issued_date,
			'cert_valid_till' => $cert_valid_till,
			'cert_issuing_institution' => $cert_issuing_institution,
			'cert_issued_place' => $cert_issued_place,
		];
		return ($data);
	}

	public function doNewApplicantData(array $data)
    {
        $newuser = new Applicant;
        $newuser->datetime =  date("Y-m-d");
        $newuser->reg_type = $data['reg_type'];
        $newuser->reg_id = $data['reg_id'];
		$newuser->course = $data['course'];
        $newuser->amount = $data['amount'];
        $newuser->paid = $data['paid'];
        $newuser->fname = $data['fname'];
        $newuser->lname = $data['lname'];
		$newuser->onames = $data['onames'];
        $newuser->identity_document = $data['identity_document'];
        $newuser->document_number = $data['document_number'];
        $newuser->document_issued_date = $data['document_issued_date'];
        $newuser->marital_status = $data['marital_status'];
		$newuser->gender = $data['gender'];
        $newuser->dob = $data['dob'];
        $newuser->nationality = $data['nationality'];
        $newuser->sailor = $data['sailor'];
		$newuser->rank = $data['rank'];
        $newuser->houseno = $data['houseno'];
        $newuser->streetname = $data['streetname'];
        $newuser->area = $data['area'];
        $newuser->city = $data['city'];
        $newuser->state = $data['state'];
        $newuser->country = $data['country'];
        $newuser->email = $data['email'];
        $newuser->phone1 = $data['phone1'];
        $newuser->phone2 = $data['phone2'];
        $newuser->education_qulification = $data['education_qulification'];
        $newuser->year = $data['year'];
        $newuser->institution = $data['institution'];
        $newuser->emergency_name = $data['emergency_name'];
        $newuser->emergency_phone = $data['emergency_phone'];
        $newuser->emergency_relationship = $data['emergency_relationship'];
        return $newuser;
	}

	public function doNewRenewalData(array $data)
    {
        $newuser = new Renewal;
        $newuser->datetime =  date("Y-m-d");
        $newuser->reg_type = $data['reg_type'];
        $newuser->reg_id = $data['reg_id'];
		$newuser->course = $data['course'];
        $newuser->amount = $data['amount'];
        $newuser->paid = $data['paid'];
        $newuser->fname = $data['fname'];
        $newuser->lname = $data['lname'];
		$newuser->onames = $data['onames'];
        $newuser->identity_document = $data['identity_document'];
        $newuser->document_number = $data['document_number'];
        $newuser->document_issued_date = $data['document_issued_date'];
        $newuser->marital_status = $data['marital_status'];
		$newuser->gender = $data['gender'];
        $newuser->dob = $data['dob'];
        $newuser->nationality = $data['nationality'];
        $newuser->sailor = $data['sailor'];
		$newuser->rank = $data['rank'];
        $newuser->houseno = $data['houseno'];
        $newuser->streetname = $data['streetname'];
        $newuser->area = $data['area'];
        $newuser->city = $data['city'];
        $newuser->state = $data['state'];
        $newuser->country = $data['country'];
        $newuser->email = $data['email'];
        $newuser->phone1 = $data['phone1'];
		$newuser->phone2 = $data['phone2'];
        $newuser->certfname = $data['certfname'];
        $newuser->certsname = $data['certsname'];
        $newuser->certonames = $data['certonames'];
        $newuser->cert_number = $data['cert_number'];
        $newuser->certcourse = $data['certcourse'];
        $newuser->cert_issued_date = $data['cert_issued_date'];
        $newuser->cert_valid_till = $data['cert_valid_till'];
        $newuser->cert_issuing_institution = $data['cert_issuing_institution'];
		$newuser->cert_issued_place = $data['cert_issued_place'];
        return $newuser;
	}

	public function validateCertificateRenewal(Request $request)
    {
        return $validator = Validator::make($request->all(), [
			'captcha' => 'required|captcha',
			'fname' => 'required|string',
			'lname' => 'required|string',
			'identity_document' => 'required|string',
			'document_number' => 'required|string',
			'document_issued_date' => 'required|date',
			'marital_status' => 'required|string',
			'gender' => 'required|string',
			'dob' => 'required|date',
			'nationality' => 'required|string',
			'houseno' => 'required|string',
			'streetname' => 'required|string',
			'area' => 'required|string',
			'city' => 'required|string',
			'state' => 'required|string',
			'country' => 'required|string',
			'email' => 'required|email',
			'phone1' => 'required|string',
			'certfname' => 'required|string',
			'certsname' => 'required|string',
			'cert_number' => 'required|string',
			'certcourse' => 'required|string',
			'cert_issued_date' => 'required|date',
		//	'cert_valid_till' => 'required|date',
			'cert_issuing_institution' => 'required|string',
			'cert_issued_place' => 'required|string',
			'declare' => 'required',
			'course' => 'required|string',
			'amount' => 'required',
			]
		);
	}







	// PUBLIC FUNCTIONS FOR CERTIFICATE VERIFICATION ...................
	

	public function cleanCertificateNumber($inputed) {
        $forman = new FormMan;
		$certNumber = $forman->FormInput($inputed['certno']);
		$data = [	
			'certno' => $certNumber,
		];
		return $data;
	}
	
	public function checkIfCertificateExist($crtno)
	{
		$certificate = Certeri::where('certno', $crtno)->first();
		if($certificate === [] || $certificate === null) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}
	
	public function getCertificateDetails($data)
	{
		$certificate = Certeri::where('certno', $data)->first()->toArray();
		return $certificate;
	}


	public function checkIfCertificateExistByEligibility($crtno)
	{
		$eligible = 'Yes';
		$certificate = Certeri::where('certno', $crtno)->where('eligible', $eligible)->first();
		if($certificate === [] || $certificate === null) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}


	






















	function checkFormAnswer ($data1, $data2, $data3) 
	{ // $data1 = no1 (Que 1), $data2 = no2 (Que 2), $data3 = qna (Answer)
		$ans = $data1 + $data2;
		$answered = $data3;
		return intval($answered) === intval($ans);
	}

	function isFormSubjectSpamFree ($data) 
	{
		$quickmessage = explode(" ", strtolower($data));
		$reg_exurl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$link1 = 'http';
		$link2 = 'https';
		$web1 = 'www.';
		$web2 = 'http:\/\/';
		$web3 = 'https:\/\/';
		$sex1 = 'sex';
		$sex2 = 'sexy';
		$sex3 = 'sexually';
		$sex4 = 'sexual';
		$money1 = 'money';
		$money2 = 'investment';
		$money3 = 'fund';

        if (in_array($sex1, $quickmessage) || in_array($sex2, $quickmessage) || in_array($sex3, $quickmessage) || 
			in_array($sex4, $quickmessage) || in_array($money1, $quickmessage) || in_array($money2, $quickmessage) || 
			in_array($money3, $quickmessage) ) 
		
		{
			$status = 'false';
		} else if (preg_match("/".$web1."/i", $data) || preg_match("/".$web2."/i", $data) || 
			preg_match("/".$web3."/i", $data) || preg_match("/".$link1."/i", $data) || preg_match("/".$link2."/i", $data)) 
		{
			$status = 'false';
		} else if (preg_match_all($reg_exurl, $data, $matches)) 
		{
			$status = 'false';
		} else 
		{
			$status = 'true';
		}
		return $status;
	}

	function isFormMessageSpamFree ($data) 
	{
		$quickmessage = explode(" ", $data);
		$reg_exurl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$link1 = 'http';
		$link2 = 'https';
		$web1 = 'www.';
		$web2 = 'http:\/\/';
		$web3 = 'https:\/\/';
		$sex1 = 'sex';
		$sex2 = 'sexy';
		$sex3 = 'sexually';
		$sex4 = 'sexual';
		$money1 = 'money';
		$money2 = 'investment';
		$money3 = 'fund';

        if (in_array($sex1, $quickmessage) || in_array($sex2, $quickmessage) || in_array($sex3, $quickmessage) || 
			in_array($sex4, $quickmessage) || in_array($money1, $quickmessage) || in_array($money2, $quickmessage) || 
			in_array($money3, $quickmessage) ) 
		
		{
			$status = 'false';
		} else if (preg_match("/".$web1."/i", $data) || preg_match("/".$web2."/i", $data) || 
			preg_match("/".$web3."/i", $data) || preg_match("/".$link1."/i", $data) || preg_match("/".$link2."/i", $data)) 
		{
			$status = 'false';
		} else if (preg_match_all($reg_exurl, $data, $matches)) 
		{
			$status = 'false';
		} else 
		{
			$status = 'true';
		}
		return $status;
	}

    public function getQuickFormData($inputed)
    {
		$forman = new FormMan;
		$name = $forman->FormInput($inputed['name']);
		$email = $inputed['email'];
		$phone = $forman->FormInput($inputed['phone']);
		$subject = $forman->FormInput($inputed['subject']);
		$msg = $forman->FormInput($inputed['msg']);
		$qna = $forman->FormInput($inputed['qna']);
		$no1 = $forman->FormInput($inputed['no1']);
		$no2 = $forman->FormInput($inputed['no2']);
		
		$data = [	
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'subject' => $subject,
			'msg' => $msg,
			'qna' => $qna,
			'no1' => $no1,
			'no2' => $no2,
		];
		return $data;
	}
	
	public function sendQuickMessageNotificationToAdmin($formData)
	{
		$mdata = [	
			'recipient' => 'oladeleseo@gmail.com',
			'email' => $formData['email'],
			'phone' => $formData['phone'],
			'name' => $formData['name'],
			'subject' => $formData['subject'],
			'msg' => $formData['msg'],
			'datetime' => date("Y-m-d H:i:s"),
		];
		
        Mail::send('emails.quickmessage', $mdata, function($message) use ($mdata){
            $message->to($mdata['recipient']); 
            $message->subject('Coastal Maritime Academy: Quick Mail'); 
        });
	}
	
	
	public function generateRegistrationID()
	{
		$day = date("ynj"); 
		$time = date("Gis"); 
		$characters1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$code1 = '';
		for ($i = 0; $i < 3; $i++) {
			$code1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$characters2 = '123456789';
		$charactersLength2 = strlen($characters2);
		$code2 = '';
		for ($i = 0; $i < 3; $i++) {
			$code2 .= $characters2[rand(0, $charactersLength2 - 1)];
		}
		$registration_id = 'REG'.$code2.$day.$code1.$time;
		return $registration_id;
	}


	
	/* public function saveTrainingApplicantDetail($data)
	{
		$user = $this->doNewApplicantData($data);
        $user->save();
		Applicant::insert(
			$data
		);
	} */
	

    /* public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    } */
	
	public function doesRegIDExist($reg)
	{
		$id = Applicant::where('reg_id', $reg)->first();
		if($id === [] || $id === null) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}

	public function getApplicantionDetail($reg)
	{
		$details = Applicant::where('reg_id', $reg)->first();
		return $details;
	}

	public function getApplicantionDetailToArray($reg)
	{
		$details = Applicant::where('reg_id', $reg)->first()->toArray();
		return $details;
	}
	
	public function convertAmountToKoboo($amt)
	{
		$amount = $amt;
		$amount = (int) preg_replace('/\,/', '', $amt);
		return $amount * 100;
	}
	
	public function doRegCodeCheck($regcode, $email)
	{
		$code = Applicant::where('reg_id', $regcode)->where('email', $email)->first();
		if($code === [] || $code === null) {
			$status = 'notValid';
		} else {
			$status = 'isValid';
		}
		return $status;
	}

	public function doPreviousPaymentCheck($regcode, $email)
	{
		$paid = 'Yes';
		$payment = Applicant::where('reg_id', $regcode)->where('email', $email)->where('paid', $paid)->first();
		if($payment === [] || $payment === null) {
			$status = 'notPaid';
		} else {
			$status = 'hasPaid';
		}
		return $status;
	}

	public function savePaymentDetails($data, $regcode, $email)
	{
		Applicant::where('reg_id', $regcode)->where('email', $email)->update($data);
	}



	





}

?>