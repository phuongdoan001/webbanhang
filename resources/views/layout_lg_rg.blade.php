<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bán Hàng Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/frontend/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/frontend/css/main.css">
</head>
<body>
    <!-- Header-->
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
        <div class="container-fluid border-bottom">
            <header class="row ml-1">
                <div class="shopping-mall">
                    <h1><img src="public/frontend/images/logo1.jpg"  height="80px" width="80px">Panda Store</h1>
                    <h5>Welcome To Panda Store</h5>
                </div>
            </header>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto"> 
                    <li class="nav-item">
                        <a href="{{URL::to('/')}}" class="nav-link"><span class="fas fa-home"></span> Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><span class="fas fa-phone"></span> Liên Hệ</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><span class="fas fa-list-alt"></span> Giới Thiệu</a>
                    </li>
                    @if(isset($user_login))
                    <li class="nav-item">
                        <a href="" class="nav-link"><img src="public/frontend/images/logo.jpg" class="rounded-circle " width="50px" height="50px" style="margin-top: -25px">{{$user_login->username}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL::to('log-out')}}" class="nav-link"><span class="fas fa-sign-out-alt"></span> Đăng Xuất</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{URL::to('log-in')}}" class="nav-link"><span class="fas fa-user"></span> Đăng Nhập</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL::to('reg')}}" class="nav-link"><span class="fas fa-lock"></span>  Đăng Ký</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
       @yield('content')
    <!-- Footer-->
    <div class="container-fluid">
        <footer class="row">
            <div class="card col">
                <div class="card-body">
                    <img src="public/frontend/images/logo1.jpg" class="rounded-circle" width="100px">
                    <p>Panda Store &copy; 2020, Phương Đoàn</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>