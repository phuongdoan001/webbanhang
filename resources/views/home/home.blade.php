@extends('welcome')
@section('content')
      <div class="col-sm-9 border">
                <h3 class="p-4">Sản Phẩm Mới</h3>
                <div class="row row-cols-1 row-cols-md-3">
                  @foreach($allproduct as $product)
                    <form method="post" action="{{URL::to('add-cart')}}">
                    @csrf
                        <input type="hidden" name="hidden" value="{{$product->id}}">
                        <input type="hidden" name="qty" value="1">
                        <div class="col mb-3" style="height: auto;"> 
                          <div class="card h-100">
                            <img src="{{URL::to('storage/app/public',$product->product_img)}}" class="card-img-top" style="width: auto; height: 200px;">
                            <div class="card-body">
                              <p class="card-title" style="height: 60px;"><b> {{$product->product_name}}</b></p>
                              <p class="card-text"><i> Giá: {{number_format($product->product_price).' '.'Vnđ'}}</i></p>
                                <a href="{{URL::to('details',$product->id)}}" class="btn btn-primary col" style="margin-bottom: 3px;"><span class="fas fa-info"></span> Chi tiết sản phẩm</a>
                                <button type="submit" class="btn btn-primary col"><span class="fas fa-shopping-cart"></span> Thêm Vào Sản Phẩm</button>
                            </div>
                          </div>
                        </div>
                    </form>
                  @endforeach
                </div>
               <h5 style="padding-left: 400px;">
                 {{$allproduct->links()}}
               </h5>
      </div>
@endsection