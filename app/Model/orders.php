<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
	public $timestamps = false;
    protected $table = "orders";
    	protected $fillable = [
    	'order_id','customer_id','code_order','payment','order_status','order_total'

	  ];
	protected $primaryKey = 'id';
    public function customer(){
    	return $this->belongsTo('App\Model\customer');
    }
    public function order_details(){
    	return $this->hasMany('App\Model\order_details','order_id');
    }
    
}
