@extends('welcome')
@section('content')
	<div class="col-sm-9 border">
				<h3 class="p-4">Giỏ Hàng Của Bạn</h3>
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
							</tr>
						</thead>
						<tbody>
							<?php $i =1; ?>
							@foreach($cart as $cart)
							<tr>
								<td scope="row">{{$i++}}</td>
								<td>{{$cart->name}}</td>
								<td><img src="{{URL::to('storage/app/public',$cart->options->images)}}" style="width: 70px;height: 70px;"></td>
								<td>{{$cart->qty}}</td>
								<td>{{number_format($cart->price).' '.'Vnđ'}}</td>
								<td>{{number_format($cart->price * $cart->qty).' '.'Vnđ'}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<form action="{{URL::to('payment')}}" method="post">
						@csrf
				<div class="border p-3 col-sm-6 float-right">
					<h3 style="text-align: center;" class="bg-primary text-white">Thanh Toán</h3>
							<ul class="tt">
								@php
									$cp = Session::get('coupon');
								@endphp
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
											<input type="hidden" name="total" value="{{$onetotal}}">
											<li>Tổng Tiền Đã Giảm:<span> {{$onetotal}} Vnđ</span></li>
										@elseif($cou['coupon_condition'] == 2)
											<li>Thành Tiền: <span>{{number_format(Cart::subtotal(null,null,''))}} Vnđ</span></li>
											<li>Phí Vận Chuyển: <span> Free</span></li>
											<li>Mã Giảm: <span> {{number_format($cou['coupon_number'])}} Vnđ</span></li>
												@php
													$total = number_format(Cart::subtotal(null,null,'') - $cou['coupon_number']);
												@endphp
											<input type="hidden" name="total" value="{{$total}}">
											<li>Tổng Tiền Đã Giảm: <span> {{$total}} Vnđ</span></li>
										@endif
									@endforeach
								@else
									<ul class="tt">
										<li>Thành Tiền: <span>{{number_format(Cart::subtotal(null,null,''))}} Vnđ</span></li>
										<li>Phí Vận Chuyển: <span>Free</span></li>
										<input type="hidden" name="total" value="{{number_format(Cart::subtotal(null,null,''))}}">
										<li>Tổng Tiền: <span>{{number_format(Cart::subtotal(null,null,''))}} Vnđ</span></li>
									</ul>

								@endif

							</ul>
				</div>
				<div class="border p-4 col-sm-6">
					<h3 style="text-align: center;">Thông Tin Khách Hàng</h3>
					
					  <div class="form-group">
					    <label for="name">Tên Khách Hàng:</label>
					    <input type="text" class="form-control @error('taikhoan') is-invalid @enderror" placeholder="Nhập Tên Khách Hàng" id="customer_name" value="{{$customer->username}}" name="customer_name">
					    @error('customer_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                         @enderror
					  </div>
					  <div class="form-group">
					    <label for="phone">Số Điện Thoại:</label>
					    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" placeholder="Nhập Số Điện Thoại" id="phone" value="{{$customer->phone}}" name="customer_phone">
					     @error('customer_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                         @enderror
					  </div>
					 
					  <div class="form-group">
					    <label for="address">Địa Chỉ Khách Hàng:</label>
					    <input type="text" class="form-control @error('customer_address') is-invalid @enderror" placeholder="Nhập Địa Chỉ" id="address" value="{{$customer->address}}" name="customer_address">
					     @error('customer_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                         @enderror
					  </div>
					  <div class="form-group">
					    <label for="note">Ghi Chú Của Khách Hàng:</label>
					    <input type="text" class="form-control" placeholder="Nhập Ghi Chú" id="note" value="{{$customer->note}}" name="customer_note">
					  </div>
					  <div class="form-group form-check">
					    <label class="form-check-label">
					      <input class="form-check-input @error('payment') is-invalid @enderror" type="checkbox" value="1" name="payment">
					      Thành Toán Bằng Tiền Mặt
					       @error('payment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                         @enderror
					    </label>
					  </div>
					  <button type="submit" class="btn btn-primary mx-auto d-block">Mua Hàng</button>
					</form>
				</div>
				</form>
			</div>
	</div>
@endsection