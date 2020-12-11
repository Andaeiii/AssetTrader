<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Relative;
use App\Asset;
use App\Mapping;
use App\User;
use Auth;

class WillController extends Controller{
    

    public function executewill(){
        $m = Auth::user()->mapping->load(['asset','relative']); 
    	return view('admin.executewill')
    			->with('crumbs', 'ExecuteWill')
    			->with('pgtitle', 'Execute Will')
    			->with('mapping', $m);
    }
}
