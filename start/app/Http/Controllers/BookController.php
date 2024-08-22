<?php

namespace App\Http\Controllers;

use Auth, Session;
use App\Models\Book;
use App\Models\Cart;
use App\SalesRobot\Robot;
use App\SalesRobot\FormMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $robot = new Robot;
        // get all books
        $bks = $robot->getAllBooks()->toArray();       
        return view('pages.index')->withBks($bks);
	}

    public function listAllBooks()
    {
        $robot = new Robot;
        $userAccess = $robot->getAccessLevel(); 
        $books = $robot->getAllBooks()->toArray();         
		if($userAccess === 'notAllowed') { return redirect('/'); }
		if($userAccess === 'MasterAdmin') { return view('pages.master.books')->withBooks($books); } 
		if($userAccess === 'Admin') { return view('pages.admin.books')->withBooks($books); }  
		if($userAccess === 'SalesRep') { return view('pages.rep.books')->withBooks($books); }  
        Session::flash('message', 'Not Allowed!');
        return redirect('/');
    }

    
    public function viewBook(Request $request, $id)
    {
        $robot = new Robot;
        $forman = new FormMan;
        
        // get user level and show book details depending on user level
        $userAccess = $robot->getAccessLevel(); 
        if($userAccess === 'notAllowed') { Session::flash('message', 'Sorry, not allowed!'); return back(); }
        
        /*
        // if no selected customer...
        if(Session::get('table.customer') === [] || Session::get('table.customer') === null) {
            Session::flash('message', 'No customer !'); 
            return back();
		}
        */

        $au = Auth::user()->toArray()['email'];
        // get bookID
        $cc = $forman->FormInput($id);    
        // check if book exist
        $verifyBook = $robot->doesBookExist($cc);       
		if($verifyBook === 'notValid') { 
            Session::flash('message', 'Attemp not allowed!'); 
            return redirect('/books');
        }  
        // get book details by bookID
        $book = $robot->getBookDetailsByCode($cc)[0];
        // get customer name and ID
        $ccagent = $robot->getAllCustomersByAgentID($au);        
        if($ccagent === [] || $ccagent === null) {
			$cagent = [];
		} else {
            $cagent = $ccagent;
		}
        
        $getCustomerName = Session::get('table.customer');
        if($getCustomerName === [] || $getCustomerName === null) {
			$sc = '';
		} else {
            $ssc = $robot->getCustomerDetailsByCustomerID($getCustomerName)[0]; 
            $sc = $ssc->company;
		}
        
        //$ssc = $robot->getCustomerDetailsByCustomerID($getCustomerName)[0]; 
        //$sc = $ssc->company;

		//if($userAccess === 'notAllowed') { return redirect('/'); }
		//if($userAccess === 'MasterAdmin') { return view('pages.master.viewbook')->withBook($book)->withCagent($cagent)->withSc($sc); } 
		//if($userAccess === 'Admin') { return view('pages.admin.viewbook')->withBook($book)->withCagent($cagent)->withSc($sc); }  
		//if($userAccess === 'SalesRep') { 
        
        return view('pages.viewbook')->withBook($book)->withCagent($cagent)->withSc($sc); 
            
        //}  
        //Session::flash('message', 'Not Allowed!');
        //return redirect('/');
    }

    public function addBook()
    {
        $robot = new Robot;
        // check user's role (Admin or Master Admin)
        $userAccess = $robot->getAccessLevel();  
        // only admin and master admin can view page        
		if($userAccess === 'MasterAdmin' || $userAccess === 'Admin') { 
            return view('pages.admin.addbook');
        }  
        Session::flash('message', 'Attemp not allowed!'); return back();
    }

    public function editBook(Request $request, $id)
    {
        $robot = new Robot;
        $forman = new FormMan;
        $userAccess = $robot->getAccessLevel();      
        // only admin and master admin can edit book details    
		if($userAccess === 'MasterAdmin' || $userAccess === 'Admin') { 
            // get bookID
            $cc = $forman->FormInput($id);
            // check if book exist by bookID, if not, return to books
            $bookValidity = $robot->doesBookExist($cc); 
            if($bookValidity === 'notValid') { 
                Session::flash('message', 'Sorry! Try again'); 
                return redirect('/books');
            }
            // get book details by bookID
            $book = $robot->getBookDetailsByCode($cc)[0]; 
            return view('pages.admin.editbook')->withBook($book);
        }  
        Session::flash('message', 'Sorry! Try again'); return back();
    }

    public function postBook(Request $request)
	{
        $select = "Select";
		$choose = "Choose";
        $robot = new Robot;
        $forman = new FormMan;        
        $userAccess = $robot->getAccessLevel(); 
        $bkID = $request['BookID'];

		if($userAccess === 'MasterAdmin' || $userAccess === 'Admin') { 
            // Validate input, if fail, return back
            $checkPostRequestInput = $robot->validateBookAddingRequest($request);
            if ($checkPostRequestInput->fails()) 
            {
                Session::flash('message', 'All fields with asteric(*) are compulsory.'); 
                return back(); 
            } 
            // check for correct answer, if incorrect, return back
            $answerValidity = $robot->checkPostAnswer($request->input('no1'), $request->input('no2'), $request->input('qna'));
            if($answerValidity === false)
            {
                Session::flash('message', 'Please, give a correct answer.');
                return back(); 
            }
            // if request is POSTEDIT
            if($request['requestType'] === 'postBookEdit')
            {
                // get request data
                $postRequestData = $robot->getPostingEditBookData($request);
                // save editted book details
                $status = $robot->doEditBookDetails($postRequestData, $bkID);
                if($status === 'unsuccessful'){ Session::flash('message', 'Book information not updated'); return back();}
                Session::flash('message', 'Book information updated '); return redirect('/books');
                
            }
            
            // if bookID already exist, return back
            $checkForDuplicateBookID = $robot->doesBookExist($bkID);
            if($checkForDuplicateBookID === 'isValid')
            {
                Session::flash('message', 'BookID already exist.');
                return back(); 
            }
            // get request data
            $postRequestData = $robot->getPostingAddBookData($request);
            // save book details
            $status = $robot->doSaveBook($postRequestData);
            if($status === 'unsuccessful'){ Session::flash('message', 'Book information not saved'); return back();}
            Session::flash('message', 'Book information saved '); return redirect('/books');
        }  
        Session::flash('message', 'Attemp not allowed!'); return back();
    }

    public function deleteBook(Request $request, $id)
    {
        $robot = new Robot;
        $forman = new FormMan;    
        $cc = $forman->FormInput($id);
        
        $userAccess = $robot->getAccessLevel(); 
		if($userAccess === 'MasterAdmin' || $userAccess === 'Admin') { 
            $verifyBook = $robot->doesBookExist($cc);
            if($verifyBook === 'notValid'){
                Session::flash('message', 'Attemp not allowed!'); return back(); 
            }
            $data = [	
                'deleted' => 1,
                'deleted_by' => Auth::user()->email,
                'deleted_date' => date("Y-m-d"),
            ];
            $doBookDelete = $robot->doBookDeleteByBookID($cc, $data);
            $checkBookDelete = $robot->checkBookDeleteByBookID($cc, $data);
            if($checkBookDelete === 'isDeleted'){
                Session::flash('message', 'Book deleted successfully.'); return back(); 
            }
            Session::flash('message', 'Book delete not successful.'); return back();
        }
        Session::flash('message', 'Not Allowed!'); return back();
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
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
