<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
	public $timestamps = false;
    protected $table = "roles";
    protected $primaryKey = "id";
    protected $fillable = [
    	'name',
    ];
    public function admin(){
    	return $this->belongsToMany('App\Model\Admin');
    }

}
