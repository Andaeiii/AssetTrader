<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class AsseType extends Basemodel{
    
	protected $table = 'assetypes';
	protected $guarded = [];
	public $timestamps = false;

	public function assets(){
		return $this->hasMany('App\Asset', 'assetype_id');
	}

	public static function migrate(){
		Schema::dropIfExists('assetypes');
		Schema::create('assetypes', function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->string('filetype');
			$table->string('description');
		});


		$types = explode(';','virtual;physical;paper');
		$files = explode(';', 'docs;docs;imgs');
		for($i=0;$i<count($types); $i++){
			self::create([
				'name'		  => ucfirst($types[$i]),
				'filetype'	  => $files[$i],
				'description' => 'contains '. $files[$i] .' assets'
			]);
		}

		echo 'assetypes created/seeded accordingly....';

	}

}
