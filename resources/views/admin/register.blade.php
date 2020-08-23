<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="public/backend/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tạo Tài Khoản!</h1>
              </div>
              <form class="user" method="post" action="{{URL::to('registerauth')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-user @error('name_admin') is-invalid @enderror" id="exampleLastName" placeholder="Họ Và Tên" name="name_admin" value="{{ old('name_admin') }}">
                     @error('name_admin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user @error('email_admin') is-invalid @enderror" id="exampleInputEmail" placeholder="Địa Chỉ Email" name="email_admin" value="{{ old('email_admin') }}">
                   @error('email_admin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user @error('password_admin') is-invalid @enderror" id="exampleInputPassword" placeholder="Mật Khẩu" name="password_admin" value="{{ old('password_admin') }}">
                     @error('password_admin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user @error('phone_admin') is-invalid @enderror" id="exampleInputPassword" placeholder="Số điện thoại" name="phone_admin" value="{{ old('phone_admin') }}">
                     @error('phone_admin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="file" class="form-control form-control-user @error('file') is-invalid @enderror" id="exampleInputPassword" placeholder="Hình ảnh" name="file" value="{{ old('file') }}">
                     @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Đăng Ký Tài Khoản
                  </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{URL::to('authlogin')}}">Bạn đã tài khoản? Đăng nhập!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="public/backend/vendor/jquery/jquery.min.js"></script>
  <script src="public/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="public/backend/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="public/backend/js/sb-admin-2.min.js"></script>

</body>

</html>
