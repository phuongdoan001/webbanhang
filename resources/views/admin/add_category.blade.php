@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Thêm Danh Mục Sản Phẩm</h6>
        </div>
        <div class="card-body">
      <form method="get" action="{{URL::to('add-category')}}">
      	@csrf
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên Danh Mục</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" style="width: 50%" value="{{ old('category_name') }}">
	      @error('category_name')
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
		          <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="0" checked>
		          <label class="form-check-label" for="gridRadios1">
		            Ẩn
		          </label>
		        </div>
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="1">
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
