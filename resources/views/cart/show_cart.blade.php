@extends('welcome')
@section('content')
<div class="col-sm-9 border">
				<h3 class="p-4">Giỏ Hàng Của Bạn</h3>
				 @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
				<div class="table-responsive">
					<table class="table table-sm border table-primary text-dark">
						<thead>
							<tr class="bg-primary text-white">
								<th scope="col">Stt</th>
								<th scope="col">Tên Sản Phẩm</th>
								<th scope="col">Hình Ảnh</th>
								<th scope="col">Số Lượng</th>
								<th scope="col">Giá</th>
								<th scope="col">Thành Tiền</th>
								<th scope="col">Thao Tác</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							@foreach($cart as $cart)
							<tr>
								<td scope="row">{{$i++}}</td>
								<td>{{$cart->name}}</td>
								<td><img src="{{URL::to('storage/app/public',$cart->options->images)}}" style="width: 70px;height: 70px;"></td>
								<td>
									<form method="post" action="{{URL::to('update-cart')}}">
										@csrf
									<input type="number" name="cartqty" value="{{$cart->qty}}" style="width: 40px;height: auto;" min="1">
									<input type="hidden" name="rowId" value="{{$cart->rowId}}">
									<input type="submit" name="update_qty" value="Cập Nhật" class="btn-primary">
									</form>
								</td>
								<td>{{number_format($cart->price).' '.'Vnđ'}}</td>
								<td>{{number_format($cart->price * $cart->qty).' '.'Vnđ'}}</td>
									<td><a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" href="{{URL::to('delete-cart',$cart->rowId)}}"><span class="fas fa-trash-alt"></span></a></td>
							</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
				<div class="border p-3 col-sm-6 float-left">
						<form method="post" action="{{URL::to('check-coupon')}}">
							@csrf
							  <h5>Nhập Mã Giảm giá</h5>
							  
							  <input type="text" name="code_coupon" class="form-control" placeholder="Nhập mã giảm giá"><br>
							  <input type="submit" name="" class="btn btn-primary" value="Thêm Mã Giảm Giá">
							  @php 
									$cp = Session::get('coupon');
								@endphp
							  @if($cp)
							  <a href="{{URL::to('unset-coupon')}}" class="btn btn-primary">Xóa Mã Giảm Giá</a>
							  @endif
						</form>
				</div>
				<div class="border p-3 col-sm-6 float-right">
					<h3 style="text-align: center;" class="bg-primary text-white">Thanh Toán</h3>
							<ul class="tt">
								
								@if($cp)
									@foreach($cp as $cou)
										@if($cou['coupon_condition'] == 1)
											<li>Thành Tiền: <span>{{number_format(Cart::subtotal(null,null,''))}} Vnđ</span></li>
											<li>Phí Vận Chuyển: <span> Free</span></li>
											<li>Mã Giảm: <span> {{$cou['coupon_number']}} %</span></li>
												@php
													$total = (Cart::subtotal(null,null,'') * $cou['coupon_number'])/100;
													$onetotal = number_format(Cart::subtotal(null,null,'') - $total);
												@endphp
											<li>Tổng Tiền Đã Giảm: <span> {{$onetotal}} Vnđ</span></li>
										@elseif($cou['coupon_condition'] == 2)
											<li>Thành Tiền: <span>{{number_format(Cart::subtotal(null,null,''))}} Vnđ</span></li>
											<li>Phí Vận Chuyển: <span> Free</span></li>
											<li>Mã Giảm: <span> {{number_format($cou['coupon_number'])}} Vnđ</span></li>
												@php
													$total = number_format(Cart::subtotal(null,null,'') - $cou['coupon_number']);
												@endphp
											<li>Tổng Tiền Đã Giảm: <span> {{$total}} Vnđ</span></li>
										@endif
									@endforeach
								@else
									<ul class="tt">
										<li>Thành Tiền: <span>{{number_format(Cart::subtotal(null,null,''))}} Vnđ</span></li>
										<li>Phí Vận Chuyển: <span>Free</span></li>
										<li>Tổng Tiền: <span>{{number_format(Cart::subtotal(null,null,''))}} Vnđ</span></li>
									</ul>

								@endif

							</ul>
				 	  		<a href="{{URL::to('/')}}" class="btn btn-primary">Tiếp Tục Mua Hàng</a>
						  	@if(Session::get('id') != null)
						  		<a href="{{URL::to('order')}}" class="btn btn-primary">Mua Hàng</a>
						  	@else
						  		<a href="{{URL::to('log-in')}}" class="btn btn-primary" onclick="alert('Bạn cần phải đăng nhập trước khi mua hàng!')" > Mua Hàng</a>
						 	@endif
				</div>
			</div>
@endsection