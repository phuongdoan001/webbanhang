<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Poster;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class PosterController extends Controller
{
    public function Poster(){
        return view('admin.Poster.poster');
    }
    public function all_poster(){
        $poster = Poster::all();

        return view('admin.Poster.all_poster')->with('poster',$poster);
    }
    public function add_poster(Request $req){
        
        $this->validate($req,[
        	'poster_name'   =>'required',
        	'file_name'     => 'required',
        	'poster_status' => 'required',
        ],[
        	'poster_name.required' => 'Bạn chưa nhập tên poster',
        	'file_name.required'   => 'Bạn chưa chọn hình ảnh',
        	'poster_status'		   => 'Bạn chưa chọn trạng thái',
        ]);

        $images = $req->file_name;

        if ($images) {
        	$get_name_image = $images->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$images->getClientOriginalExtension();
            $images->move('storage/app/public', $new_image);

            $poster  = new Poster;
            $poster->poster_name = $req->poster_name;
            $poster->poster_images = $new_image;
            $poster->poster_status = $req->poster_status;

            $poster->save();
            Session::put('message','Thêm Poster Thành Công');
            return Redirect::to('Poster');
        }else{
        	Session::put('message','Thêm Poster Thất Bại');
    		return Redirect::to('slider');
        }

    }
    public function active_poster($id){

    	Poster::where('id',$id)->update(['poster_status'=>1]);
    	Session::put('thongbao','Hiện Poster Thành Công');
    	return Redirect::to('all-Poster');

    }
    public function un_poster($id){
    	Poster::where('id',$id)->update(['poster_status'=>0]);
    	Session::put('thongbao','Ẩn Poster Thành Công');
    	return Redirect::to('all-Poster');
    }
    public function delete_poster($id){
    	$poster = Poster::find($id);
    	$poster->delete();
    	Session::put('thongbao','XÓa Poster Thành Công');
    	return Redirect::to('all-Poster');
    }
}
