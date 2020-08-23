@extends('admin.layout_show')
@section('content')
	<div class="col-lg-12">
      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Chỉnh Sửa Mục Sản Phẩm</h6>
        </div>
        <div class="card-body">
      <form method="get" action="{{URL::to('update-category',$category->id)}}">
      	@csrf
	  <div class="form-group row">

	    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên Danh Mục</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="category_name" style="width: 50%" value="{{$category->category_name}}">
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
