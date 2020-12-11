<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Mapping extends Basemodel{
    
	protected $table = 'mappings';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public function relative(){
		return $this->belongsTo('App\Relative', 'relative_id');
	}		
	public function asset(){
		return $this->hasOne('App\Asset', 'mapping_id');
	}

	public static function migrate(){
		Schema::dropIfExists('mappings');
		Schema::create('mappings', function(Blueprint $table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('relative_id');
			//$table->integer('asset_id');
			$table->string('extra_info');
			$table->timestamps();
		});

		echo 'Mappings table created successfully....';
	}

}
