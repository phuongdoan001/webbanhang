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
                      <th>Trạng Thái</th>
                      <th colspan="2">Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $i =1; ?>
                  	@foreach($category as $ct)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$ct->category_name}}</td> 
                      <td>
                      	@if($ct->category_status==1)
                      		<a href="{{URL::to('un-active',$ct->id)}}"><i class="fas fa-thumbs-up"></i></a>
                     	  @else
                      		<a href="{{URL::to('active',$ct->id)}}"><i class="fas fa-thumbs-down"></i></span></a>
                      	@endif
                      </td>
                      <td><a href="{{URL::to('edit-category',$ct->id)}}"><span class="fas fa-wrench"></span></a></td>
                      <td><a href="{{URL::to('delete',$ct->id)}}" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')"><span class="fas fa-trash-alt"></span></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
