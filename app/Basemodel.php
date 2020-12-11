<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basemodel extends Model{
   
	public static function validate($data){	
		return Validator::make($data, static::$rules);
	}

}
