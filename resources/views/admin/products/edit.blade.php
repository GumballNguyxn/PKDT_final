@extends('admin.layouts.app')

@section('main')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z"/>
                    </svg>
                </div>
                <div>
                    Product
                    <div class="page-title-subheading">
                        Sửa sản phẩm
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Thông tin sản phẩm</h5>

                    <!-- Hiển thị thông tin sản phẩm và form chỉnh sửa -->
                    <label >Sửa thông tin</label>
                    <form method="post" action="{{ route('admin.products.update',['productId' => $product->id, 'productDetailId' => $productDetail->id])}}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <!-- Input cho tên sản phẩm -->
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                        </div>

                        <!-- Input cho hãng -->
                        <div class="form-group">
                            <label for="brand_id">Hãng</label>
                            <select class="form-control" id="brand_id" name="brand_id">
                                <option value="">Chọn hãng</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input cho danh mục -->
                        <div class="form-group">
                            <label for="product_category_id">Danh mục</label>
                            <select class="form-control" id="product_category_id" name="product_category_id">
                                <option value="">Chọn danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input cho màu sắc -->
                        <div class="form-group">
                            <label for="color">Màu sắc</label>
                            <input type="text" class="form-control" id="color" name="color" value="{{ $productDetail->color }}">
                        </div>

                        <!-- Input cho số lượng -->
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $productDetail->quantity }}">
                        </div>

                        <!-- Input cho giá tiền -->
                        <div class="form-group">
                            <label for="price">Giá tiền</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $productDetail->price }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>

                    <!-- Form cập nhật ảnh -->
                    <label style="font-weight: bold; font-size: 18px;">Sửa Ảnh</label>
                    <form method="POST" action="{{ route('admin.products.updateImage', ['productId' => $product->id, 'productImageId' => $productImage->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Input cho ảnh mới -->
                        <div class="form-group">
                            <label for="newImage">Chọn ảnh mới</label>
                            <input type="file" class="form-control-file" id="newImage" name="newImage[]" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật ảnh</button>
                    </form>
                    <!-- Kết thúc form chỉnh sửa -->
                    <div class="text-center">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-warning border-0 btn-sm" style="color: #007bff !important;" data-toggle="tooltip" title="Trở về" data-placement="bottom">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-square" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                    <path d="M10.205 12.456A.5.5 0 0 0 10.5 12V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4a.5.5 0 0 0 .537.082"/>
                                </svg>
                                Trở về
                            </a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
