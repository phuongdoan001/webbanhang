<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
	public $timestamps = false;
    protected $table = "customer";
    	protected $fillable = [
    	'code_customer','username','images','email','password','address','phone','note','day','month','year','sex' 

	  ];
	protected $primaryKey = 'id';

    public function orders(){
    	return $this->hasMany('App\Model\orders');
    }
}

