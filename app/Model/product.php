<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
	public $timestamps = false;
    protected $table = "product";
    protected $fillable = [
    	'category_id','code_product', 'product_new', 'product_desc','product_name','product_status','product_img','product_price'
		,'product_qty','product_details',  

	  ];
    protected $primaryKey = 'id';
    
    public function category()
    {
    	return $this->belongsTo('App\Model\categoryproduct','id');
    }
}
