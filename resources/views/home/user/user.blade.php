@extends('home.user.layout_user')
@section('content')
	<div class="container-fluid row">
                            <div class="col-sm-8">
                            <h3 style="text-align: center; color:red">Thông Tin Cá Nhân</h3>
                            @php
                            	$id = Session::get('id');

                            @endphp
                            <form method="post" action="{{URL::to('edit-user',$id)}}">
                                @csrf
                                <div class="form-group">
                                     <label>Họ Và Tên</label>
                                     <input type="text" class="form-control" placeholder="Tên của bạn" required name="name" value="{{$customer->username}}">
                                </div>
                                <div class="form-group">
                                   <label>Email</label>
                                   <input type="email" class="form-control" placeholder="Email của bạn" required name="email" value="{{$customer->email}}">
                                </div>
                                 <div class="form-group">
                                     <label>Địa Chỉ</label>
                                     <input type="text" class="form-control" placeholder="Đỉa chỉ của bạn" required name="address" value="{{$customer->address}}">
                                </div>
                                 <div class="form-group">
                                     <label>Số Điện Thoại</label>
                                     <input type="text" class="form-control" placeholder="số điện thoại của bạn" required name="phone" value="{{$customer->phone}}">
                                </div>
                                <label>Ngày Sinh</label>
                                <div class="form-group row">
                                   <select class="form-control" style="width: 12%;margin-left: 15px;" name="day">
                                   	  <option value="{{$customer->day}}" selected>{{$customer->day}}</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                   </select>
                                   <select class="form-control" style="width: 10%" name="month">
                                   	  <option value="{{$customer->month}}" selected>{{$customer->month}}</option>                     
                                  	  <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                   </select>
                                    <select class="form-control" style="width: 15%" name="year">
                                      <option value="{{$customer->year}}" selected>{{$customer->year}}</option>
                                      <option value="1990">1990</option>
                                      <option value="1991">1991</option>
                                      <option value="1992">1992</option>
                                      <option value="1993">1993</option>
                                      <option value="1994">1994</option>
                                      <option value="1995">1995</option>
                                      <option value="1996">1996</option>
                                      <option value="1997">1997</option>
                                      <option value="1998">1998</option>
                                      <option value="1999">1999</option>
                                      <option value="2000">2000</option>
                                      <option value="2001">2001</option>
                                      <option value="2002">2002</option>
                                      <option value="2003">2003</option>
                                      <option value="2004">2004</option>
                                      <option value="2005">2005</option>
                                      <option value="2006">2006</option>
                                      <option value="2007">2007</option>
                                      <option value="2008">2008</option>
                                      <option value="2009">2009</option>
                                      <option value="2010">2010</option>
                                      <option value="2011">2011</option>
                                      <option value="2012">2012</option>
                                      <option value="2013">2013</option>
                                      <option value="2014">2014</option>
                                      <option value="2015">2015</option>
                                      <option value="2016">2016</option>
                                      <option value="2017">2017</option>
                                      <option value="201">2018</option>
                                      <option value="2019">2019</option>
                                      <option value="2020">2020</option>
                                   </select>
                                </div>
                                @if($customer->sex == 'Nam')
	                                <input type="radio" name="sex" value="{{$customer->sex}}" checked="checked">Nam
	                                <input type="radio" name="sex" value="{{$customer->sex}}">Nữ
                                @elseif($customer->sex == 'Nu')
	                                <input type="radio" name="sex" value="{{$customer->sex}}">Nam
	                                <input type="radio" name="sex" value="{{$customer->sex}}" checked="checked">Nữ
                                @else
                                	<input type="radio" name="sex" value="Nam">Nam
	                                <input type="radio" name="sex" value="Nu">Nữ
                                @endif
                                <button type="submit" class="btn btn-primary mx-auto d-block">Chỉnh Sửa</button>
                            </form>
                            </div>
                            <div class="col-sm-4">
                                <form method="post" action="{{URL::to('check-images',$customer->id)}}" enctype="multipart/form-data">
                                  @csrf
                                    <img src="{{URL::to('storage/app/admin',$customer->images)}}" class="rounded-circle" width="70px" height="70px;">
                                    <input type="file" name="file" class="" style="margin-top: 5px;">
                                    <button type="submit" class="btn-primary btn" style="margin-top: 10px">Thay Đổi</button>
                                </form>
                            </div>
@endsection