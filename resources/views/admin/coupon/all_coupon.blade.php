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
                      <th>Tên Mã Giảm Giá</th>
                      <th>Mã Giảm Giá</th>
                      <th>Số Lượng Giảm Giá</th>
                      <th>Điều Kiện Giảm Giá</th>
                      <th>Số Giảm</th>
                      <th>Thao Tác</th>
                  </thead>
                  <tbody>
                  	@php $i = 1; @endphp
                  	@foreach($coupon as $coupon)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$coupon->coupon_name}}</td>
                      <td>{{$coupon->coupon_code}}</td>
                      <td>{{$coupon->coupon_time}}</td>
                       <td>
                          @if($coupon->coupon_condition == 1)
                             Giảm Theo Phần Trăm
                          @else
                              Giảm Theo Tiền
                          @endif
                       </td>

                      <td>
                        @if($coupon->coupon_condition==1)
                            {{$coupon->coupon_number}} %
                        @else
                          
                          {{number_format($coupon->coupon_number).' '.'Vnđ'}}
                        @endif
                      </td>
                      <td><a href="{{URL::to('delete-coupon',$coupon->id)}}" onclick="return confirm('Bạn có chắc là muốn xóa mã giảm giá này không?')"><span class="fas fa-trash-alt"></span></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
