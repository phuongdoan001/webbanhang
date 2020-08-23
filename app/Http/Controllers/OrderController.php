<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\orders;
use App\Model\product;
use App\Model\order_details;
use App\Model\customer;
use Illuminate\Support\Facades\Redirect;
use App\Model\coupon;

class OrderController extends Controller
{
    public function all_order(){
    	$order = orders::all();

    	return view('admin.order.all_order')->with('order',$order);
    }
    public function view_order($order_code){
    	$order = orders::where('code_order',$order_code)->first();
    	$customer = customer::where('id',$order->customer_id)->first();
    	$order_dt = order_details::with('product')->where('code_order',$order_code)->get();

    	foreach ($order_dt as $key => $value) {
    		$coupon = coupon::where('coupon_code',$value->code_coupon)->first();
    	}

    	return view('admin.order.view_order')->with('order',$order)->with('customer',$customer)->with('order_dt',$order_dt)->with('coupon',$coupon);
    }
    public function status_order(Request $req,$id){

    	$od = orders::where('id',$id)->first();

    	$order_dt = order_details::with('product')->where('code_order',$od->code_order)->get();

    	$data = array(
    		'order_status' => $req->status_order,
    	);


        orders::where('id',$id)->update($data);

        if ($od->order_status == 1) {
            foreach ($order_dt as $key) {
                $product['product_qty'] = $key->product->product_qty;
                product::where('id',$key->product_id)->update($product);
            }
        }elseif($od->order_status ==2){
            foreach ($order_dt as $key) {
                $product['product_qty'] = $key->product->product_qty;
                product::where('id',$key->product_id)->update($product);
            }
        }elseif($od->order_status ==3){
            foreach ($order_dt as $key) {
                $product['product_qty'] = $key->product->product_qty - $key->qty;
                product::where('id',$key->product_id)->update($product);
            }
        }elseif($od->order_status ==4){
             foreach ($order_dt as $key) {
                $product['product_qty'] = $key->product->product_qty;
                product::where('id',$key->product_id)->update($product);
            }
        }elseif($od->order_status ==5){
             foreach ($order_dt as $key) {
                $product['product_qty'] = $key->product->product_qty;
                product::where('id',$key->product_id)->update($product);
            }
        }elseif($od->order_status ==6){
             foreach ($order_dt as $key) {
                $product['product_qty'] = $key->product->product_qty+$key->qty;
                product::where('id',$key->product_id)->update($product);
            }
        }
    	
    	return Redirect::to('all-order');
    }
    public function delete_order($code_order){
    	$od = orders::where('code_order',$code_order)->delete();
    	return Redirect::to('all-order');
    }
}
