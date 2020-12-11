<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Relative;
use App\Relationship as Rship;

class BnfController extends Controller{

	public function manageAll(){


		$relatives = Auth::user()->relatives;


		return view('admin.beneficiary')
					->with('crumbs', 'relatives')
					->with('pgtitle', 'All Your Relations')
					->with('relatives', $relatives);
	}

	public function newRelative(){
			$rships = Rship::all();
			return view('admin.newbeneficiary')
					->with('crumbs', 'relatives')
					->with('pgtitle', 'All Your Relations')
					->with('iss_code', Relative::genISSCode())
					->with('relationships', $rships);
	}

    public function addRelative(Request $request){

    	//pr($request->all(), true);

    	if($request->hasFile('r_uplfile')) {
    		$file = $request->file('r_uplfile');
			$code = strtolower(Auth::user()->code->code);
	        $fname = $code . '_file_'.time().'.'.$file->getClientOriginalExtension();
	        $destinationPath = public_path() . DS . 'uploads' . DS . 'r_users';
	        $file->move($destinationPath, $fname);
	    }


    	$r = new Relative;
    	$r->user_id = Auth::id();
    	$r->firstname = $request->input('r_fname');
    	$r->middlename = $request->input('r_mname');
    	$r->date_of_birth = $request->input('r_dob'); 
    	$r->phone = $request->input('r_phone'); 
    	$r->sex = $request->input('r_sex');
    	$r->relationship_id = $request->input('r_rship'); 
    	$r->bvn_number = $request->input('r_bvn'); 
    	$r->lastname = $request->input('r_lname'); 
    	$r->iss_code = $request->input('r_issc'); 
    	$r->picture = $fname; 

   		if($r->save()){
   			return redirect()->back()->with('success', 'Relative saved successfully...');
   		}else{
   			return redirect()->back()->with('error', 'Error saving Relatives info...');
   		}


    }
}
