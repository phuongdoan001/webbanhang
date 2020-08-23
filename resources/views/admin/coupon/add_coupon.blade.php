@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Thêm Mã Sản Phẩm</h6>
        </div>
        <div class="card-body">
      <form method="post" action="{{URL::to('add-coupon')}}">
      	@csrf
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên Mã Giảm Giá</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" name="coupon_name" style="width: 50%" value="{{ old('coupon_name') }}">
	      @error('coupon_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
           @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Mã Giảm Giá</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" style="width: 50%" value="{{ old('coupon_code') }}">
	      @error('coupon_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
           @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Số Lượng Mã</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('coupon_qty') is-invalid @enderror" name="coupon_qty" style="width: 50%" value="{{ old('coupon_qty') }}">
	      @error('coupon_qty')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
           @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Nhập Số % Hoặc Tiền Giảm</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('coupon_price') is-invalid @enderror" name="coupon_price" style="width: 50%" value="{{ old('coupon_price') }}">
	      @error('coupon_price')
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
		          <input class="form-check-input" type="radio" name="coupon_condition" id="gridRadios1" value="1" checked>
		          <label class="form-check-label" for="gridRadios1">
		            Giảm Theo Phần Trăm
		          </label>
		        </div>
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="coupon_condition" id="gridRadios2" value="2">
		          <label class="form-check-label" for="gridRadios2">
		           	Giảm Theo Tiền
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
