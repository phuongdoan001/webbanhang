@extends('home.user.layout')
@section('content')
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="background: white; padding: 10px;">
	  <li class="nav-item" role="presentation">
	    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Chi Tiết Đơn Hàng</a>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  	<div class="col border" style="background: white;height: auto; margin-bottom: 30px;">
          <div class="row">
          	<div class="col p-2 border-bottom" style="color: red;">
	            <p class="float-left">Mã Đơn Hàng: <span>{{$order->code_order}}</span></p>
	            @if($order->order_status == 1)
	            <p class="float-right">Tình Trạng Đơn Hàng: <span> Đang Xử Lý</span></p>
	            @elseif($order->order_status == 2)
	            <p class="float-right">Tình Trạng Đơn Hàng: <span> Đang Xử Lý Đơn Hàng</span></p>
	            @elseif($order->order_status == 3)
	            <p class="float-right">Tình Trạng Đơn Hàng: <span> Đơn Hàng Đang Được Gửi Đi</span></p>
	            @elseif($order->order_status == 4)
	            <p class="float-right">Tình Trạng Đơn Hàng: <span> Đã Tới Kho Nhận Hàng</span></p>
	            @elseif($order->order_status == 5)
	            <p class="float-right">Tình Trạng Đơn Hàng: <span> Đang Vận Chuyển</span></p>
	            @elseif($order->order_status == 6)
	            <p class="float-right">Tình Trạng Đơn Hàng: <span> Đã Hủy</span></p>
	            @endif
	            <p class="float-right" style="margin-right: 10px;">Ngày Đặt Hàng: <span>{{$order->timestamp}}</span></p>
            </div>
          </div>

          @foreach($order_dt as $dt)
          <div class="col border-bottom p-3">
            <img src="{{URL::to('storage/app/public',$dt->image)}}" class="thumb" width="80px" height="80px">
            <b style="margin-top: 10px;">{{$dt->name}}</b>
            <div class="float-right">
              <p>Giá: <span>{{$dt->price}}</span></p>
              <p>Số Lượng: <span>{{$dt->qty}}</span></p>
            </div>
          </div>
           @endforeach
           @if($coupon)
           <div class="row p-4">
                <div class="">
                @if($coupon->coupon_condition == 1)
          		 	<li  class="float-right">Mã Giảm giá: {{$coupon->coupon_code}}</li>
          		 	<li>Đã Giảm: {{$coupon->coupon_number}} %</li>
          		@elseif($coupon->coupon_condition == 2)
          			<li>Mã Giảm giá: {{$coupon->coupon_code}}</li>
          			<li>Đã Giảm: {{$coupon->coupon_number}} Vnđ</li>
          		@endif
          		</div>
          	</div>
          @endif
          <div class="row">
          		<div class="col p-2">	
          			<h5 class="col">Tổng Số Tiền: <span>{{$order->order_total}}</span></h5>
          		</div>
          </div>
          <form method="post" action="{{URL::to('custody',$order->id)}}">
          	@csrf
          @if($order->order_status == 3 || $order->order_status == 4 || $order->order_status == 5 || $order->order_status == 6 )
	          	<div class="row">
	          		<div class="col p-3">
	          			<input type="submit" name="" class="btn btn-user btn-primary" disabled="" value="Hủy Đơn Hàng">
	          		</div>
	         	</div>
          @elseif($order->order_status == 1 || $order->order_status == 2)
          		<div class="row">
	          		<div class="col p-3">
	          			<input type="submit" name="" class="btn btn-user btn-primary" value="Hủy Đơn Hàng" onclick="return confirm('Bạn có chắc là muốn hủy đơn hàng này không?')">
	          		</div>
          		</div>
          @endif
          </form>
        </div>
	  </div>
	</div>
@endsection