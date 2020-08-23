@extends('welcome_category')
@section('content')
	<div class="col-sm-9 border">
				        @foreach($name as $name)
                <h3 class="p-4" style="text-align: center;">{{$name->category_name}}</h3>
                @endforeach
                <form method="get" id="form_order"> 
                  <div class="pull-right">
                        <label>Sắp Xếp</label>
                        <select name="orderby" class="orderby">
                                <option selected="selected">Mặc Định</option>
                                <option value="asc">Giá tăng dần</option>
                                <option value="desc">Giá giảm dần</option>
                        </select>
                     </div>
                 </form>
                <div class="row row-cols-1 row-cols-md-3">
                @foreach($product as $pd)
                  <form method="post" action="{{URL::to('add-cart')}}">
                    @csrf
                    <input type="hidden" name="hidden" value="{{$pd->id}}">
                          <input type="hidden" name="qty" value="1">
                    <div class="col mb-4" style="height: auto;">
                      <div class="card h-100">
                        <img src="{{URL::to('storage/app/public',$pd->product_img)}}" class="card-img-top" style="width: auto;height: 200px;">
                        <div class="card-body">
                          <p class="card-title" style="height: 60px;"><b> {{$pd->product_name}}</b></p>
                          <p class="card-text"><i> Giá: {{number_format($pd->product_price).' '.'Vnđ'}}</i></p>
                          <a href="{{URL::to('details',$pd->id)}}" class="btn btn-primary col" style="margin-bottom: 3px;"><span class="fas fa-info"></span>  Chi tiết sản phẩm</a>
                          <button type="submit" class="btn btn-primary col"><span class="fas fa-shopping-cart"></span> Thêm vào giỏ hàng</button>
                        </div>
                      </div>
                    </div>
                  </form>
                @endforeach
                </div>
                <h5 style="padding-left: 400px">
                    {{$product->links()}}
                </h5>
            </div>
@endsection
