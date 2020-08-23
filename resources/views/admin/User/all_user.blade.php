@extends('admin.layout_admin')
@section('content')
	<div class="col-lg-12">
		<div class="card shadow mb-12">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tất Cả Sản Phẩm</h6>
            </div>
                 @if(Session::get('thongbao'))
                      <div class="alert alert-success">
                          {{Session::get('thongbao')}}
                          {{Session::put('thongbao',null)}}
                      </div>
                  @endif
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Username</th>
                      <th>email</th>
                      <th>Số Điện Thoại</th>
                      <th>Password</th>
                      <th>Hình Ảnh</th>    
                      <th>Author</th>
                      <th>Admin</th>
                      <th>User</th>
                      <th>Thao Tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $i =1; ?>
                  	@foreach($admin as $ad)
                    <form action="{{url('/assign-roles')}}" method="POST">
                       @csrf
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$ad->username}}</td>
                          <td>{{$ad->email}}<input type="hidden" name="admin_email" value="{{ $ad->email }}"></td>
                          <td>{{$ad->phone}}</td>
                          <td>{{$ad->password}}</td>
                          <td>
                            <img src="{{URL::to('storage/app/admin',$ad->img)}}" style="height: 80px; width: 80px">
                          </td> 
                          <td><input type="checkbox" name="author_role" {{$ad->hasRole('author') ? 'checked' : ''}}></td>
                          <td><input type="checkbox" name="admin_role"  {{$ad->hasRole('admin') ? 'checked' : ''}}></td>
                          <td><input type="checkbox" name="user_role"  {{$ad->hasRole('user') ? 'checked' : ''}}></td>
                          <td>
                              <input type="submit" value="Cấp Quyền" class="btn btn-primary" style="margin-bottom: 3px;">
                              <a href="{{URL::to('delete-user',Auth::id())}}" class="btn btn-primary"  onclick="return confirm('Bạn có chắc là muốn xóa user này không?')">Xóa User</a>
                          </td>
                          </tr>
                    </form>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
