@extends('admin.layouts.app')

@section('main')
 

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Order
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body display_data">

                                    <div class="table-responsive">
                                        <h2 class="text-center">Danh sách sản phẩm</h2>
                                        <hr>
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th class="text-center">Số lượng</th>
                                                    <th class="text-center">Đơn giá</th>
                                                    <th class="text-center">Tổng cộng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->orderDetails as $orderDetail)
                                                    <tr>
                                                        <td>
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3">
                                                                        <div class="widget-content-left">
                                                                            <img src="{{ $orderDetail->product->productImage->first()?->path ?? 'path_to_placeholder_image' }}" alt="Product Image" style="width: 50px; height: 50px;">
                                                                        </div>  
                                                                    </div>
                                                                    <div class="widget-content-left flex2">
                                                                        <div class="widget-heading  text-black">{{ $orderDetail->product->name }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">{{ $orderDetail->quantity }}</td>
                                                        <td class="text-center">{{ number_format($orderDetail->price, 2) }} VNĐ</td>
                                                        <td class="text-center">{{ number_format($orderDetail->quantity * $orderDetail->price, 2) }} VNĐ</td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



                                                <h2 class="text-center mt-5">Thông tin đơn hàng</h2>
                                                <hr>

                                                <div class="position-relative row form-group">
                                                    <label for="name" class="col-md-3 text-md-right col-form-label">
                                                        Họ tên:
                                                    </label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <p>{{ $order->name }}</p>
                                                    </div>
                                                </div>

                                                <div class="position-relative row form-group">
                                                    <label for="email" class="col-md-3 text-md-right col-form-label">Email:</label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <p>{{ $order->email }}</p>
                                                    </div>
                                                </div>

                                                <div class="position-relative row form-group">
                                                    <label for="phone" class="col-md-3 text-md-right col-form-label">Số điện thoại:</label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <p>{{ $order->phone_number }}</p>
                                                    </div>
                                                </div>

                                                <div class="position-relative row form-group">
                                                    <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                                        Địa chỉ:
                                                    </label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <p>{{ $order->address }}</p>
                                                    </div>
                                                </div>

                                                <div class="position-relative row form-group">
                                                    <label for="status" class="col-md-3 text-md-right col-form-label">Trạng thái</label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <div class="badge badge-dark mt-2">
                                                            {{ $order->status }}
                                                        </div>
                                                    </div>
                                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection