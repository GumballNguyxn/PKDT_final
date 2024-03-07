<!-- TOP HEADER -->
<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0987654321</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> nhom3@email.com</a></li>
						<li><a href="https://www.google.com/maps/place/175+P.+T%C3%A2y+S%C6%A1n,+Trung+Li%E1%BB%87t,+%C4%90%E1%BB%91ng+%C4%90a,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@21.0068481,105.8229214,17z/data=!3m1!4b1!4m6!3m5!1s0x3135ad744eb9a567:0x86ebcd89ee0bda7b!8m2!3d21.0068431!4d105.8255017!16s%2Fg%2F11thfr5wxv?hl=vi-VN&entry=ttu"><i class="fa fa-map-marker"></i> 175 Tây Sơn, Đống Đa, Hà Nội</a></li>
					</ul>
					<ul class="header-links pull-right">
						@guest
                            @if (Route::has('login'))
                                <li>
                                    <a href="{{ route('login') }}"><i class="fa fa-user-o"></i>Đăng nhập</a>
                                </li>
                            @endif
                        	@else
							<li>
								<a  href="#"><i class="fa fa-dollar"></i>Ví</a>
							</li>
                            <li>
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="cursor: pointer;">
										<i class="fa fa-user-o"></i>{{ Auth::user()->name}}
									</a>
									<div class="btn profile-dropdown">
										<ul class="profile-list">
											<li class="dropdown-item"><a href="{{route('profile', ['user'=>Auth::user()->id])}}">Thông tin cá nhân</a></li><hr>
											<li class="dropdown-item"><a href="#">DS Yêu thích</a></li><hr>
											<li class="dropdown-item"><a href="#">Giỏ hàng</a></li><hr>
											<li class="dropdown-item"><a href="#">Cài đặt</a></li><hr>
											<hr style="margin-bottom: 0%;">
											<li>
												<a class="dropdown-item" href="{{ route('logout') }}"
													onclick="event.preventDefault();
																document.getElementById('logout-form').submit();">
													Đăng xuất
												</a>

												<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
													@csrf
												</form>
											</li>
										</ul>
									</div>
								</div>
							</li>
                        @endguest
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
									<img src="{{ asset('img/logo.png')}}" alt="Logo" style="width:100%">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
                        <div class="col-md-6">
                            <div class="header-search">
                                <form id="searchForm" action="products" method="GET">
                                    <input class="input" id="searchInput" name="keyword" placeholder="Bạn muốn tìm gì...">
                                    <button type="submit" class="search-btn">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="{{ route('favorites.index') }}">
										<i class="fa fa-heart"></i>
										<span>DS yêu thích</span>
										<!-- <div class="qty">2</div> -->
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div>
									<a href="{{route('carts.index')}}">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
									</a>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->


