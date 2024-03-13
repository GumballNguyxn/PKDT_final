@extends('admin.layouts.app')
@section('main')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <h3>Thống kê</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-between">
            @foreach ($tableCounts as $tableName => $rowCount)
                <div class='col-md-2 card'>
                    <div class="card-header text-center">
                    <?php
                    switch ($tableName) {
                        case 'users':
                            echo 'Người dùng';
                            break;
                        case 'orders':
                            echo 'Đơn hàng';
                            break;
                        case 'products':
                            echo 'Sản phẩm';
                            break;
                        case 'product_categories':
                            echo 'Danh mục';
                            break;
                        case 'brands':
                            echo 'Hãng';
                            break;
                        default:
                            echo 'Unknown';
                    }
                    ?>
                    </div>
                    <div class="card-main h2 text-center p-3">
                        {{$rowCount}}
                    </div>
                </div>
            @endforeach
    </div>
    <!-- End Main -->
	
@endsection
