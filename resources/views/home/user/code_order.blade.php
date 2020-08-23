@extends('home.user.layout_user')
@section('content')
	<div class="container-fluid">
		
		<div class="col-sm-4 bg-white border">
			<h4>Mã Đơn Hàng Của Bạn</h4>
			@foreach($order as $order)
			<p style="border: 0.1px solid black;"><a href="{{URL::to('puchase-menu',$order->code_order)}}">{{$order->code_order}}</a></p>
			@endforeach
		</div>

	</div>
@endsection