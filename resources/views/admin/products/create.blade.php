@extends('admin.layouts.app')

@section('main')
<div class="app-main__inner">

    <!-- Tab content -->
    <div class="tab-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Thông tin sản phẩm</h5>
                            <!-- Thêm thông tin sản phẩm -->
                            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand_id">Hãng</label>
                                    <select required="" name="brand_id" id="brand_id" class="form-control">
                                        <option value="">-- Hãng --</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_category_id">Danh mục</label>
                                    <select required="" name="product_category_id" id="product_category_id" class="form-control">
                                        <option value="">-- Danh mục --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input required="" name="name" id="name" placeholder="Name" type="text" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label for="product_image">Ảnh sản phẩm</label>
                                    <input type="file" class="form-control-file" id="product_image" name="product_image" required>
                                    <small id="productImagesHelp" class="form-text text-muted">Chọn ảnh sản phẩm </small>
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Mô tả"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="details">Chi tiết</label>
                                    <textarea class="form-control" name="details" id="details" placeholder="Chi tiết"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="color">Màu sắc</label>
                                    <input type="text" class="form-control" id="color" name="color" required>
                                </div>

                                <div class="form-group">
                                    <label for="price">Giá tiền</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Số lượng</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                                </div>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-warning border-0 btn-sm" style="color: #007bff !important;" data-toggle="tooltip" title="Trở về" data-placement="bottom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                        <path d="M10.205 12.456A.5.5 0 0 0 10.5 12V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4a.5.5 0 0 0 .537.082"/>
                                    </svg>
                                    Trở về
                                </a>
                                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            </form>
                            <!--End-Thêm thông tin sản phẩm -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
