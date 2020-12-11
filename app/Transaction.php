<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
Use Schema;

class Transaction extends Model{
    
	protected $table = 'transactions';
	protected $guarded = [];

	public function order(){
		return $this->belongsTo('App\Order', 'order_id');
	}

	public static function genNewREFCode(){
		$characters = '123B4567CHRCHRE90ALI8GIODFGJKMNPQRSTUVWXYZUS';
		$pin = mt_rand(). mt_rand(). $characters[rand(0, strlen($characters) - 1)];
		$stx = substr(str_shuffle($pin), 0, 9);
		$xcode = 'DEV_'. $stx;
		if(self::where('trans_ref', $xcode)->count() > 0){
			self::generateRetailNumber();
		}else{
			return $xcode;
		}

	}

	public static function migrate(){
	   Schema::dropIfExists('transactions');
	   Schema::create('transactions', function(Blueprint $table){
	        
	        $table->increments('id');
	        $table->integer('order_id');  
	 		$table->string('trans_ref');
	 		
    		$table->string('gateway_res');
    		$table->datetime('paid_at');	
    		$table->string('channel'); //card or cash..     		
    		$table->string('ip_address'); //ip address of location

    		$table->string('message');
    		$table->string('status');
    		$table->text('logs');				//serialized log info... 
    		$table->text('history');
    		$table->text('authorization_info'); //serialized bank info msg..
    		$table->timestamps();

	   });       

	   echo 'orders table created accordingly.... ';
	}

}
