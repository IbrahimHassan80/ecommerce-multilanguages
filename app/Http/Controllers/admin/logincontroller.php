<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\valid_adminlogin;

class logincontroller extends Controller
{
    
    public function getlogin(){
    	return view('admin.auth.admin-login');
    }

    public function checklogin(valid_adminlogin $request){
    	$remeber_me = $request->has('remeber_me') ? true : false;
    	
		if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
		{
    		return redirect()->route('admin.dashboard');
    	} 

    	else {
    		
    		return redirect()->back()->with(['notsuc'=>'Wrong In Information Login']);
    	}
	
	}
}//--/