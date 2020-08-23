<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\categoryproduct;
use App\Model\product;
use Illuminate\Support\Facades\Redirect;
use App\Model\customer;
use App\Model\orders;
use App\Model\coupon;
use App\Model\order_details;
use App\Model\slide;
use App\Model\Poster;
use Session;
session_start();
class Homecontroller extends Controller
{
   public function index(Request $req){

 		$category   = new categoryproduct;
 		$cate       = $category::where('category_status','=',1)->get();
 		$product    = new product;
 		$allproduct = $product::where('product_new','=',1)->where('product_status','=',1)->orderby('id','desc')->paginate(21);
    $slider     = slide::all(); 
    $poster     = Poster::all();

    if ($req->isMethod('get')) {
        $search = $req->keyword;
        if ($search) {
            Session::put('value',$search);
            $cate       = $category::where('category_status','=',1)->get();
            $allproduct = $product::where('product_name','like','%'.$search.'%')->paginate(21);
            $slider     = slide::all(); 
            $poster     = Poster::all();
        }
    }


 		return view('home.home')->with('category',$cate)->with('allproduct',$allproduct)->with('slider',$slider)->with('poster',$poster);
 	}
 	public function show_category(Request $req,$id){
 		$category = new categoryproduct;
 		$cate     = $category::where('category_status','=','1')->get();
 		$name     = $category::where('id',$id)->get();
    $slider   = slide::all();
    $poster   = Poster::all();

 		$product = new product;
 		$pd = $product::where('category_id',$id)->where('product_status','=',1)->orderby('id','desc')->paginate(6);

    if ($req->isMethod('get')) {
        $search = $req->keyword;
        if ($search) {
            Session::put('value',$search);
            $cate       = $category::where('category_status','=',1)->get();
            $name       = $category::where('id',$id)->get();
            $pd         = $product::where('category_id',$id)->where('product_name','like','%'.$search.'%')->paginate(6);
            $slider     = slide::all(); 
            $poster     = Poster::all();
        }
    }

 		if ($req->orderby) {
            $orderby = $req->orderby;
            switch ($orderby) {
                case 'asc':
                       $pd = $product::where('category_id',$id)->where('product_status','=',1)->orderby('product_price','asc')->paginate(6);
                    break;
                case 'desc':
                       $pd = $product::where('category_id',$id)->where('product_status','=',1)->orderby('product_price','desc')->paginate(6);
                    break;
                default:
                        $pd = $product::where('category_id',$id)->where('product_status','=',1)->orderby('product_price','desc')->paginate(6);
                 break;
            }
        }

 		return view('home.show_category')->with('product',$pd)->with('category',$cate)->with('name',$name)->with('slider',$slider)->with('poster',$poster);
 		
 	}

 	public function details($id){
 		$category = new categoryproduct;
 		$cate = $category::all();
    $slider = slide::all();
    $poster     = Poster::all();

 		$product = new product;
 		$pd = $product::where('id',$id)->get();
 		foreach ($pd as $value) {
 			$category_id = $value->category_id;
 		}
 		$spcl = $product::where('category_id',$category_id)->orderby('id','desc')->paginate(3);
 		return view('home.details')->with('category',$cate)->with('detail',$pd)->with('allspcl',$spcl)->with('slider',$slider)->with('poster',$poster);
 	}
  public function user(){
    $id = Session::get('id');
    $customer = customer::where('id',$id)->first();
    return view('home.user.user')->with('customer',$customer);
  }
  public function edit_user(Request $req,$id){

      $data = array();
      $data['username'] = $req->name;
      $data['email']    = $req->email;
      $data['address']  = $req->address;
      $data['phone']    = $req->phone;
      $data['day']      = $req->day;
      $data['month']    = $req->month;
      $data['year']     = $req->year;
      $data['sex']      = $req->sex;

      customer::where('id',$id)->update($data);
      return Redirect::to('user');
  }
  public function code_order(){
      $id  = Session::get('id');
      $order =  orders::where('customer_id',$id)->get();


      return view('home.user.code_order')->with('order',$order);
  }
  public function puchase_menu($code_order){

    $or_dt = order_details::with('order')->where('code_order',$code_order)->get();
    $order = orders::where('code_order',$code_order)->with('order_details')->first();

    foreach ($order->order_details as $key => $value) {
          $coupon = coupon::where('coupon_code',$value->code_coupon)->first();
    }


    return view('home.user.puchase_menu')->with('order_dt',$or_dt)->with('order',$order)->with('coupon',$coupon);

  }
  public function custody($id){

      $data = array();
      $data['order_status'] = 6;

      orders::where('id',$id)->update($data);

      return redirect()->back();

  }
  public function check_images(Request $req,$id){
      $images = $req->file;
     
       if($images){
        $get_name_image = $images->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$images->getClientOriginalExtension();
        $images->move('storage/app/admin',$new_image);

        $data['images'] = $new_image;
        customer::where('id',$id)->update($data);
        Session::forget('images');
        Session::put('images',$data['images']);
      }
       return redirect()->back();
  }


}
