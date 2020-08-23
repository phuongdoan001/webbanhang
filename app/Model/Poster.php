<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
   public $timestamps = false;
	protected $fillable = [
    	'poster_name','poster_images','poster_status'
    ];
    protected $primaryKey = 'id';
    protected $table = "poster";
}
