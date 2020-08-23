@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
		<div class="card shadow mb-12">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tất Cả Sản Phẩm</h6>
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
                      <th>Mã Sản Phẩm</th>
                      <th>Tên Sản Phẩm</th>
                      <th>Hình Ảnh</th>
                      <th>Giá</th>
                      <th>Số Lượng</th>
                      <th>Trạng Thái</th>
                      <th colspan="2">Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $i =1; ?>
                  	@foreach($product as $product)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$product->code_product}}</td>
                      <td>{{$product->product_name}}</td>
                      <td>
                        <img src="{{URL::to('storage/app/public',$product->product_img)}}" style="height: 80px; width: 80px">
                      </td> 
                      <td>{{number_format($product->product_price).' '.'Vnđ'}}</td>
                       <td>{{$product->product_qty}}</td>
                      <td>
                      	@if($product->product_status==1)
                      		<a href="{{URL::to('un-activeproduct',$product->id)}}"><i class="fas fa-thumbs-up"></i></a>
                     	  @else
                      		<a href="{{URL::to('activeproduct',$product->id)}}"><i class="fas fa-thumbs-down"></i></span></a>
                      	@endif
                      </td>
                      <td><a href="{{URL::to('edit-product',$product->id)}}"><span class="fas fa-wrench"></span></a></td>
                      <td><a href="{{URL::to('deleteproduct',$product->id)}}" onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"><span class="fas fa-trash-alt"></span></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
