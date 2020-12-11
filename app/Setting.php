<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;


class Setting extends Basemodel{

	protected $table = 'user_settings';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public static function migrate(){
		Schema::dropIfExists('user_settings');
		Schema::create('user_settings', function(Blueprint $table){
			$table->increments('id');
			$table->integer('user_id');
			$table->boolean('terms_condition')->default(false);
			$table->boolean('email_confirmation_sent')->default(false);
			$table->boolean('bvn_verification')->default(false);
			$table->string('details');
			$table->timestamps();
		});

		self::create([ 'user_id' => 1 ]);

		echo 'settings table migrated/seeded accordingly... ';
	}


}
