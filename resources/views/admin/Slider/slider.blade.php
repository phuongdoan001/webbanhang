@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Thêm  Slider</h6>
        </div>
        <div class="card-body">
        	 @if(Session::get('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                            {{Session::put('message',null)}}
                        </div>
             @endif
      <form method="post" action="{{URL::to('add-slider')}}" enctype="multipart/form-data">
      	@csrf
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên Slider</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('slider_name') is-invalid @enderror" name="slider_name" style="width: 50%" value="{{ old('slider_name') }}">
	       @error('slider_name')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Hình Ảnh</label>
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
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Nội Dung Slider</label>
	    <div class="col-sm-10">
	      <textarea name="slider_content"  rows="8" class="form-control @error('slider_content') is-invalid @enderror" style="width: 50%" placeholder="Nội Dung Slider" value="{{ old('slider_content') }}"></textarea>
	      @error('slider_content')
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
		          <input class="form-check-input" type="radio" name="slider_status" id="gridRadios1" value="0" checked>
		          <label class="form-check-label" for="gridRadios1">
		            Ẩn
		          </label>
		        </div>
		        <div class="form-check">
		          <input class="form-check-input" type="radio" name="slider_status" id="gridRadios2" value="1">
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
