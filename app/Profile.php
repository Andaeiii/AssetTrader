<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Profile extends Basemodel{
    
    protected $table = 'profiles';
    protected $guarded = [];

    public function user(){
    	return $this->hasOne('App\User', 'user_id');
    }

    public static function migrate(){

        Schema::dropIfExists('profiles');
        Schema::create('profiles', function(Blueprint $table){

            $table->increments('id');
            $table->integer('user_id');
            $table->integer('lga_id');

            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');

            $table->string('address');
            $table->string('user_img');
            $table->string('date_of_birth');

            $table->string('occupation');
            $table->string('employment');
            $table->string('nationality');

            $table->timestamps();
        });

        self::create([
        	'user_id' => 1,
        	'lga_id' => 56,
        	'firstname' => 'Aminu',
        	'lastname' => 'Mohammed'
        ]);

        echo 'profile table migrated successfully...';

    }
}
