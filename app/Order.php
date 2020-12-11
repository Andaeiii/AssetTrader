<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
Use Schema;

class Order extends Model{
    
	protected $table = 'orders';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public function transaction(){
		return $this->hasOne('App\Transaction', 'order_id');
	}

	public function scopeType($query, $type){
		return $query->where('channel', $type);
	}

	public static function migrate(){
	   Schema::dropIfExists('orders');
	   Schema::create('orders', function(Blueprint $table){
	        
	        $table->increments('id');
	        $table->integer('user_id');  
	        $table->string('channel'); //cash or paystack -cash(transaction = true)        
	        $table->integer('amount');
	        $table->string('status'); //started, finished - complete... 
	        $table->timestamps();

	   });       

	   echo 'orders table created accordingly.... ';
	}

}
