<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Đăng ký</title>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>

		<link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>

		<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

		<link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}"/>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        

    </head>

<body >
        <header>
        <div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0987654321</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> nhom3@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 175 Tây Sơn, Đống Đa, Hà Nội</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li>
							<!-- nếu đã đăng nhập
							<a href="#"><i class="fa fa-dollar"></i> Ví</a> -->
						</li>
						<li>
							<!-- nếu chưa đăng nhập -->
							@if (Route::has('login'))
								<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
									@auth
										<a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Trang chủ</a>
									@else
										<a href="{{route('login')}}"><i class="fa fa-user-o"></i> Đăng nhập</a>
									@endauth
								</div>
							@endif
							
							
							<!-- nếu đã đăng nhập
							<a href="#"><i class="fa fa-user-o"></i> Tài khoản</a> -->
						</li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{route('home')}}" class="logo">
									<img src="./img/logo.png" alt="" style="width:100%">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<input class="input" placeholder="Bạn muốn tìm gì...">
									<button class="search-btn">Tìm kiếm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart"></i>
										<span>DS yêu thích</span>
										<!-- <div class="qty">2</div> -->
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div>
									<a href="#">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
										<!-- <div class="qty">2</div> -->
									</a>
								</div>
								<!-- /Cart -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
        </header>
        <main>
            <div class="container" >
                <div class="card text-center" style="margin-top: 2%; margin-bottom: 5%;">
                    <div class="card-header ">
                        <h2>ĐĂNG KÝ</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="text-left" style="margin: 2%; margin-left:25%; margin-right:25%;">
                            <label for="exampleInputName" class="form-label">Họ tên</label>
                            <input id="exampleInputName" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                        </div>
                        <div class="text-left" style="margin: 2%; margin-left:25%; margin-right:25%;">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input id="exampleInputEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                        </div>
                        <div class="text-left" style="margin: 2%; margin-left:25%; margin-right:25%;">
                            <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                            <input id="exampleInputPassword1" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="color: red;">
                                    	{{ $message }}
                                    </span>
                                @enderror
                        </div>
                        <div class="text-left" style="margin: 2%; margin-left:25%; margin-right:25%;">
                            <label for="exampleInputCfPassword1" class="form-label">Xác nhận mật khẩu</label>
							<input id="exampleInputCfPassword1" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn primary-btn submit">Đăng ký</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </main>
        <footer id="footer">

        </footer>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/slick.min.js')}}"></script>
        <script src="{{asset('js/nouislider.min.js')}}"></script>
        <script src="{{asset('js/jquery.zoom.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
    </body>
</html>
