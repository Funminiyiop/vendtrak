<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Session;
use App\Models\User;
use Validator;
use App\SalesRobot\Robot;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
//use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class DevelopersignupController extends Controller
{
    protected $redirectTo = '/home';    
    /*
    public function __construct()
    {
       $this->middleware('guest');
    }
    */

    //public function signmeup($name, $email, $password)
    public function signmeup(Request $request)
    {
        $robot = new Robot;
        $data = [ 
            'name' => $request->input('name'), 
            'email' => $request->input('email'), 
            'password' => $request->input('password'), 
        ];
        $validateInput = $this->validator($data);    
        $checkDuplicate =  $robot->checkIfEmailAlreadyExistAsUser($data['email']); 
        if($checkDuplicate === 'Yes')
        {
            Session::flash('message', 'Ohps! User already exist.');
            return back(); 
        }

        DB::beginTransaction();
        try
        {
            $user = $this->docreate($data);
            $user->save();
            $mdata = [	
				'name' => $user->name,
                'email' => $user->email, 
                'email_token' => $user->email_token,
            ];
            Mail::send('emails.verification', $mdata, function($message) use ($mdata){
                $message->to($mdata['email']); 
                $message->subject('Account Activation Request'); 
            });
            DB::commit();

            // $deleteLoginCred = $robot->deleteLoginData($email);      
            Session::flash('message', 'Account activation message has been sent to your email, please check to activate your account.');      	
            return redirect('/');
        }
        catch(Exception $e)
        {
            DB::rollback(); 
            return back();
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
        ]);
    }

    protected function docreate(array $data)
    { 
        $newuser = new User;
        $newuser->name = $data['name'];
        $newuser->email = $data['email'];
        $newuser->password = bcrypt($data['password']);
        $newuser->email_token = Str::random(15);
        return $newuser;
    }

    /*
    public function resVerification(Request $request)
    {
        
        
        dd(Auth::user()->email);
        exit;
        
        dd($email);
        exit;
        $mdata = [	
            'email' => $email, 
            'email_token' => Str::random(15),
        ];
        Mail::send('emails.verification', $mdata, function($message) use ($mdata){
            $message->to($mdata['email']); 
            $message->subject('ISPS ONLINE Track: Registration Verification Request'); 
        });
        Session::flash('message', 'Verification mail sent.');
        return redirect('login');
    }
    */

    public function verify($token)
    {
        $toverify = User::where('email_token',$token)->first();
        if($toverify === null)
        {
	    	Session::flash('message', 'Nothing to verify.');
            return redirect('login');
        }
		
		DB::beginTransaction();
        try
        {
			$dasi = 
			[	
				'level' => 191,
                'verified' => 1,
                'email_token' => 'NULL',
                'email_verified_at' => date("Y-m-d H:i:s"),
			];
            
			User::where('email_token',$token)->update(
				$dasi
			);
	        Session::flash('message', 'Account Activation successful.');
	        return redirect('login');
        }
        catch(Exception $e)
        {
            DB::rollback(); 
	        Session::flash('message', 'Account Activation not successful, please try again');
            return redirect('/');
        }
    }
}
