<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Model\Admin;
use Session;
session_start();

class LoginAdmincontroller extends Controller
{

	public function regauth(){
		return view('admin.register');
	}
	public function registerauth(Request $req){
		$this->validate($req,[
	   		'name_admin' 	   => 'required',
	   		'email_admin'	   => 'required',
	   		'password_admin'   => 'required|min:3|max:16',
	   		'phone_admin'	   => 'required|min:10|max:10',
	      	'file'        	   => 'required',
		   ],[
	  		'name_admin.required'     => 'Bạn chưa nhập họ và tên',
	  		'email_admin.required'	  => 'Bạn chưa nhập địa chỉ email',
	  		'password_admin.required' => 'Bạn chưa nhập mật khẩu',
	  		'password_admin.min'	  => 'Mật khẩu phải từ 3 ký tự trở lên và không quá 16 ký tự',
	  		'password_admin.max'	  => 'Mật khẩu phải từ 3 ký tự trở lên và không quá 16 ký tự',
	      	'file.required'      	  => 'Hình ảnh không được để trống',
	      	'phone_admin.required'	  => 'Số điện thoại không được để trống',
	      	'phone_admin.min'		  => 'Số điện thoại không được dưới 10 số là trên 10 số',
	      	'phone_admin.max'	      => 'Số điện thoại không được dưới 10 số là trên 10 số',
	   ]);

		$images = $req->file;
      
        if($images){
         	$get_name_image = $images->getClientOriginalName();
         	$name_image = current(explode('.',$get_name_image));
         	$new_image =  $name_image.rand(0,99).'.'.$images->getClientOriginalExtension();
         	$images->move('storage/app/admin',$new_image);

			$admin = new Admin;
			$admin->username  = $req->name_admin;
			$admin->email = $req->email_admin;
			$admin->img 		= $new_image;
			$admin->phone	= $req->phone_admin;
			$admin->password    = bcrypt($req->password_admin);

			$admin->save();
			return Redirect::to('authlogin');
		}
		$admin->img = '';
		$admin->save();
		return Redirect::to('authlogin');

	}

    public function authlogin(){
   		return view('admin.login');
    }
    public function login_auth(Request $req){

    	$email = $req->admin_name;
    	$pass  = $req->admin_password;

    	if (Auth::attempt(['email' => $email, 'password' => $pass])) {

    		return Redirect::to('dashboard');
    	}else{
    		Session::put('thongbao','Đăng nhập thất bại');
    		return Redirect::to('authlogin');
    	}
    }
    public function logout_auth(){
    	Auth::logout();
    	return Redirect::to('authlogin');
    }
}
