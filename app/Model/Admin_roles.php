<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_roles extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'admin_id','roles_id',
    ];
    protected $primaryKey = 'id';
    protected $table = "admin_roles";
}
