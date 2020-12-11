<?php

namespace App;


use Illuminate\Database\Schema\Blueprint;
use Schema;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{

    use Notifiable;


    protected $table = 'users';
    protected $guarded = [];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\Profile', 'user_id');
    }

    public function assets(){
        return $this->hasMany('App\Asset', 'user_id');
    }

    public function code(){
        return $this->hasOne('App\Code', 'user_id');
    }

    public function mapping(){
        return $this->hasMany('App\Mapping', 'user_id');
    }

    public function setting(){
        return $this->hasOne('App\Setting', 'user_id');
    }

    public function relatives(){
        return $this->hasMany('App\Relative', 'user_id');
    }

    public static function migrate(){

        Schema::dropIfExists('users');
        Schema::create('users', function(Blueprint $table){

            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('bvn');
            $table->string('type');
            $table->date('last_login');

            $table->boolean('is_group')->default(false);

            $table->boolean('is_nextOfKin')->default(false);

            $table->boolean('is_lost')->default(false); //accessed by 

            $table->boolean('verified')->default(0); //next of kin is unverified by default...            
            $table->string('remember_token');
            $table->timestamps();

        });


        $u              = new User;
        $u->email       = 'aminu@gmail.com';
        $u->password    = bcrypt('123456');
        $u->type        = 'admin';
        $u->save();

        echo 'table migrated/seeded successfully... - xx';

    }


}
