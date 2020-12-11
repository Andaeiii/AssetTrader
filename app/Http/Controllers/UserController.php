<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller{

	public function newUser(){		
    	return view('pages.register');
	}

	public function adduser(Request $request){		
    	//pr($request->all());
    	return redirect()->to('/auth/pay');
	}

	public function authenticate(Request $request){
		$ar = [
			'email' 	=> $request->input('email'),
			'password'  => $request->input('password')
		];
		if(Auth::attempt($ar)){
			return redirect()->to('dashboard');
		}else{
			return redirect()->back()->with('error', 'error loggin in.');
		}
	}

	public function logout(){
		Auth::logout();
		return redirect()->to('/');
	}

}
