<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class BvnController extends Controller{
    

    public function pullBVNInfo(){
    	return view('pages.bvn');
    }


    public function processBVN(Request $request){
    	//to api..
    	//pr($request->all());
    	return redirect()->to('user/register');
    }
}
