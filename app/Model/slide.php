<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class slide extends Model
{	
	public $timestamps = false;
	 protected $fillable = [
    	'slider_name','slider_content','slider_images','slider_status'
    ];
    protected $primaryKey = 'id';
    protected $table = "slider";
}
