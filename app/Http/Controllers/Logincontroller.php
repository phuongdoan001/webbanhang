<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Session;
use DB;
session_start();
class Logincontroller extends Controller
{
  public function reg(){
    return view('home.register');
  }
   public function register(Request $req){
   	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

   	$this->validate($req,[
   		'username' => 'required',
   		'email'	   => 'required',
   		'password' => 'required|min:3|max:16',
      'file'     => 'required',
	   ],[
  		'username.required' => 'Bạn chưa nhập họ và tên',
  		'email.required'	  => 'Bạn chưa nhập địa chỉ email',
  		'password.required' => 'Bạn chưa nhập mật khẩu',
  		'password.min'		  => 'Mật khẩu phải từ 3 ký tự trở lên và không quá 16 ký tự',
  		'password.max'		  => 'Mật khẩu phải từ 3 ký tự trở lên và không quá 16 ký tự',
      'file.required'     => 'Hình ảnh không được để trống',
	   ]);
    // upload tên và file ảnh
    $images = $req->file;
      
    if($images){
        $get_name_image = $images->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$images->getClientOriginalExtension();
        $images->move('storage/app/admin',$new_image);
    //Thêm dữ liệu đã lấy vào bảng customer
       	$customer = new customer;
       	$customer->code_customer = substr(str_shuffle($permitted_chars), 0, 20);
        $customer->images        = $new_image;
       	$customer->username  	   = $req->username;
       	$customer->email    	   = $req->email;
       	$customer->password 	   = md5($req->password);

       	$customer->save();

   	    Session::put('id',$customer->id);
        Session::put('images',$customer->images);
   	    Session::put('username',$customer->username);
   	    return Redirect::to('/');
    }
        $customer->images = '';
        $customer->save();

        Session::put('id',$customer->id);
        Session::put('images',$customer->images);
        Session::put('username',$customer->username);
        return Redirect::to('/');
   }

  public function log_in(){

      return view('home.login');
  }

  public function login(LoginRequest $req){
      $email = $req->taikhoan;
      $password = md5($req->matkhau);

      $customer = customer::where('email',$email)->where('password',$password)->first();
      if ($customer) {
          Session::put('id',$customer->id);
          Session::put('images',$customer->images);
          Session::put('username',$customer->username);
         return Redirect::to('/');
      }else{
        Session::put('thongbao','Tài khoản Hoặc Mật Khẩu Không đúng');
        return Redirect::to('log-in');
      }
  }
  public function logout(){
        Session::flush();
     	return Redirect::to('/');
  }
}
