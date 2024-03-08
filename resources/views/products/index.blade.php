@extends('layouts.app')
@section('title', 'Trang chủ')
@section('main')


<!-- BREADCRUMB -->
{{-- <div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">All Categories</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li class="active">Headphones (227,490 Results)</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div> --}}
<!-- /BREADCRUMB -->
<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="{{ Request::is('home|/') ? 'active' : '' }}"><a href="/">TRANG CHỦ</a></li>
                <li class="{{ Request::is('products') ? 'active' : '' }}"><a href="{{ route('products.index') }}" >SẢN PHẨM</a></li>
                <li class="{{ Request::is('products?keyword=op%20lung') ? 'active' : '' }}"><a href="" data-key="op lung">ỐP LƯNG</a></li>
                <li class="{{ Request::is('products?keyword=tai%20Nghe*') ? 'active' : '' }}"><a href="" data-key="tai Nghe">TAI NGHE</a></li>
                <li class="{{ Request::is('products?keyword=sac*') ? 'active' : '' }}"><a href="" data-key="sac">DÂY SẠC - CỦ SẠC</a></li>
                <li class="{{ Request::is('products?keyword=sac%20du%20phong*') ? 'active' : '' }}"><a href="" data-key="sac du phong">SẠC DỰ PHÒNG</a></li>
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
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Thế Loại</h3>
                    <div class="checkbox-filter">
                        @foreach ($categories as $item)

                        <div class="input-checkbox">
                            <input onchange="Choose()" value="{{ $item->id }}" name="category" type="checkbox" id="category{{ $item->id }}">
                            <label for="category{{ $item->id }}">
                                <span></span>
                                {{ $item->name }}
                                <small>({{ $item->getTotalCategory() }})</small>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Mức Giá</h3>
                    <div class="radio-filter">
                        <div class="input-radio">
                            <input onchange="Choose()" value="9" name="price" type="radio" id="price0">
                            <label for="price0">
                                <span></span>
                                Tất cả
                            </label>
                        </div>

                        <div class="input-radio">
                            <input onchange="Choose()" value="1" name="price" type="radio" id="price1">
                            <label for="price1">
                                <span></span>
                                Dưới 2 triệu
                            </label>
                        </div>

                        <div class="input-radio">
                            <input onchange="Choose()" value="2" name="price" type="radio" id="price2">
                            <label for="price2">
                                <span></span>
                                Từ 2 đến 4 triệu
                            </label>
                        </div>

                        <div class="input-radio">
                            <input onchange="Choose()" value="3" name="price" type="radio" id="price3">
                            <label for="price3">
                                <span></span>
                                Từ 4 đến 7 triệu
                            </label>
                        </div>

                        <div class="input-radio">
                            <input onchange="Choose()" value="4" name="price" type="radio" id="price4">
                            <label for="price4">
                                <span></span>
                                Lớn hơn 7 triệu
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Hãng</h3>
                    <div class="checkbox-filter">
                        @foreach ($brands as $item)
                        <div class="input-checkbox">
                            <input onchange="Choose()" type="checkbox" value="{{ $item->id }}" name="brand" id="brand{{ $item->id }}">
                            <label for="brand{{ $item->id }}">
                                <span></span>
                                {{ $item->name }}
                                <small>({{ $item->getTotalBrand() }})</small>
                            </label>
                        </div>
                        @endforeach


                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Sản Phẩm Mới Nhất</h3>
                    @foreach ($products as $item)
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="products_img/{{ $item->productImage->get(0)->path }}" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">{{ $item->productCategory->name }}</p>
                            <h3 class="product-name"><a href="{{route('products.show',  $item->id)}}">{{ $item->name }}</a></h3>
                            @php
                                $price = $item->productDetail->min('price');
                                $formattedPrice = number_format($price, 0, ',', '.'); // Định dạng giá tiền
                                $PriceX = number_format($price*1.3, 0, ',', '.');
                            @endphp
                            <h4 class="product-price">{{ $formattedPrice }}<del class="product-old-price">{{ $PriceX }}</del></h4>
                        </div>
                    </div>
                    @endforeach


                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
                <div class="store-sort">
                    <label>
                        Sort By:
                        <select id="sortSelect" class="input-select" onchange="Choose()">
                            <option  value="0">Giá Thấp đến Cao</option>
                            <option  value="1">Giá Cao đến Thấp</option>
                        </select>
                    </label>


                </div>
            <div id="storess" class="col-md-9">
                <!-- store top filter -->

                <!-- /store bottom filter -->
            </div>

            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection
