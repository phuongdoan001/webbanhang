<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\product;
use App\Model\categoryproduct;
use App\Model\customer;
use App\Model\orders;
use App\Model\order_details;
use App\Model\coupon;
use App\Model\slide;
use App\Model\Poster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Session;
session_start();
class Cartcontroller extends Controller
{

	public function check_coupon(Request $req){
		$cp = $req->code_coupon;
		$coupon = coupon::where('coupon_code',$cp)->first();
		if ($coupon) {
			$count_coupon = $coupon->count();
			if ($count_coupon >0 ) {
				$coupon_session = Session::get('coupon');
				if ($coupon_session == true) {
					$avaibale = 0;
					if ($avaibale == 0) {
						$cou[] = array(
							'coupon_condition' => $coupon->coupon_condition,
							'coupon_number'	   => $coupon->coupon_number,
							'coupon_code'	   => $coupon->coupon_code,
						);
						Session::put('coupon',$cou);
					}
				}else{
					 $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
               		 Session::put('coupon',$cou);
				}
				 Session::save();
           	 return redirect()->back()->with('message','Thêm mã giảm giá thành công');
			}
			}else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
       		}
	}
	public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
    public function add_cart(Request $req){
    	$id = $req->hidden;
    	$qty = $req->qty;
    	$product = product::where('id',$id)->first();

    	$data = array();
    	$data['id'] 	= $id;
    	$data['name'] 	=  $product->product_name;
    	$data['qty'] 	= $qty;
    	$data['price'] 	= $product->product_price;
    	$data['weight']	= $product->product_price;
    	$data['options']['images'] = $product->product_img;

    	Cart::add($data);
    	return Redirect::to('show-cart');
	}
	public function show_cart(){
		$category = new categoryproduct;
 		$cate = $category::all();
 		$slider = slide::all();
 		$poster     = Poster::all();

 		$cart = Cart::content();
		return view('cart.show_cart')->with('category',$cate)->with('cart',$cart)->with('slider',$slider)->with('poster',$poster);
	}
	public function update_cart(Request $req){
		$rowId = $req->rowId;
		$qty = $req->cartqty;

		Cart::update($rowId,$qty);
		return Redirect::to('show-cart');
	}
	public function delete_cart($id){
		Cart::remove($id);
		return Redirect::to('show-cart');
	}
	public function order(){
		$category = new categoryproduct;
 		$cate = $category::all();
 		$slider = slide::all();
 		$poster     = Poster::all();

 		$id = Session::get('id');
	
 		$customer = customer::find($id);
 		$cart = Cart::content(); 		

		return view('cart.order_place')->with('category',$cate)->with('cart',$cart)->with('customer',$customer)->with('slider',$slider)->with('poster',$poster);
	}
	public function payment(Request $req){
		$this->validate($req,[
	   		'customer_name'    => 'required',
	   		'customer_address' => 'required',
	   		'customer_phone'   => 'required|min:10|max:10',
	      	'payment'          => 'required',
		   ],[
	  		'customer_name.required'   => 'Bạn chưa nhập họ và tên',
	  		'customer_address.required'=> 'Bạn chưa nhập địa chỉ giao hàng',
	  		'customer_phone.required'  => 'Bạn chưa nhập số điện thoại',
	  		'customer_phone.min'	   => 'Số điện thoại không được dưới 10 số là trên 10 số',
	  		'customer_phone.max'	   => 'Số điện thoại không được dưới 10 số là trên 10 số',
	  		'payment.required'		   => 'Bạn chưa chọn phương thức thanh toán'
	   ]);


		$id = Session::get('id');

		$data = array();

		$data['username'] = $req->customer_name;
		$data['address']  = $req->customer_address;
		$data['phone']    = $req->customer_phone;
		$data['note']     = $req->customer_note;

		customer::where('id',$id)->update($data);

		$code = substr(md5(microtime()),rand(0,26),5);
		$order = new orders;

		$order->customer_id 	= $id;
		$order->code_order  	= $code;
		$order->payment     	= $req->payment;
		$order->order_status    = 1;
		$order->order_total     = $req->total;
		$order->save();

		$cart = Cart::content();

		foreach ($cart as $value) {
			$order_details = new order_details;

			$order_details->order_id    = $order->id;
			$order_details->code_order  = $code;
			$order_details->product_id  = $value->id;
			$order_details->name        = $value->name;
			$order_details->image       = $value->options->images;
			$order_details->price 	    = $value->price;
			$order_details->qty   	    = $value->qty;
			if(Session::get('coupon')){
				foreach (Session::get('coupon') as $key) {
					$order_details->code_coupon = $key['coupon_code'];
				}
			}
			$order_details->save();
		}
		if ($order->payment == 1) {
			Cart::destroy();
			Session::forget('coupon');
			return Redirect::to('/');
		}
	}
}
