<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Asset extends Basemodel{

	protected $table = 'assets';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public function assetype(){
		return $this->belongsTo('App\AsseType', 'assetype_id');
	}

	public function mapping(){
		return $this->belongsTo('App\Mapping', 'mapping_id');
	}

	public static function migrate(){
		Schema::dropIfExists('assets');
		Schema::create('assets', function(Blueprint $table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('assetype_id');
			$table->integer('mapping_id');
			$table->boolean('is_declared')->default(false);
			$table->string('itemname');
			$table->text('details');
			$table->string('item_img');
			$table->string('valued_at');
			$table->boolean('verified');
			$table->timestamps();
		});

		echo 'assets table created successfully..';
	}

}
