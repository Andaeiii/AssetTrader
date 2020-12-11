<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Relative extends Basemodel{
    
		protected $table = 'relatives';
		protected $guarded = [];


		public function user(){
			return $this->belongsTo('App\User', 'user_id');
		}

		public function mapping(){
			return $this->hasMany('App\Mapping', 'relative_id');
		}

		public function relationship(){
			return $this->belongsTo('App\Relationship', 'relationship_id');
		}

		public static function genISSCode(){
			$characters = '123BCHR456CHRE90ALI8G7OUSBFGHJKLMNZ';
			$pin = mt_rand(10000000, 99999999). mt_rand(1000000, 9999999). $characters[rand(0, strlen($characters) - 1)];		
			$str1 = substr(str_shuffle($pin), 0, 8);
			$num = strtoupper('iSS_'. $str1 . '_USER');
			if(self::where('iss_code', $num)->count() > 0){
				self::generateRetailNumber();
			}else{
				return $num;
			}
		}

		public static function migrate(){
			Schema::dropIfExists('relatives');
			Schema::create('relatives', function(Blueprint $table){

				$table->increments('id');
				$table->integer('user_id');
				$table->integer('relationship_id');

				$table->string('firstname');
				$table->string('middlename');
				$table->string('lastname');

				$table->date('date_of_birth');
				$table->string('phone');
				$table->string('sex');

				//$table->string('marital_status');
				$table->string('picture');
				$table->string('bvn_number');
				$table->string('iss_code'); //relative code unique to all relatives.

				$table->timestamps();
			});

			echo 'Relatives Table has been created successfully....';
		}

}
