<?php

namespace App\Http\Controllers;

use Session, DB, Mail;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\SalesRobot\Robot;

class DeveloperloginController extends Controller
{
    //use AuthenticatesUsers;
    protected $redirectTo = '/home';

    protected function gatePass()
    {	
        $mstadm = 901906; $adm = 203096; $rep = 202330; $usr = 191;
		$au = Auth::user();

        if($au === null){ $accessLevel = 'notAllowed'; return $accessLevel; }
		if($au->level === 'null' || $au->level === '') { $accessLevel = 'notAllowed'; return $accessLevel; }
		if($au->level === $mstadm) { $accessLevel = 'MasterAdmin'; return $accessLevel; }
		if($au->level === $adm) { $accessLevel = 'Admin'; return $accessLevel; }
		if($au->level === $rep) { $accessLevel = 'SalesRep'; return $accessLevel; } 
		if($au->level === $usr) { $accessLevel = 'PublicUser'; return $accessLevel; } 
    }
    
    /*
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    */

    protected function doValidateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function doAttemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->takeCredentials($request), $request->has('remember')
        );
    }

    protected function takeCredentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    /*
    public function fireLogin(Request $request)
    {
        $this->doValidateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if ($this->doAttemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    
    public function fireLogin(Request $request)
    {
        $robot = new Robot;
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        $checkDuplicate =  $robot->checkUserIfVeried($credentials['email'])['verified']; 
        if($checkDuplicate === 0) { 
            DB::beginTransaction();
            try
            {
                $mdata = [	
                    'name' => $checkDuplicate =  $robot->checkUserIfVeried($credentials['email'])['name'],
                    'email' => $checkDuplicate =  $robot->checkUserIfVeried($credentials['email'])['email'], 
                    'email_token' => Str::random(15),
                ];
                Mail::send('emails.verification', $mdata, function($message) use ($mdata){
                    $message->to($mdata['email']); 
                    $message->subject('Account Activation Request'); 
                });
                $updata = [	
                    'email_token' => $mdata['email_token'],
                ];
                $updateToken =  $robot->updateNewUserEmailToken($mdata['email'], $updata);
                Session::flash('message', 'You need to verify your account. A verification email was sent to you.');      	
                return redirect('/login');
            }
            catch(Exception $e)
            {
                DB::rollback(); 
                return back();
            }
                
        } 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
    */

    public function fireLogin(Request $request)
    {
        $robot = new Robot;
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        $userExist =  $robot->checkUserIfExist($credentials['email']); 
        if($userExist === 'No'){
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $userVerified =  $robot->checkUserIfVeried($credentials['email'])['verified']; 
        if($userVerified === 0) { 
            DB::beginTransaction();
            try
            {
                $mdata = [	
                    'name' => $userVerified =  $robot->checkUserIfVeried($credentials['email'])['name'],
                    'email' => $userVerified =  $robot->checkUserIfVeried($credentials['email'])['email'], 
                    'email_token' => Str::random(15),
                ];
                Mail::send('emails.verification', $mdata, function($message) use ($mdata){
                    $message->to($mdata['email']); 
                    $message->subject('Account Activation Request'); 
                });
                $updata = [	
                    'email_token' => $mdata['email_token'],
                ];
                $updateToken =  $robot->updateNewUserEmailToken($mdata['email'], $updata);
                Session::flash('message', 'You need to verify your account. A verification email was sent to you.');      	
                return redirect('/login');
            }
            catch(Exception $e)
            {
                DB::rollback(); 
                return back();
            }
                
        } 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
    
    public function dashboard(Request $request)
    {
        $robot = new Robot;
        $accessLevel = $this->gatePass();
		if($accessLevel === 'MasterAdmin') {
            // Master Admin Dashboard    	
            return view('profile.master.dashboard');
		}
		if($accessLevel === 'Admin') {
            // Admin Dashboard
            return view('profile.admin.dashboard');
		}
		if($accessLevel === 'SalesRep') {
            // Sales Rep Dashboard
            return view('profile.rep.dashboard');
		}
		if($accessLevel === 'PublicUser') {
            Auth::guard('web')->logout();
            Session::flash('message', 'Account not authorized! Please, contact the admin to authorize your account.'); 
            return redirect('/');
		}

    }

}
