@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
		<div class="card shadow mb-12">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tất Cả Danh Mục</h6>
            </div>
                 @if(Session::get('thongbao'))
                      <div class="alert alert-success">
                          {{Session::get('thongbao')}}
                          {{Session::put('thongbao',null)}}
                      </div>
                  @endif
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên Danh Mục</th>
                      <th>Hình ảnh</th>
                      <th>Trạng Thái</th>
                      <th colspan="2">Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $i =1; ?>
                  	@foreach($poster as $pt)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$pt->poster_name}}</td> 
                      <td><img src="{{URL::to('storage/app/public',$pt->poster_images)}}" height="200px" width="500px;"></td>
                      <td>
                      	@if($pt->poster_status==1)
                      		<a href="{{URL::to('un-poster',$pt->id)}}"><i class="fas fa-thumbs-up"></i></a>
                     	  @else
                      		<a href="{{URL::to('active-poster',$pt->id)}}"><i class="fas fa-thumbs-down"></i></span></a>
                      	@endif
                      </td>
                      <td><a href="{{URL::to('delete-poster',$pt->id)}}" onclick="return confirm('Bạn có chắc là muốn xóa slider này không?')"><span class="fas fa-trash-alt"></span></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
