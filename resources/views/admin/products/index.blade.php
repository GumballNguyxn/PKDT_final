@extends('admin.layouts.app')

@section('main')
    <!-- Main -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <h3>Sản phẩm</h3>
                        <div class="page-title-subheading">
                            Xem, thêm mới, cập nhật, xóa và quản lý.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="{{ route('products.create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-danger d-flex">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                            </svg>
                        </span>
                        Thêm
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="Tìm kiếm" class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </form>

                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th class="text-center">Hãng</th>
                                    <th class="text-center">Danh mục</th>
                                    <th class="text-center">Màu sắc</th>
                                    <th class="text-center">Giá tiền</th>
                                    <th class="text-center">Số lượng tồn kho</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                @foreach ($product->productDetail as $key => $detail)
                                    <tr>
                                        <td class="text-center text-muted">
                                            @if($key == 0)
                                                {{ $product->id }} - {{ $detail->id }} 
                                            @else
                                                - {{ $detail->id }} <!-- Hiển thị productDetail Id -->
                                            @endif
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <!-- Lấy ra ảnh -->
                                                        <div class="widget-content-left">
                                                            @foreach ($product->productImage as $image)
                                                                <img width="40" class="rounded-circle"
                                                                    data-toggle="tooltip" title="Image"
                                                                    data-placement="bottom"
                                                                    src="{{ asset('products_img/' . $image->path) }}" alt="Ảnh sản phẩm">
                                                                @break 
                                                            @endforeach
                                                        </div>
                                                        <!--End- Lấy ra ảnh -->
                                                    </div>
                                                    <!-- Lấy ra tên -->
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading" style="color: #1E1F29;">{{ $product->name }}</div>
                                                    </div>
                                                    <!--End- Lấy ra tên -->
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Hiển thị hãng -->
                                        <!-- Hiển thị hãng -->
                                        <td class="text-center">
                                            @if ($product->productBrand)
                                                {{ $product->productBrand->name }}
                                            @endif

                                        </td>
                                        <!-- Hiển thị danh mục -->
                                        <td class="text-center">
                                            @if ($product->productCategory)
                                                {{ $product->productCategory->name }}
                                            @endif
                                        </td>
                                        
                                        <!-- Hiển thị màu sắc -->
                                        <td class="text-center">
                                            @if ($detail->color)
                                                {{ $detail->color }}
                                            @endif
                                        </td>
                                        <!-- Hiển thị giá tiền -->
                                        <td class="text-center">
                                            @if ($detail->price)
                                                {{ $detail->price }}
                                            @endif
                                        </td>
                                        <!-- Hiển thị số lượng tồn kho -->
                                        <td class="text-center">
                                            @if ($detail->quantity)
                                                {{ $detail->quantity }}
                                            @endif
                                        </td>
                                        <!-- Các hành động -->
                                        <td class="text-center col-md-2">
                                        <a href="{{ route('admin.products.showDetail', ['productId' => $product->id, 'productDetailId' => $detail->id]) }}" class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Chi tiết
                                        </a>

                                            <a href="{{ route('admin.products.edit', ['productId' => $product->id, 'productDetailId' => $detail->id]) }}" class="btn btn-outline-warning border-0 btn-sm" data-toggle="tooltip" title="Edit" data-placement="bottom">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                    </svg>
                                                </span>
                                            </a>

                                            <form class="d-inline" action="{{ route('products.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm" type="submit" data-toggle="tooltip" title="Delete" data-placement="bottom" onclick="return confirm('Bạn có muốn xóa bản ghi này?')">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
