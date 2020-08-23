@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
		<div class="card shadow mb-12">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tất Cả Đơn Hàng</h6>
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
                      <th>Mã Đơn Hàng</th>
                      <th>Ngày Tháng Đặt Hàng</th>
                      <th>Tình Trạng Đơn Hàng</th>
                      <th colspan="2">Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $i =1; ?>
                    @foreach($order as $order)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$order->code_order}}</td> 
                      <td>{{$order->timestamp}}</td>
                      <td>
                        @if($order->order_status == 1)
                            Đơn Hàng Mới
                        @elseif($order->order_status == 2)
                            Đã xác nhận đơn hàng
                        @elseif($order->order_status == 3)
                            Đơn hàng đang được gửi đi
                        @elseif($order->order_status == 4)
                            Đã tới kho nhận hàng
                        @elseif($order->order_status == 5)
                            Đang vận chuyển
                        @elseif($order->order_status == 6)
                            Hủy đơn hàng tạm giữ
                        @endif

                      </td>
                      <td><a href="{{URL::to('view-order',$order->code_order)}}"><span class="fas fa-eye"></span></a></td>
                      <td><a href="{{URL::to('delete-order',$order->code_order)}}" onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')"><span class="fas fa-trash-alt"></span></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
