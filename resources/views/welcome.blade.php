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
                    <?php 
                        $id     = Session::get('id');
                        $name   = Session::get('username');
                        $images = Session::get('images');
                     ?>
                    @if($id != null)
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown"><img src="{{URL::to('storage/app/admin',$images)}}" class="rounded-circle " width="50px" height="50px" style="margin-top: -25px">{{$name}}
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{URL::to('user')}}" class="dropdown-item">Tài Khoản Của Tôi</a>
                            <a href="{{URL::to('code-order')}}" class="dropdown-item">Đơn Mua</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL::to('log-out')}}" class="nav-link"><span class="fas fa-sign-out-alt"></span> Đăng Xuất</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{URL::to('log-in')}}" class="nav-link" ><span class="fas fa-user"></span> Đăng Nhập</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL::to('reg')}}" class="nav-link" ><span class="fas fa-lock"></span>  Đăng Ký</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Quảng Cáo-->
    <div class="container-fluid bg-light border">
        <div class="col-sm-12 row">
        <div class="col-sm-8">
            <div id="slides" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#slides" data-slide-to="0" class="active"></li>
                    <li data-target="#slides" data-slide-to="1"></li>
                    <li data-target="#slides" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    @php 
                        $i = 0;
                    @endphp
                    @foreach($slider as $sl)
                     @php 
                        $i++;
                     @endphp
                    <div class="carousel-item {{$i==1 ? 'active' : '' }}">
                        <img src="{{URL::to('storage/app/public',$sl->slider_images)}}" style="width: 100%;height: 400px;">
                        <div class="carousel-caption" style="color: red;">
                            <h5 class="display-2">{{$sl->slider_name}}</h5>
                            <h3>{{$sl->slider_content}}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-4 col">
            @foreach($poster as $poster)
            <img src="{{URL::to('storage/app/public',$poster->poster_images)}}" style="width: 400px; height: 195px; margin-bottom: 5px;"> 
            @endforeach  
        </div>
        </div>
    </div>
    <!--Menu-->
    <div class="container-fluid bg-primary border">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
              <a class="navbar-brand" href="#"><img src="public/frontend/images/logo2.jpg" class="rounded-circle" style="width: 40px; height: 40px" ></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="{{URL::to('/')}}"><span class="fas fa-home"></span> Trang Chủ<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-list-alt"></span>
                      Danh Mục
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach($category as $cate)
                      <a class="dropdown-item" href="{{URL::to('category',$cate->id)}}">{{$cate->category_name}}</a>
                    @endforeach
                    </div>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="get">
                  <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search" name="keyword">
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{URL::to('show-cart')}}" class="nav-link"><sup><span class="badge badge-light">{{count(Cart::content())}}</span></sup><span class="fas fa-shopping-cart"></span> Giỏ Hàng</a>
                    </li>
                </ul>
             </div>
        </nav>
    </div>
    <!-- Sản Phẩm-->
    <div class="container-fluid bg-light border">
        <div class="row col-sm-12">
            <div class="col-sm-3"> 
                <div class="nav flex-column nav-pills border" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Danh Mục Sản Phẩm</a>
                  @foreach($category as $cate)
                  <a class="nav-link" href="{{URL::to('category',$cate->id)}}">{{$cate->category_name}}</a>
                  @endforeach
               </div>
            </div>
            @yield('content')
        </div>
    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
</body>
</html>
