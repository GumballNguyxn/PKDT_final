@extends('layouts.app')
@section('title', 'Trang chủ')
@section('main')
		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="/">TRANG CHỦ</a></li>
						<li><a href="{{ route('products.index') }}" >SẢN PHẨM</a></li>
						<li><a href="{{ route('products.index') }}" data-key="op lung">ỐP LƯNG</a></li>
						<li><a href="{{ route('products.index') }}" data-key="Tai Nghe">TAI NGHE</a></li>
						<li><a href="{{ route('products.index') }}" data-key="sac">DÂY SẠC - CỦ SẠC</a></li>
						<li><a href="{{ route('products.index') }}" data-key="op lung">SẠC DỰ PHÒNG</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="{{ asset('img/shop01.png')}}" alt="">
							</div>
							<div class="shop-body">
								<h3>Ốp lưng<br>sành điệu</h3>
								<a href="{{ route('products.index') }}" class="cta-btn">Xem ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="{{ asset('img/shop03.png')}}" alt="">
							</div>
							<div class="shop-body">
								<h3>Sạc dự phòng<br>giá tốt</h3>
								<a href="{{ route('products.index') }}" class="cta-btn">Xem ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="{{ asset('img/shop02.png')}}" alt="">
							</div>
							<div class="shop-body">
								<h3>Tai nghe<br>phổ thông</h3>
								<a href="{{ route('products.index') }}" class="cta-btn">Xem ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản phẩm mới</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav sanphammoi">
									<li class="active"><a data-toggle="tab" data-sp = '1' href="">Ốp lưng</a></li>
									<li><a data-toggle="tab" data-sp = '2' href="">Tai Nghe</a></li>
									<li><a data-toggle="tab" data-sp = '3' href="#tab1">Dây sạc, củ sạc</a></li>
									<li><a data-toggle="tab" data-sp = '6' href="#tab1">Cường lực</a></li>
									<li><a data-toggle="tab" data-sp = '7' href="#tab1">Pin dự phòng</a></li>

								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12" id="mot">
						<div class="row">
							<div class="products-tabs" >
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" id="motmot" data-nav="#slick-nav-1">
										<!-- product -->
                                        @foreach ($products as $item)
                                        <div class="product">
											<div class="product-img">
												<img src="products_img/{{ $item->productImage->get(0)->path }}" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{ $item->productCategory->name }}</p>
												<h3 class="product-name"><a href="{{route('products.show',  $item->id)}}">{{ Str::limit($item->name, 40) }}</a></h3>
                                                @php
                                                    $price = $item->productDetail->min('price');
                                                    $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
                                                    $PriceX = number_format($price*1.3, 0, ',', '.');
                                                @endphp
												<h4 class="product-price">{{ $formattedPrice }}<del class="product-old-price">{{ $PriceX }}</del></h4>
												<div class="product-rating">
													@php
														$totalRating = 0;
														$totalComments = count($item->productComment);

														if ($totalComments > 0) {
															foreach ($item->productComment as $comment) {
																$totalRating += $comment->rating;
															}

															$averageRating = round($totalRating / $totalComments, 1);
														} else {
															$averageRating = 0;
														}
													@endphp
													@for ($i = 0; $i < $averageRating; $i++)
													<i class="fa fa-star"></i>
													@endfor
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào <br> DS yêu thích</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<form action="{{route('carts.store') }}" method="POST" class="add-to-cart-form">
													@csrf
														<input type="hidden" name="product_id" value="{{$item->id }}">
														<input type="hidden" name="price" value="{{$formattedPrice}}  ">
														<input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
														
														<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
												</form>
											</div>
										</div>
                                        @endforeach

										<!-- /product -->
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Ngày</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Giờ</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Phút</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Giây</span>
                                        <!-- cai nay phai sua cho tg dem nguoc -->
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">deal sốc tuần này</h2>
							<p>giảm giá đến 50%</p>
							<a class="primary-btn cta-btn" href="#">mua ngay</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản phẩm nổi bật</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav sanphambanchay">
									<li class="active"><a data-toggle="tab" data-sp = '1' href="">Ốp lưng</a></li>
									<li><a data-toggle="tab" data-sp = '2' href="">Tai Nghe</a></li>
									<li><a data-toggle="tab" data-sp = '3' href="#tab1">Dây sạc, củ sạc</a></li>
									<li><a data-toggle="tab" data-sp = '6' href="#tab1">Cường lực</a></li>
									<li><a data-toggle="tab" data-sp = '7' href="#tab1">Pin dự phòng</a></li>

								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<!-- Products tab & slick -->
					<div class="col-md-12" id="hai">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" id="haihai" data-nav="#slick-nav-2">
										<!-- product -->
										@foreach ($productsbc as $item)
                                        <div class="product">
											<div class="product-img">
												<img src="products_img/{{ $item->productImage->get(0)->path }}" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{ $item->productCategory->name }}</p>
												<h3 class="product-name"><a href="{{route('products.show',  $item->id)}}">{{ Str::limit($item->name, 40) }}</a></h3>
                                                @php
                                                    $price = $item->productDetail->min('price');
                                                    $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
                                                    $PriceX = number_format($price*1.3, 0, ',', '.');
                                                @endphp
												<h4 class="product-price">{{ $formattedPrice }}<del class="product-old-price">{{ $PriceX }}</del></h4>
												<div class="product-rating">
													@php
														$totalRating = 0;
														$totalComments = count($item->productComment);

														if ($totalComments > 0) {
															foreach ($item->productComment as $comment) {
																$totalRating += $comment->rating;
															}

															$averageRating = round($totalRating / $totalComments, 1);
														} else {
															$averageRating = 0;
														}
													@endphp
													@for ($i = 0; $i < $averageRating; $i++)
													<i class="fa fa-star"></i>
													@endfor
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào <br> DS yêu thích</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<form action="{{route('carts.store') }}" method="POST" class="add-to-cart-form">
													@csrf
														<input type="hidden" name="product_id" value="{{$item->id }}">
														<input type="hidden" name="price" value="{{$formattedPrice}}  ">
														<input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
														
														<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
												</form>
											</div>
										</div>
                                        @endforeach
										<!-- /product -->

									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Ốp lưng</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>
								<!-- product widget -->
                                @foreach ($products as $item)
    @if ($loop->iteration > 3)
        @break
    @endif
    
    <div class="product-widget">
        <div class="product-img">
            <img src="products_img/{{ $item->productImage->get(0)->path }}" alt="">
        </div>
        <div class="product-body">
            <p class="product-category">{{ $item->productCategory->name }}</p>
            <h3 class="product-name"><a href="{{ route('products.show', $item->id) }}">{{ Str::limit($item->name, 30) }}</a></h3>
            @php
                $price = $item->productDetail->min('price');
                $formattedPrice = number_format($price, 0, ',', '.'); // Format the price
                $PriceX = number_format($price * 1.3, 0, ',', '.'); // Calculate and format the increased price
            @endphp
            <h4 class="product-price">{{ $formattedPrice }}<del class="product-old-price">{{ $PriceX }}</del></h4>
        </div>
    </div>
@endforeach

								<!-- /product widget -->

							</div>
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Dây sạc,củ sạc</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								@foreach ($products3 as $item)
                                <div class="product-widget">
									<div class="product-img">
										<img src="products_img/{{ $item->productImage->get(0)->path }}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{ $item->productCategory->name }}</p>
										<h3 class="product-name"><a href="{{route('products.show',  $item->id)}}">{{ Str::limit($item->name, 30) }}</a></h3>
                                        @php
                                                    $price = $item->productDetail->min('price');
                                                    $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
                                                    $PriceX = number_format($price*1.3, 0, ',', '.');
                                                @endphp
										<h4 class="product-price">{{ $formattedPrice }}<del class="product-old-price">{{ $PriceX }}</del></h4>
									</div>
								</div>
                                @endforeach
								<!-- /product widget -->


							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Cường lực</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<!-- product widget -->
								@foreach ($products5 as $item)
                                <div class="product-widget">
									<div class="product-img">
										<img src="products_img/{{ $item->productImage->get(0)->path }}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{ $item->productCategory->name }}</p>
										<h3 class="product-name"><a href="{{route('products.show',  $item->id)}}">{{ Str::limit($item->name, 40) }}</a></h3>
                                        @php
                                                    $price = $item->productDetail->min('price');
                                                    $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
                                                    $PriceX = number_format($price*1.3, 0, ',', '.');
                                                @endphp
										<h4 class="product-price">{{ $formattedPrice }}<del class="product-old-price">{{ $PriceX }}</del></h4>
									</div>
								</div>
                                @endforeach
								<!-- /product widget -->


							</div>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection
