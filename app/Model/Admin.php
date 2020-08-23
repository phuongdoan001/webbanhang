<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	public $timestamps = false;
	protected $fillable = [
		'usnername','password','img','email','phone','role',
	];
	protected $primaryKey = 'id';
    protected $table="admin";

    public function roles(){
    	return $this->belongsToMany('App\Model\Roles');
    }
    public function hasRole($role){
 	
 		return null !== $this->roles()->where('name',$role)->first();
 	}
 	public function hasAnyRoles($roles){
 		return null !== $this->roles()->whereIn('name',$roles)->first();
 	}


}
