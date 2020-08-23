@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
      	@if(Session::get('thongbao'))
                      <div class="alert alert-success">
                          {{Session::get('thongbao')}}
                          {{Session::put('thongbao',null)}}
                      </div>
                  @endif
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Thêm  Sản Phẩm</h6>
        </div>
        <div class="card-body">
      <form method="post" action="{{URL::to('add-product')}}" enctype="multipart/form-data">
      	@csrf
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên Danh Mục</label>
	    <div class="col-sm-10">
	      <select name="cate_id" class="form-control input-sm m-bot15" style="width: 50%">
	      	@foreach($category as $category)
	      		<option value="{{$category->id}}">{{$category->category_name}}</option>
	      	@endforeach
	      </select>
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" style="width: 50%" value="{{ old('product_name') }}">
	       @error('product_name')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Chi Tiết Sản Phẩm</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('product_details') is-invalid @enderror" name="product_details" style="width: 50%" value="{{ old('product_details') }}">
	      @error('product_details')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	       @enderror
	    </div>
	  </div>
	  		  <fieldset class="form-group">
		    <div class="row">	     
		      <legend class="col-form-label col-sm-2 pt-0">Sản Phẩm Mới</legend>
		      <div class="col-sm-10">
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="product_new" id="gridRadios1" value="0" checked>
		          <label class="form-check-label" for="gridRadios1">
		           	Không
		          </label>
		        </div>
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="product_new" id="gridRadios2" value="1">
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
	      <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" style="width: 50%" value="{{ old('file') }}">
	      @error('file')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Mức Giá</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('product_price') is-invalid @enderror" name="product_price" style="width: 50%" value="{{ old('product_price') }}">
	      @error('product_price')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Số Lượng Sản Phẩm</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('product_qty') is-invalid @enderror" name="product_qty" style="width: 50%" value="{{ old('product_qty') }}">
	      @error('product_qty')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Mô Tả Sản Phẩm</label>
	    <div class="col-sm-10">
	      <textarea name="product_desc"  rows="8" class="form-control @error('product_desc') is-invalid @enderror" style="width: 50%" placeholder="Mô Tả Danh Mục" value="{{ old('product_desc') }}"></textarea>
	      @error('product_desc')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	  </div>
		  <fieldset class="form-group">
		    <div class="row">	     
		      <legend class="col-form-label col-sm-2 pt-0">Trạng Thái</legend>
		      <div class="col-sm-10">
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="product_status" id="gridRadios1" value="0" checked>
		          <label class="form-check-label" for="gridRadios1">
		            Ẩn
		          </label>
		        </div>
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="product_status" id="gridRadios2" value="1">
		          <label class="form-check-label" for="gridRadios2">
		           Hiện
		          </label>
		        </div>
		      </div>
		    </div>
		  </fieldset>
		  <div class="form-group row">
		    <div class="col-sm-10">
		      <button type="submit" class="btn btn-primary">Thêm</button>
		    </div>
		  </div>
		</form>
     	</div>
        </div>
@endsection
