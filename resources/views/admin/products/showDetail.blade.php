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
                                        Chi tiết sản phẩm
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body display_data">
                                    <div class="position-relative row form-group">
                                        <label for="" class="col-md-3 text-md-right col-form-label">Ảnh</label>
                                        <div class="col-md-9 col-xl-8">
                                            <ul class="text-nowrap overflow-auto" id="images">
                                                <li class="d-inline-block mr-1" style="position: relative;">
                                                    @foreach($product->productImage as $image)
                                                        <img src="{{ asset('products_img/' . $image->path) }}" alt="{{ $product->name }}">
                                                        @break
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="brand_id" class="col-md-3 text-md-right col-form-label">Hãng</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$product->productBrand->name}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="product_category_id" class="col-md-3 text-md-right col-form-label">Danh mục</label>
                                        <div class="col-md-9 col-xl-8">
                                        <p>{{$product->productCategory->name}}</p>
                                        </div>
                                    </div>
                                
                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$product->name}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="content" class="col-md-3 text-md-right col-form-label">Mô tả</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$product->description}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="price" class="col-md-3 text-md-right col-form-label">Chi tiết</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$product->details}}</p>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="color" class="col-md-3 text-md-right col-form-label">Màu sắc</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{ $productDetail->color }}</p>
                                        </div>
                                    </div>

                                    @php
                                        $price = $productDetail->price;
                                        $formattedPrice = number_format($price, 0, ',', '.');
                                        $PriceX = number_format($price * 1.3, 0, ',', '.');
                                    @endphp
                                    <div class="position-relative row form-group">
                                        <label for="discount" class="col-md-3 text-md-right col-form-label">Giá</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{$PriceX}}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="qty" class="col-md-3 text-md-right col-form-label">Số lượng tồn kho</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{ $productDetail->quantity }}</p>
                                        </div>
                                    </div>

                                </div>
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

@endsection
