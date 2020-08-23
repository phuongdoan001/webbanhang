<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
	public $timestamps = false;
		protected $fillable = [
    	'coupon_name','coupon_time','coupon_condition','coupon_number','coupon_code'

	  ];
	protected $primaryKey = 'id';
    protected $table = "coupon";

}
