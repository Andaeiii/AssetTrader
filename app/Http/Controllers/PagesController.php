<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller{

	public function homepage(){
		return view('pages.front');
	}

	public function index(){
		return view('admin.dashboard')
				->with('crumbs', 'Dasboaord')
				->with('pgtitle', 'Welcome to Your Dashboard..');
	}

	public function login(){
		return view('pages.login')
			   ->with('pgtitle', 'Login Page');
	}

}
