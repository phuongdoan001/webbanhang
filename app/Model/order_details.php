<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
	public $timestamps = false;
	 protected $fillable = [
    	'order_id','customer_id','code_order', 'product_id', 'name','image','price','qty','code_coupon'
    ];
    protected $primaryKey = 'id';
    protected $table = "order_details";
    public function order(){
    	return $this->belongsTo('App\Model\orders','code_order');
    }
    public function product(){
    	return $this->belongsTo('App\Model\product','product_id');
    }
}
