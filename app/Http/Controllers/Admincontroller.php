<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Model\categoryproduct;
use App\Model\product;
use Session;
session_start();

class Admincontroller extends Controller
{
   public function dashboard(){
   		return view('admin.layout_admin');
   }
   //Danh Mục Sản Phẩm
   public function category(){
   		return view('admin.add_category');
   }
   // Thêm Danh Mục
   public function add_category(Request $req){
         $this->validate($req,[
         'category_name' => 'required',
         ],[
         'category_name.required' => 'Tên danh mục không được để trống',
         ]);
   		$category = new categoryproduct;

   		$category->category_name   = $req->category_name;
   		$category->category_status = $req->status;

   		$category->save();
   		return Redirect::to('all-category');
   }
   //Hiển thị tất cả danh mục
   public function all_category(){
   		$category = categoryproduct::all();
   		return view('admin.all_category')->with('category',$category);
   }
   //Hiện danh mục
   public function active($id){
   		categoryproduct::where('id',$id)->update(['category_status' => 1]);
   		Session::put('thongbao','Hiện Thành Công');
   		return Redirect::to('all-category');
   }
   // ẩn danh mục
   public function unactive($id){
   		categoryproduct::where('id',$id)->update(['category_status' => 0]);
   		Session::put('thongbao','Ẩn Thành Công');
   		return Redirect::to('all-category');
   }
   //xóa danh mục
   public function delete($id){
   		$ct = categoryproduct::find($id);
   		$ct->delete();
   		Session::put('thongbao','Bạn Đã Xóa Thành Công');
   		return Redirect::to('all-category');
   }
   //tới trang chỉnh sửa danh mục
   public function editcategory($id){
         $category = categoryproduct::find($id);
         return view('admin.edit_category')->with('category',$category);
   }
   //chỉnh sửa danh mục
   public function updatecategory(Request $req,$id){
         $data = array();
         $data['category_name'] = $req->category_name;
         categoryproduct::where('id',$id)->update($data);

         return Redirect::to('all-category');  
   }
   // Sản phẩm
   public function product(){
      $category = categoryproduct::all();
      return view('admin.add_product')->with('category',$category);
   }
   //thêm sản phẩm
   public function add_product(Request $req){

      $this->validate($req,[
         'product_name' => 'required',
         'product_details'     => 'required',
         'product_price' => 'required',
         'product_qty' => 'required',
         'product_desc' => 'required',
         'file'     => 'required',
         ],[
         'product_name.required'       => 'Bạn chưa nhập tên sản phẩm',
         'product_details.required'    => 'Bạn chưa nhập chi tiết sản phẩm',
         'product_price.required'      => 'Bạn chưa nhập giá sản phẩm',
         'product_qty.required'        => 'Bạn chưa nhập số lượng sản phẩm',
         'product_desc.required'       => 'Bạn chưa nhập mô tả sản phẩm',
         'file.required'               => 'Hình ảnh không được để trống',
         ]);

      $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
      $images = $req->file;
      
      if($images){
         $get_name_image = $images->getClientOriginalName();
         $name_image = current(explode('.',$get_name_image));
         $new_image =  $name_image.rand(0,99).'.'.$images->getClientOriginalExtension();
         $images->move('storage/app/public',$new_image);

         $data = array();
         $product = new product;
         $product->category_id     =  $req->cate_id;
         $product->code_product    =  substr(str_shuffle($permitted_chars), 0, 20);
         $product->product_new     =  $req->product_new;
         $product->product_name    =  $req->product_name;
         $product->product_status  =  $req->product_status;
         $product->product_img     =  $new_image;  
         $product->product_price   =  $req->product_price;
         $product->product_qty     =  $req->product_qty;  
         $product->product_details =  $req->product_details;
         $product->product_desc    =  $req->product_desc;

         $product->save();
         Session::put('thongbao','Thêm sản phẩm thành công');
         return Redirect::to('product');

      }
      $product->product_img = '';
      $product->save();
      Session::put('thongbao','Thêm sản phẩm thành công');
      return Redirect::to('product');
   }
   // hiển thị tất cả sản phẩm
   public function all_product(){
      $product = product::all();
      return view('admin.all_product')->with('product',$product);
   }
   //hiện sản phẩm
   public function activeproduct($id){
         product::where('id',$id)->update(['product_status' => 1]);
         Session::put('thongbao','Hiện Thành Công');
         return Redirect::to('all-product');
   }
   // ẩn sản phẩm
   public function unactiveproduct($id){
         product::where('id',$id)->update(['product_status' => 0]);
         Session::put('thongbao','Ẩn Thành Công');
         return Redirect::to('all-product');
   }
   //xóa xóa sản phẩm
   public function deleteproduct($id){
         $ct = product::find($id);
         $ct->delete();
         Session::put('thongbao','Bạn Đã Xóa Thành Công');
         return Redirect::to('all-product');
   }
   //tới trang chỉnh sửa sản phẩm
   public function editproduct($id){
         $product = product::find($id);
         return view('admin.edit_product')->with('product',$product);
   }
   //chỉnh sửa sản phẩm
   public function updateproduct(Request $req,$id){
         $data = array();
         $data['product_name']    = $req->name_product;
         $data['product_price']   = $req->price_product;
         $data['product_qty']     = $req->qty_product;
         $data['product_details'] = $req->details_product;
         $data['product_new']     = $req->new_product;
         $data['product_desc']    = $req->desc_product;
         $images = $req->file('file');
         if($images){
            $get_name_image = $images->getClientOriginalName();
            $name_image     = current(explode('.',$get_name_image));
            $new_image      =  $name_image.rand(0,99).'.'.$images->getClientOriginalExtension();
            $images->move('storage/app/public',$new_image);
            $data['product_img']   = $new_image;
            product::where('id',$id)->update($data);
            Session::put('thongbao','Cập nhật sản phẩm thành công');

            return Redirect::to('all-product');  
         }

         product::where('id',$id)->update($data);
         Session::put('thongbao','Cập nhật sản phẩm thành công');

         return Redirect::to('all-product');  
   }

}
