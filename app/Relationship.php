<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Relationship extends Basemodel{

	protected $table = 'relationships';
	protected $guarded = [];
	public $timestamps = false;

	public function relatives(){
		return $this->hasMany('App\Relative', 'relationship_id');
	}

	public static function migrate(){
		Schema::dropIfExists('relationships');
		Schema::create('relationships', function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
		});

		$ar = explode(';','father;mother;brother;sister;cousin;niece;nephew;uncle;aunt;parent;grandfather;grandmother;step-mother;step-father');
		$r = array();
		foreach($ar as $a){
			array_push($r, ['name'=>$a]);
		}
		self::insert($r);

		echo 'relationships table created/seeded accordingly....';
    }
}
