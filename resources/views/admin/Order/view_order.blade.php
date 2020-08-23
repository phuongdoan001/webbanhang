@extends('admin.layout_show')
@section('content')
	<div class="col-lg-12">
		<div class="card shadow mb-12">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Thông Tin Đơn Hàng</h6>
            </div>
                 @if(Session::get('thongbao'))
                      <div class="alert alert-success">
                          {{Session::get('thongbao')}}
                          {{Session::put('thongbao',null)}}
                      </div>
                  @endif
            <div class="card-body">
              <h5 class="text-danger" style="text-align: center;">Thông Tin Khách Hàng</h5>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên Khách Hàng</th>
                      <th>Địa Chỉ Email</th>
                      <th>Địa Chỉ Khách Hàng</th>
                      <th>Số Điện THoại</th>
                      <th>Ghi Chú</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $i =1; ?>
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$customer->username}}</td> 
                      <td>{{$customer->email}}</td>
                      <td>{{$customer->address}}</td>
                      <td>{{$customer->phone}}</td>
                      <td>{{$customer->note}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
      <div class="col-lg-12">
    <div class="card shadow mb-12">
            <div class="card-body">
              <h5 class="text-danger" style="text-align: center;">Tình Trạng Đơn Hàng</h5>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Nã Đơn hàng</th>
                      <th>Phương Thức Thanh Toán</th>
                      <th>Tình Trạng Đơn Hàng</th>
                      <th>Ngày Đặt Hàng</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i =1; ?>
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$order->code_order}}</td>

                      <td>
                        @if($order->payment == 1)
                          Trả Tiền mặt
                        @endif
                      </td> 
                      <td>
                          @if($order->order_status == 1)
                            Đang xử lý
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
                      <td>{{$order->timestamp}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
    <div class="col-lg-12">
    <div class="card shadow mb-12">
            <div class="card-body">
              <h5 class="text-danger" style="text-align: center;">Thông Tin Chi Tiết Đơn Hàng</h5>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên Sản Phẩm</th>
                      <th>Hình Ảnh Sản Phẩm</th>
                      <th>Số Hàng Tồn Kho</th>
                      <th>Mã Giảm Giá</th>
                      <th>Phí Vận Chuyển</th>
                      <th>Số Lượng</th>
                      <th>Giá Sản Phẩm</th>
                      <th>Thành Tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i =1; ?>
                    @foreach($order_dt as $dt)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$dt->name}}</td>
                      <td><img src="{{URL::to('storage/app/public',$dt->image)}}" width="120px" height="70px"></td>
                      <td>{{$dt->product->product_qty}}</td>
                      <td>{{$dt->code_coupon}}</td>
                      <td>Free</td>
                      <td>{{$dt->qty}}</td>
                      <td>{{number_format($dt->price)}} Vnđ</td>
                      <td>{{number_format($dt->price*$dt->qty)}} Vnđ</td>
                    @endforeach
                  </tbody>
                </table>
              </div>

                    @if($coupon)
                      @if($coupon->coupon_condition == 1)
                        <p>Giá Trị Sử Dụng: <span>{{$coupon->coupon_name}}</span> </p>
                        <p>Giảm Giá: <span>{{$coupon->coupon_number}} %</span></p>
                        <p> Tổng Tiền Thanh Toán: <span> {{$order->order_total}}</span></p>
                      @else
                        <p>Giá Trị Sử Dụng: {{$coupon->coupon_name}}</p>
                        <p>Giảm Giá: {{$coupon->coupon_number}} Vnđ</p>
                        <p> Tổng Tiền Thanh Toán: <span> {{$order->order_total}}</span></p>
                      @endif
                    @else
                      <p> Tổng Tiền Thanh Toán: <span> {{$order->order_total}}</span></p>
                    @endif
                  <br>
                  <form action="{{URL::to('status-order',$order->id)}}" method="post">
                    @csrf
                    <select name="status_order">
                      <option>------Chọn Hình Thức------</option>
                      <option value="1">Đang Xử Lý</option>
                      <option value="2">Đã Xác Nhận Đơng Hàng</option>
                      <option value="3">Đơn Hàng Đang Được Gửi Đi</option>
                      <option value="4">Đã Tới Kho Nhận Hàng</option>
                      <option value="5">Đang Vận Chuyển</option>
                      <option value="6">Hủy Đơn Hàng-Tạm Giữ</option>
                    </select>
                    <input type="submit" name="" value="Thay Đổi" class="btn-primary">
                  </form>
            </div>
          </div>
    </div>
@endsection
