@extends('admin.layout_show')
@section('content')
	<div class="col-lg-12">
      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Thêm  Sản Phẩm</h6>
        </div>
        <div class="card-body">
      <form method="post" action="{{URL::to('update-product',$product->id)}}" enctype="multipart/form-data">
      	@csrf

	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="name_product" style="width: 50%" value="{{$product->product_name}}">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Chi Tiết Sản Phẩm</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="details_product" style="width: 50%" value="{{$product->product_details}}">
	    </div>
	  </div>
	  		  <fieldset class="form-group">
		    <div class="row">	     
		      <legend class="col-form-label col-sm-2 pt-0">Sản Phẩm Mới</legend>
		      <div class="col-sm-10">
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="new_product" id="gridRadios1" value="0" checked>
		          <label class="form-check-label" for="gridRadios1">
		           	Không
		          </label>
		        </div>
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="new_product" id="gridRadios2" value="1">
		          <label class="form-check-label" for="gridRadios2">
		           Có
		          </label>
		        </div>
		      </div>
		    </div>
		  </fieldset>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Hình Ảnh Sản Phẩm</label>
	    <div class="col-sm-10">
	      <input type="file" class="form-control" name="file" style="width: 50%" value="">
	      <img src="{{URL::to('storage/app/public',$product->product_img)}}" style="width: 80px;height: -80px">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Mức Giá</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="price_product" style="width: 50%" value="{{$product->product_price}}">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Số Lượng Sản Phẩm</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="qty_product" style="width: 50%" value="{{$product->product_qty}}">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Số Lượng Sản Phẩm</label>
	    <div class="col-sm-10">
	      <textarea name="desc_product"  rows="8" class="form-control" style="width: 50%" placeholder="Mô Tả Danh Mục">{{$product->product_desc}}</textarea>
	    </div>
	  </div>
		  <div class="form-group row">
		    <div class="col-sm-10">
		      <button type="submit" class="btn btn-primary">Chỉnh Sửa</button>
		    </div>
		  </div>
		</form>
     	</div>
        </div>
@endsection
