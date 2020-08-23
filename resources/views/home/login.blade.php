@extends('layout_lg_rg')
@section('content')
 <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Đăng Nhập') }}</div>
                        @if(Session::get('thongbao'))
                            <div class="alert alert-danger">
                                {{Session::get('thongbao')}}
                                {{Session::put('thongbao',null)}}
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="post" action="{{URL::to('login')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input type="email" class="form-control @error('taikhoan') is-invalid @enderror" name="taikhoan" value="{{ old('taikhoan') }}">
                                         @error('taikhoan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                         @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control @error('matkhau') is-invalid @enderror" name="matkhau" value="{{ old('matkhau') }}">
                                            @error('matkhau')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Đăng Nhập') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
