<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\slide;
use App\Model\Poster;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SliderController extends Controller
{
    public function slider(){
    	return view('admin.Slider.slider');
    }
    public function add_slider(Request $req){
    	$this->validate($req,[
    		'slider_name'	 => 'required',
    		'file' 			 => 'required',
    		'slider_content' => 'required',
    		'slider_status'  => 'required',

    	],[
    		'slider_name.required' 	  => 'Bạn chưa nhập tên slider',
    		'file.required' 	   	  => 'Bạn chưa chọn hình ảnh',
    		'slider_content.required' => 'Bạn chưa nhập nội dung',
    		'slider_status.required'  => 'Bạn chưa chọn trạng thái',
    	]);


    	$images = $req->file;

    	if($images){
    		$get_name_image = $images->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$images->getClientOriginalExtension();
            $images->move('storage/app/public', $new_image);

			$slider = new slide;

			$slider->slider_name    = $req->slider_name;
			$slider->slider_content = $req->slider_content;
			$slider->slider_status  = $req->slider_status;
			$slider->slider_images  = $new_image;

			$slider->save();
			Session::put('message','Thêm slider thành công');
            return Redirect::to('slider');
    	}else{
    		return Redirect::to('slider');
        }
    }
    public function all_slider(){
    	$slider = slide::all();
    	return view('admin.Slider.all_slider')->with('slider',$slider);
    }
    public function un_slider($id){

    	slide::where('id',$id)->update(['slider_status'=>0]);
    	Session::put('thongbao','Đã Ẩn Thành Công');
    	return Redirect::to('all-slider');

    }
    public function active_slider($id){
    	slide::where('id',$id)->update(['slider_status'=>1]);
    	Session::put('thongbao','Đã Hiện Thành Công');
    	return Redirect::to('all-slider');
    }
    public function delete_slider($id){
    	$slide = slide::find($id);
    	$slide->delete();
    	Session::put('thongbao','Đã Xóa Thành Công');
    	return Redirect::to('all-slider');
    }

}
