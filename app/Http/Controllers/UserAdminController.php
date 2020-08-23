<?php

namespace App\Http\Controllers;
use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Model\Roles;
use Session;
class UserAdminController extends Controller
{
	public function Authlogin(){
		$id = Auth::id();
		if ($id) {
			return Redirect::to('dashboard');
		}else{
			return Redirect::to('authlogin');
		}
	}
 	public function user_admin(){
 		$this->Authlogin();
 		return view('admin.User.add_user');
 	}
 	public function save_user(Request $req){
 		$this->Authlogin();
 		$this->validate($req,[
	   		'username' 	   => 'required',
	   		'email'	       => 'required',
	   		'password'        => 'required|min:3|max:16',
	   		'phone'	   => 'required|min:10|max:10',
	      	'file_name'         => 'required',
		   ],[
	  		'username.required'     => 'Bạn chưa nhập họ và tên',
	  		'email.required'	    => 'Bạn chưa nhập địa chỉ email',
	  		'password.required'     => 'Bạn chưa nhập mật khẩu',
	  		'password.min'	  		=> 'Mật khẩu phải từ 3 ký tự trở lên và không quá 16 ký tự',
	  		'password.max'	  		=> 'Mật khẩu phải từ 3 ký tự trở lên và không quá 16 ký tự',
	      	'file_name.required'    => 'Hình ảnh không được để trống',
	      	'phone.required'	    => 'Số điện thoại không được để trống',
	      	'phone.min'		  		=> 'Số điện thoại không được dưới 10 số là trên 10 số',
	      	'phone.max'	      		=> 'Số điện thoại không được dưới 10 số là trên 10 số',
	   ]);
 		$images = $req->file_name;
		if($images){
	     	$get_name_image = $images->getClientOriginalName();
	     	$name_image = current(explode('.',$get_name_image));
	     	$new_image =  $name_image.rand(0,99).'.'.$images->getClientOriginalExtension();
	     	$images->move('storage/app/admin',$new_image);

			$admin = new Admin;
			$admin->username  = $req->username;
			$admin->email = $req->email;
			$admin->img 		= $new_image;
			$admin->phone	= $req->phone;
			$admin->password    = bcrypt($req->password);

			$admin->save();
			Session::put('message','Thêm user thành công');
			return redirect()->back();
		}
		$admin->img = '';
		Session::put('message','Thêm user thành công');
		$admin->save();
		return redirect()->back();

 	}
 	public function all_user(){
 		$this->Authlogin();
 		$admin = Admin::with('roles')->orderby('id','desc')->paginate(3);
 		return view('admin.User.all_user')->with(compact('admin'));
 	}
 	public function assign_roles(Request $request){
 		$this->Authlogin();
 		$data = $request->all();
        $user = Admin::where('email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['author_role']){
           $user->roles()->attach(Roles::where('name','author')->first());     
        }
        if($request['user_role']){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        Session::put('thongbao','Phân quyền cho user thành công');
 		return redirect()->back();
 	}
 	public function delete_user($id){
 		if (Auth::id() == $id) {
 				return redirect()->back()->with('thongbao','Bạn Không được quyền xóa chính mình');
 		}
 		$admin = Admin::find($id);
 		if ($admin) {
 			$admin->roles()->detach();
 			$admin->delete();
 		}
 		return redirect()->back()->with('thongbao','Xóa User thành công');
 	}
}
