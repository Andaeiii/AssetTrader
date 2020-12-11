<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Asset as SftAsset;
use App\User;
use App\AsseType;
use App\Relative;
use App\Mapping;

use DB;


class AssetsController extends Controller{

	public function newasset(){

    	return view('admin.new_asset')
    				->with('crumbs', 'Assets')
    				->with('assetypes', AsseType::all())
    				->with('pgtitle', 'Add New Asset');
	}
    
    public function allassets(){

    	$assets = SftAsset::with('assetype')->where('user_id', Auth::id())->get();
    	return view('admin.allassets')
    				->with('crumbs', 'Assets')
    				->with('pgtitle', 'Manage All Assets')
    				->with('assets', $assets);
    }

    public function addasset(Request $request){
       //pr($request->all(), true);
    	$folder = ($request->input('as_is_img') != 'imgs') ? 'docs':'imgs';
        $file = $request->file('as_file');

        //Asset::where()

    	if ($request->hasFile('as_file')) {
			$code = strtolower(Auth::user()->code->code);
			//$setting = $Auth->user()->setting;
	        $fname = $code . '_file_'.time().'.'.$file->getClientOriginalExtension();
	        $destinationPath = public_path() . DS . 'uploads' . DS . $folder;
	        $file->move($destinationPath, $fname);
	    }

        //save asset to database... 
        $a = new SftAsset;
        $a->user_id = Auth::id();
        $a->itemname = $request->input('as_name');
        $a->assetype_id = $request->input('as_type');
        $a->is_declared = false;
        $a->details = $request->input('as_details');
        $a->valued_at = $request->input('as_value');
        $a->item_img = $fname;
        $a->save();

        return redirect()->back()->with('success', 'Asset Saved Successfully...');

    }


    public function mapAssets(){
        $objs = DB::table('assets')
        ->join('users', 'assets.user_id', '=', 'users.id')
        ->join('asseTypes', 'assets.assetype_id', '=', 'assetypes.id')

        ->where('users.id', Auth::id())
        ->get([
                'assets.itemname as assetitem',
                'assetypes.name as assetype',
                'assets.valued_at as value',
                'assets.mapping_id as amapid',
                'assets.id as id',
                'assets.created_at as cdate',

            ]);
        
        // pr($objs, true);

        return view('admin.mapassets')
                  ->with('crumbs', 'Assets')
                  ->with('pgtitle', 'Map All Assets')
                  ->with('objs', $objs);
      }



    public function getUnMappedRelatives($id){
        $r = Auth::user()->relatives;
        $s = '<p align="justify" style="font-size:12px !important;"> proceed with careful selection, and any extra information you would like to say... </p><label style="width:100%;text-align:left !important">Select Relative..</label>';
        $s .= '<div class="input-group">';
        $s .= '<select id="rltoptn" class="form-control" onchange="fixOptRel(this);"><option>.............</option>';

        foreach($r as $rt){
            $s .= '<option value="'.$rt->id.'" data-relation="'. $rt->relationship->name .'">'. $rt->firstname .' '.$rt->middlename . ' ' . $rt->lastname.'</option>';
        }

        echo $s .'</select><span class="input-group-addon"> - </span><input id="optrel" disabled="disabled" class="form-control"/></div> <input class="form-control" type="text" id="optin" placeholder="..extra information.."/> ';

    }



    public function mapAssetsOBJ(Request $request){
        DB::transaction(function() use($request){
            $m = new Mapping;
            $m->user_id = Auth::id();
            $m->relative_id = $request->input('rid');
            $m->extra_info = $request->input('rmsg');
            $m->save();

            //update mapping id on asset.... 
            $a = SftAsset::find(intval($request->input('aid')));
            $a->mapping_id = $m->id;
            $a->save();
        });
      
        echo 'Asset Mapped Successfully...';
    }


    public function pullMappingInfo($id){
        $m = Mapping::with(['asset','relative'])->find(intval($id));
        $sft = 'This Asset - <b>'. ucwords($m->asset->itemname).'</b> ('. $m->asset->asseType->name .' Asset) was mapped to your '.ucfirst($m->relative->relationship->name).', <b>'. $m->relative->firstname . ' '. $m->relative->middlename .' '. $m->relative->lastname . '</b> on date:<b>' . rdate($m->created_at, 'full') . '</b><hr/> with <b>Message :: </b><br/><small style="font-size:12px; color:#333333; line-height:3px;">' . $m->extra_info . '</small>';
        echo $sft;
       // pr($m);
    }

    public function removeMapping($id){
        DB::transaction(function()use($id){
            Mapping::find($id)->delete();
            SftAsset::where('mapping_id', $id)->update(['mapping_id'=>0]);
        });
        return redirect()->back()->with('success', 'Asset unmapped successfully...');
    }



}
