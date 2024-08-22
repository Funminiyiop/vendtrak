<?php

namespace App\Http\Controllers;


use DB, Session, Auth;
use App\Models\User;
use Illuminate\Http\Request;

class RobotSignsController extends Controller
{
    //protected $redirectTo = '/home';    
    
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
    
    // Only Admin and Master Admin can assign SalesRep Access Level
    public function signmeup()
    { 
		$accessLevel = $this->gatePass();
		if($accessLevel !== 'MasterAdmin' && $accessLevel !== 'Admin') {
            return redirect('/');
		}
        return view('robotsign.signrep');
    }

    public function signmeupAdm()
    {
        $accessLevel = $this->gatePass(); 
		if($accessLevel !== 'MasterAdmin' && $accessLevel !== 'Admin') {
            // Auth::logout();
            return redirect('/');
		} 
        return view('robotsign.signadm');
    }
    
    
    public function postSignRep(Request $request)
    {
        $accessLevel = $this->gatePass(); 
		if($accessLevel !== 'MasterAdmin' && $accessLevel !== 'Admin') {
            //Auth::logout(); 
            return redirect('/');
		}

        $verifyUser = User::where('email',$request->input('email'))->first();
        if($verifyUser === null)
        {
	    	Session::flash('message', 'User not verified.');
            return redirect('signrep');
        }
		
		DB::beginTransaction();
        try
        {
			$dasi = [ 'level' => 202330, ];
            User::where('email',$request->input('email'))->update( $dasi );
	        Session::flash('message', 'SALES REP level assignment successful.');
	        return redirect('/');
        }
        catch(Exception $e)
        {
            DB::rollback(); 
	        Session::flash('message', 'SALES REP level assignment not successful, please try again');
            return redirect('/');
        }
    }

    
    public function postSignAdm(Request $request)
    {
        $accessLevel = $this->gatePass(); 
		if($accessLevel !== 'MasterAdmin' && $accessLevel !== 'Admin') {
            //Auth::logout(); 
            return redirect('/');
		}

        $verifyUser = User::where('email',$request->input('email'))->first();
        if($verifyUser === null)
        {
	    	Session::flash('message', 'User not verified.');
            return redirect('signadm');
        }
		
		DB::beginTransaction();
        try
        {
			$dasi = [ 'level' => 203096, ];
            User::where('email',$request->input('email'))->update( $dasi );
	        Session::flash('message', 'ADMIN level assignment successful.');
	        return redirect('/');
        }
        catch(Exception $e)
        {
            DB::rollback(); 
	        Session::flash('message', 'ADMIN level assignment not successful, please try again');
            return redirect('/');
        }
    }

    

}
