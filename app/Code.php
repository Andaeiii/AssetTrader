<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Code extends Basemodel{

	protected $table = 'codes';

   public function user(){
   	 return $this->belongsTo('App\User', 'user_id');
   }

   public static function genUserCode(){
		$characters = '123BCHR456CHRE90ALI8G7OUSBFGHJKLMNZ';
		$pin = mt_rand(1000000, 9999999). mt_rand(1000000, 9999999). $characters[rand(0, strlen($characters) - 1)];
		$pin2 = mt_rand(1000000, 9999999). mt_rand(1000000, 9999999). $characters[rand(0, strlen($characters) - 1)];		
		$str1 = substr(str_shuffle($pin), 0, 5);
		$str2 = substr(str_shuffle($pin2), -3, 3);
		$num = strtoupper('iSS_'. $str2.'_ME_'.$str1);
		if(self::where('code', $num)->count() > 0){
			self::generateRetailNumber();
		}else{
			return $num;
		}
	}

	 public static function migrate(){
        Schema::dropIfExists('codes');
        Schema::create('codes', function (Blueprint $table){
                $table->increments('id');
                $table->integer('user_id');
                $table->string('code');		//all church images/files appends with the
                $table->timestamps();
        });

        $c = new Code();
        $c->code = self::genUserCode();
        $c->user_id = 1;
        $c->save();

        echo 'Codes Table / Seeding created successfully..... <br/>';
    }	

}
