<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class categoryproduct extends Model
{
	public $timestamps = false;
   	protected $table = "category_product";
   	protected $fillable = [
    	'category_name','category_status' 

	  ];
	protected $primaryKey = 'id';
    public function product(){
    	return $this->hasMany('App\Model\product','id');
    }
}
