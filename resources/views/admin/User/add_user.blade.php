@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Thêm User</h6>
        </div>
        <div class="card-body">
        	@if(Session::get('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
                            {{Session::put('message',null)}}
                        </div>
             @endif
      <form method="post" action="{{URL::to('save-user')}}">
      	@csrf
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" style="width: 50%" value="{{ old('username') }}">
	      @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
           @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">email</label>
	    <div class="col-sm-10">
	      <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" style="width: 50%" value="{{ old('email') }}">
	      @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
           @enderror
	    </div>
	  </div>
	  	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
	    <div class="col-sm-10">
	      <input type="Password" class="form-control @error('password') is-invalid @enderror" name="password" style="width: 50%" value="{{ old('password') }}">
	      @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
           @enderror
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">phone</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" style="width: 50%" value="{{ old('phone') }}">
	      @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
           @enderror
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="inputEmail3" class="col-sm-2 col-form-label">Hình Ảnh</label>
	    <div class="col-sm-10">
	      <input type="file" class="form-control @error('file_name') is-invalid @enderror" name="file_name" style="width: 50%" value="{{ old('file_name') }}">
	      @error('file_name')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	  </div>
		  <div class="form-group row">
		    <div class="col-sm-10">
		      <button type="submit" class="btn btn-primary">Thêm</button>
		    </div>
		  </div>
		</form>
     	</div>
        </div>
@endsection
