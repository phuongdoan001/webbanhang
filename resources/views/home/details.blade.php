@extends('welcome_category')
@section('content')
<div class="col-sm-9 border">
				<h3 class="p-4">Chi Tiết Sản Phẩm</h3>
				@foreach($detail as $dt)
				<div class="card mb-3" style="max-width: auto; height: auto;">
				  <div class="row no-gutters">
				    <div class="col-md-5 p-5 border">
				      <img src="{{URL::to('storage/app/public',$dt->product_img)}}" class="rounded" alt="" width="300px;" height="200px">
				    </div>
				    <div class="col-md-7 p-3 border">		   
					      <div class="card-body">
					      	<form method="post" action="{{URL::to('add-cart')}}">
					      		@csrf
					        <h4 class="card-title">{{$dt->product_name}}</h4>
					        <p class="card-text">Mã ID: {{$dt->id}}</p>
					        <h5 class="card-text">Giá : {{number_format($dt->product_price).' '.'Vnđ'}}</h5>
					        <p class="card-text"><small class="text-muted">Số hàng Còn : {{$dt->product_qty}}</small></p>
					        <input type="hidden" value="{{$dt->id}}" name="hidden" />
					        <p class="card-text">Số Lượng <input type="number" min="1" max="{{$dt->product_qty}}" value="1" name="qty"></p>
					        @if($dt->product_qty != 0)
					        <button type="submit" class="btn btn-primary" ><i class="fas fa-shopping-cart" ></i>Thêm Vào Giỏ Hàng</button>
					        @else
					         <button type="submit" class="btn btn-primary" disabled=""><i class="fas fa-shopping-cart" ></i>Thêm Vào Giỏ Hàng</button>
					         @endif
					        </form>     
					      </div>  
				      		
				      		
				    </div>		    
				  </div>
				  <ul class="nav nav-pills mb-3 p-2 border" id="pills-tab" role="tablist">
					  <li class="nav-item" role="presentation">
					    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Giới Thiệu</a>
					  </li>
					  <li class="nav-item" role="presentation">
					    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Mô Tả Sản Phẩm</a>
					  </li>
					</ul>
					<div class="tab-content p-2" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">{{$dt->product_desc}}</div>
					  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">{{$dt->product_content}}</div>
					</div>
				</div>
				@endforeach
				<h3 class="p-3">Sản Phẩm Liên Quan</h3>
					<div class="row row-cols-1 row-cols-md-3">
					@foreach($allspcl as $spcl)
						<form method="post" action="{{URL::to('add-cart')}}">
	                    	@csrf
	                        <input type="hidden" name="hidden" value="{{$spcl->id}}">
	                        <input type="hidden" name="qty" value="1">
							<div class="col mb-4" style="height: auto;">
							    <div class="card">
							      <img src="{{URL::to('storage/app/public',$spcl->product_img)}}" class="card-img-top rounded" alt="..." height="200px">
							      <div class="card-body">
							        <p class="card-title" style="height: 60px"><b> {{$spcl->product_name}}</b></p>
							        <p class="card-text">Giá: {{number_format($spcl->product_price).' '.'Vnđ'}}</p>
							        <a href="{{URL::to('details',$spcl->id)}}" class="btn btn-primary col" style="margin-bottom: 3px;" ><span class="fas fa-info"></span> Chi tiết sản phẩm</a>
							        <button type="submit" class="btn btn-primary col"><span class="fas fa-shopping-cart"></span> Thêm Vào Sản Phẩm</button>
							      </div>
							    </div>
							</div>
						</form>
					@endforeach
					</div>
					<div style="margin-left: 420px;" class="row">
						<span>{{$allspcl->render()}}</span>
					</div>
				</div>
				
@endsection