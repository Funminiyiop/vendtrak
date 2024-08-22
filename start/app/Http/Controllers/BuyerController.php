<?php

namespace App\Http\Controllers;

use Auth, Session;
use App\Models\Buyer;
use App\SalesRobot\Robot;
use App\SalesRobot\FormMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // ===== Customer Block =====
    // add new customer
    public function addCustomer()
    {
        $robot = new Robot;
        // check user's role (Admin or Master Admin or sales rep)
        $userAccess = $robot->getAccessLevel();  
        if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, not allowed!'); return back(); }
        // only master admin, admin and sales reps can add a customer      
        return view('pages.buyer.addcustomer'); 
    }

    // view all customers
    public function listCustomers()
    {
        $robot = new Robot;
        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, not allowed!'); return back(); }
        //$customers = $robot->getAllCustomers(Auth::user()->email)->toArray();
        $customers = $robot->getAllCustomersByAgentID(Auth::user()->email);     
        return view('pages.buyer.customers')->withCustomers($customers);

        /*
        exit;

        if($userAccess === 'MasterAdmin' || $userAccess === 'Admin' || $userAccess === 'SalesRep') { 
            return view('pages.buyer.customers')->withCustomers($customers);
        }  
        Session::flash('message', 'Not allowed!'); return back();
        */
    }

    // view single customer page by customerID
    public function viewCustomer(Request $request, $id)
    {
        $robot = new Robot;
        $forman = new FormMan;
        // get customerID
        $cc = $forman->FormInput($id); 
        
        // check if customer exist by customerID, if not, return to customers page
        $verifyCustomerID = $robot->doesCustomerExistByID($cc);       
		if($verifyCustomerID === 'notValid') { 
            Session::flash('message', 'Attemp not allowed!'); 
            return redirect('/customers');
        }  
       
        // get customer details by customerID
        $customer = $robot->getCustomerDetailsByCustomerID($cc)[0];

        // get user level and show customer's details based on user level
        $userAccess = $robot->getAccessLevel(); 
        
        if($userAccess === 'MasterAdmin' || $userAccess === 'Admin' || $userAccess === 'SalesRep') { 
            return view('pages.buyer.viewcustomer')->withCustomer($customer);
        }  
        Session::flash('message', 'Not Allowed!');
        return redirect('/');
    }

    // edit customer details
    public function editCustomer(Request $request, $id)
    {
        $robot = new Robot;
        $forman = new FormMan;
        $userAccess = $robot->getAccessLevel();      
        // only master admin, admin and sales reps can edit a customer's detail
        if($userAccess === 'MasterAdmin' || $userAccess === 'Admin' || $userAccess === 'SalesRep') { 
            // get customerID
            $cc = $forman->FormInput($id);
            
            // check if customer exist by customerID, if not, return to customers page
            $verifyCustomerID = $robot->doesCustomerExistByID($cc);       
            if($verifyCustomerID === 'notValid') { 
                Session::flash('message', 'Attemp not allowed!'); 
                return back();
            }  
            // get customer details by customerID
            $customer = $robot->getCustomerDetailsByCustomerID($cc)[0];

            // check... 
            // Only the agent that register a customer should be able to edit the customer details
            // Only Master Admin should have absolute rigth to edit without being the registrer
            return view('pages.buyer.editcustomer')->withCustomer($customer);
        }  
        Session::flash('message', 'Sorry! Try again'); return redirect('/');
    }


    public function postCustomer(Request $request)
	{
        $select = "Select";
		$choose = "Choose";
        $robot = new Robot;
        $forman = new FormMan;        
        $userAccess = $robot->getAccessLevel(); 
        $cusID = $request['customerID'];

		if($userAccess === 'MasterAdmin' || $userAccess === 'Admin' || $userAccess === 'SalesRep') { 
            // Validate input, if fail, return back
            $validateRequestInput = $robot->validateCustomerRegistrationRequest($request);
            if ($validateRequestInput->fails()) 
            {
                Session::flash('message', 'All fields with asteric(*) are compulsory.'); 
                return back(); 
            } 
            // check for correct answer, if incorrect, return back
            $answerValidition = $robot->checkPostAnswer($request->input('no1'), $request->input('no2'), $request->input('qna'));
            if($answerValidition === false)
            {
                Session::flash('message', 'Please, give a correct answer.');
                return back(); 
            }
            $customerAgent = Auth::user()->toArray()['email'];
            
            // if request is an EDIT request
            if($request['requestType'] === 'editCustomerRequest')
            {
                // get request data
                $postRequestData = $robot->getAddCustomerDetails($request, $customerAgent);
                
                // save customer details
                $status = $robot->doEditCustomerDetails($postRequestData, $cusID);
                if($status === 'unsuccessful'){ Session::flash('message', 'Customer information update fail'); return back();}
                Session::flash('message', 'Customer information update successful '); return redirect('/customers');
                
            }
            
            // if request is ADD NEW customer
            // customer company email
            $cEmail = $request['email'];
            // if customer already exist by email, return back
            $checkForDuplicateCustomer = $robot->doesCustomerExistByEmail($cEmail);
            if($checkForDuplicateCustomer === 'isValid')
            {
                Session::flash('message', 'Customer already exist.');
                return back(); 
            }
            // get request data
            $postRequestData = $robot->getAddCustomerDetails($request, $customerAgent);
            // save customer details
            $status = $robot->doSaveCustomer($postRequestData);
            if($status === 'unsuccessful'){ Session::flash('message', 'Customer information not saved'); return back();}
            Session::flash('message', 'Customer information saved '); return redirect('/customers');
        }  
        Session::flash('message', 'Attemp not allowed!'); return redirect('/');
    }

    public function deleteCustomer(Request $request, $id)
    {
        $robot = new Robot;
        $forman = new FormMan;    
        $cc = $forman->FormInput($id);
        
        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'MasterAdmin' || $userAccess === 'Admin') { 
            // check if customer exist by customerID, if not, return to previous page
            $verifyCustomerID = $robot->doesCustomerExistByID($cc);       
            if($verifyCustomerID === 'notValid') { 
                Session::flash('message', 'Attemp not allowed!'); 
                return back();
            }  
            
            $data = [	
                'deleted' => 1,
                'deleted_by' => Auth::user()->email,
                'deleted_date' => date("Y-m-d"),
            ];
            $doCustomerDelete = $robot->doCustomerDeleteBycustomerID($cc, $data);
            $checkCustomerDelete = $robot->checkCustomerDeleteByBookID($cc, $data);
            if($checkCustomerDelete === 'isDeleted'){
                Session::flash('message', 'Customer deleted successfully.'); return back(); 
            }
            Session::flash('message', 'Customer delete not successful.'); return back();
        }
        Session::flash('message', 'Not Allowed!'); return back();
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
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buyer $buyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buyer $buyer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buyer $buyer)
    {
        //
    }
}
