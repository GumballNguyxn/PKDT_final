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
                <li class="active"><a href="#">TRANG CHỦ</a></li>
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
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('home')}}">Nhà</a></li>
                        <li><a href="{{route('products.index')}}">Tất cả các danh mục</a></li>
                        <li><a href=""data-key="{{ $product->productBrand->name }}">{{ $product->productBrand->name }}</a></li>
                        <li class="active">{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div>
        @if(session('success'))
            <div id="alertSuccess" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div id="alertError" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <script>
            // Ensure the entire page has loaded before executing JavaScript code
            document.addEventListener("DOMContentLoaded", function() {
                // Use JavaScript to hide the alerts after a certain period of time
                setTimeout(function() {
                    var alertSuccess = document.getElementById('alertSuccess');
                    if (alertSuccess) {
                        alertSuccess.style.display = 'none';
                    }

                    var alertError = document.getElementById('alertError');
                    if (alertError) {
                        alertError.style.display = 'none';
                    }
                }, 3000); // 2 seconds
            });
        </script>
    </div>

    <!-- /BREADCRUMB -->
    <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    <!-- Product main img -->
                    <div class="col-md-5 col-md-push-2">

                        <div id="product-main-img">
                            @foreach ($product->productImage as $image)
                                <div class="product-preview">
                                    <img src="{{ asset('products_img/' . $image->path) }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /Product main img -->
                    <!-- Product thumb imgs -->
                    <div class="col-md-2  col-md-pull-5">
                        <div id="product-imgs">
                            @foreach ($product->productImage as $image)
                                <div class="product-preview">
                                    <img src="{{ asset('products_img/' . $image->path) }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /Product thumb imgs -->

                    <!-- Product details -->
                    <div class="col-md-5">
                        <div class="product-details">
                            <!-- Tên và đánh giá  -->
                            <h2 class="product-name">{{ $product->name }}</h2>
                            <div>
                                <!-- Đánh giá -->
                                <div class="product-rating">
                                    @php
                                        $averageRating = ($product->productComment->count() > 0) ?
                                        $product->productComment->avg('rating') : 0;
                                    @endphp

                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <=round($averageRating))
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </div>
                                <a class="review-link" data-toggle="tab" href="#tab3">{{ $product->productComment->count() }} Đánh giá({{$product->productComment->count()}}) | Thêm đánh giá</a>
                                <!-- /Đánh giá -->

                                <!-- Hiển thị chi tiết sản phẩm - Số lượng - Size - Màu -->
                                <div>
                                    @php
                                        $price = $product->productDetail->min('price');
                                        $formattedPrice = number_format($price, 0, ',', '.');
                                        $PriceX = number_format($price * 1.3, 0, ',', '.');
                                    @endphp
                                    <h3 class="product-price">{{ $formattedPrice }} VND<del class="product-old-price">{{ $PriceX }}</del></h3>
                                    <span class="product-available">
                                        @if ($product->quantity > 0)
                                            Số lượng ({{ $product->quantity }})
                                        @else
                                            Hết Hàng
                                        @endif
                                    </span>
                                </div>
                                <!-- Mô tả sản phẩm -->
                                <p>{{ $product->description }}</p>

                                <!-- Các lựa chọn size và màu -->
                                <div class="product-options">
                                    <label>
                                        Màu sắc
                                        <select class="input-select">
                                            @foreach ($product->productDetail as $detail)
                                                @if ($detail->color)
                                                    <option value="{{ $detail->color }}">{{ $detail->color }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <!-- Số lượng sản phẩm và nút thêm vào giỏ hàng -->
                                <div class="add-to-cart">
                                    <form action="{{ route('carts.store') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="price" value="{{ $formattedPrice }}">

                                        <div class="qty-label">
                                            Số lượng
                                            <div class="input-number">
                                                <input id="quantityInput" type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" onchange="if(parseInt(this.value) < parseInt(this.min)) this.value = this.min; if(parseInt(this.value) > parseInt(this.max)) this.value = this.max;">
                                                <span class="qty-up">+</span>
                                                <span class="qty-down">-</span>
                                            </div>
                                        </div>
                                        @if ($product->quantity > 0)
                                            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                                        @else
                                            <button type="button" class="add-to-cart-btn" disabled><i class="fa fa-shopping-cart"></i>Hết hàng</button>
                                        @endif
                                    </form>
                                </div>
                                <!-- Thêm vào yêu thích và so sánh sản phẩm -->
                                <form action="{{ route('favorites.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-link p-0" style="background-color: transparent; border: none; text-decoration: none; color: black;">
                                        <i class="fa fa-heart-o"></i> Thêm vào yêu thích
                                    </button>
                                </form>



                                <!-- Danh mục của sản phẩm  -->
                                <ul class="product-links">
                                    <li>Danh mục:</li>
                                    @if ($product->productCategory)
                                        <li><a href="{{route('products.index')}}">{{ $product->productCategory->name }}</a></li>
                                    @endif
                                </ul>

                                <!-- Share sản phẩm -->
                                <ul class="product-links">
                                    <li>Chia sẻ:</li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
								<li><a data-toggle="tab" href="#tab2">Chi tiết</a></li>
								<li><a data-toggle="tab" href="#tab3">Đánh giá ({{ $product->productComment->count() }})</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
                                <!-- tab1-Description  -->
                                <div id="tab1" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>{{$product->description}}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /tab1  -->

                                <!-- tab2-Details  -->
                                <div id="tab2" class="tab-pane fade in">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>{{$product->details}}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /tab2  -->

								<!-- tab3 -->
                                <div id="tab3" class="tab-pane fade in">
                                    <div class="row">
                                        <!-- Rating -->
                                        <div class="col-md-3">
                                            <div id="rating">
                                                <div id="rating" class="rating-avg">
                                                    <span>{{ number_format($averageRating, 1) }}</span>
                                                    <div class="rating-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= round($averageRating))
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <!-- Hiển thị số lượng từng đánh giá -->
                                                <ul class="rating">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <li>
                                                            <div class="rating-stars">
                                                                @for ($j = 1; $j <= $i; $j++)
                                                                    <i class="fa fa-star"></i>
                                                                @endfor
                                                                @for ($k = 1; $k <= (5 - $i); $k++)
                                                                    <i class="fa fa-star-o"></i>
                                                                @endfor
                                                            </div>
                                                            <div class="rating-progress">
                                                                <!-- Tính độ dài các cột Rating dựa trên tổng số Rating -->
                                                                @php
                                                                    $totalCount = $product->productComment->count();
                                                                    $count = $product->productComment->where('rating', '=', $i)->count();
                                                                    $percentage = ($totalCount > 0) ? ($count / $totalCount) * 100 : 0;
                                                                @endphp
                                                                <div style="width: {{$percentage}}%"></div>
                                                            </div>
                                                            <span class="sum">{{ $count }}</span>
                                                        </li>
                                                    @endfor
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /Rating -->

                                        <!-- Reviews -->
                                        <div class="col-md-6">
                                            <div id="reviews">
                                                <ul class="reviews">
                                                    @foreach($comments as $comment)
                                                        <li>
                                                            <div class="review-heading">
                                                                <h5 class="name">{{ $comment->name }}</h5>
                                                                <p class="date">{{ $comment->created_at->format('d M Y, h:i A') }}</p>
                                                                <div class="review-rating">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        @if($i <= $comment->rating)
                                                                            <i class="fa fa-star"></i>
                                                                        @else
                                                                            <i class="fa fa-star-o empty"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="review-body">
                                                                <p>{{ $comment->messages }}</p>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <!-- Hiển thị phân trang -->
                                            <ul class="reviews-pagination">
                                                {{-- Previous Page Link --}}
                                                @if ($comments->onFirstPage())
                                                    <li class="disabled"><span>&laquo;</span></li>
                                                @else
                                                    <li><a href="{{ $comments->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                                @endif

                                                {{-- Pagination Elements --}}
                                                @foreach ($comments->getUrlRange(1, $comments->lastPage()) as $page => $url)
                                                    <li class="{{ ($page == $comments->currentPage()) ? 'active' : '' }}">
                                                        <a href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endforeach

                                                {{-- Next Page Link --}}
                                                @if ($comments->hasMorePages())
                                                    <li><a href="{{ $comments->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                                @else
                                                    <li class="disabled"><span>&raquo;</span></li>
                                                @endif
                                            </ul>
                                            <!-- /Hiển thị phân trang -->
                                        </div>
                                        <!-- /Reviews -->

                                        <!--Review Form -->
                                        @if(Auth::check() && $userBoughtProduct)
                                        <div class="col-md-3">
                                            <div id="review-form">
                                                <form id="reviewForm" class="review-form" action="{{ route('product.comments.store', ['id' => $product->id]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <input class="input" type="hidden" name="name" value="{{ Auth::user()->name }}">
                                                    <textarea class="input" name="messages" placeholder="Your Review" required></textarea>
                                                    <div class="input-rating">
                                                        <span>Xếp hạng: </span>
                                                        <div class="stars">
                                                            @for ($i = 5; $i >= 1; $i--)
                                                                <input id="star{{ $i }}" name="rating" value="{{ $i }}" type="radio" required>
                                                                <label for="star{{ $i }}"></label>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    @php
                                                        $userComment = \App\Models\ProductComment::where('product_id', $product->id)
                                                                                                        ->where('user_id', Auth::user()->id)
                                                                                                        ->first();
                                                    @endphp
                                                    <button type="submit" class="primary-btn">
                                                        {{ $userComment ? 'Sửa bình luận' : 'Gửi đánh giá' }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                            @if(Auth::check())
                                                <p>Bạn cần mua sản phẩm để để lại bình luận!</p>
                                            @else
                                                <div class="col-md-3">
                                                    <p>Bạn cần <a href="{{ route('login', ['previous' => url()->current()]) }} "> đăng nhập</a> để bình luận.</p>
                                                </div>
                                            @endif
                                        @endif
                                        <!-- /Review Form -->
                                    </div>
                                </div>
                                <!-- /tab3 -->

							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->


        <!-- Related Products -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="title">Sản phẩm tương tự</h3>
                    </div>
                    @if($relatedProducts->isEmpty())
                        <div class="col-md-12">
                            <p>Không có sản phẩm tương tự.</p>
                        </div>
                    @else
                        @foreach($relatedProducts as $pr)
                            <div class="col-md-3 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <!-- Lấy hình ảnh đầu tiên của sản phẩm -->
                                        @if($pr->productImage->count() > 0)
                                            <img src="{{ asset('products_img/' . $pr->productImage->first()->path) }}" alt="{{ $pr->name }}">
                                        @else
                                            <img src="placeholder.jpg" alt="{{ $pr->name }}">
                                        @endif
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">
                                            <!-- Kiểm tra xem sản phẩm có danh mục không trước khi truy cập -->
                                            @if($pr->productCategory)
                                                {{ $pr->productCategory->name }}
                                            @else
                                                Không có sản phẩm tương tự
                                            @endif
                                        </p>
                                        <h3 class="product-name"><a href="#">{{ $pr->name }}</a></h3>
                                        <h4 class="product-price">
                                            <!-- Lấy giá và giá cũ của sản phẩm -->
                                            @if($pr->productDetail->count() > 0)
                                                <h3 class="product-price">{{ $formattedPrice }} VND<del class="product-old-price">{{ $PriceX }}</del></h3>
                                            @else
                                                Không có giá xác định
                                            @endif
                                        </h4>
                                        <div class="product-rating">
                                            <!-- Hiển thị xếp hạng sao nếu có -->
                                        </div>
                                        <div class="product-btns">
                                            <!-- Các nút như yêu thích, so sánh, xem nhanh -->
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                    <form action="{{ route('carts.store') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="price" value="{{ $formattedPrice }}">

                                            <div class="input-number">
                                                <input type="hidden" id="quantityInput" type="number" name="quantity" value="1" >
                                            </div>
                                        @if ($product->quantity > 0)
                                            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                                        @else
                                            <button type="button" class="add-to-cart-btn" disabled><i class="fa fa-shopping-cart"></i>Hết hàng</button>
                                        @endif
                                    </form>
                                </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- /Related Products -->

@endsection
