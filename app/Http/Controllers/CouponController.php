<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Model\coupon;

use Session;
session_start();


class CouponController extends Controller
{
	public function coupon(){
		return view('admin.coupon.add_coupon');
	}
	public function add_coupon(Request $req){
		 $this->validate($req,[
         'coupon_name' 	  => 'required',
         'coupon_qty'     => 'required',
         'coupon_price'   => 'required',
         'coupon_code'    => 'required',
         ],[
         'coupon_name.required'   => 'Bạn chưa nhập tên mã giảm giá',
         'coupon_qty.required'    => 'Bạn chưa nhập số lượng mã',
         'coupon_price.required'  => 'Bạn chưa nhập số % hoặc số tiền',
         'coupon_code.required'   => 'Bạn chưa nhập mã giảm giá',
         ]);
         
		$coupon = new coupon;

		$coupon->coupon_name 	  = $req->coupon_name;
		$coupon->coupon_time 	  = $req->coupon_qty;
		$coupon->coupon_condition = $req->coupon_condition;
		$coupon->coupon_number	  = $req->coupon_price;
		$coupon->coupon_code  	  = $req->coupon_code;
		$coupon->save();

		return Redirect::to('all-coupon');
	}
	public function all_coupon(){
		$coupon  = coupon::all();
		return view('admin.coupon.all_coupon')->with('coupon',$coupon);
	}
	public function delete_coupon($id){

		$coupon = coupon::find($id);
		$coupon->delete();

		Session::put('thongbao','xóa thành công');
		return Redirect::to('all-coupon');
	}
}
