@extends('admin.layouts.app')

@section('main')
<div class="app-main__inner">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div>
                <h3>Thống kê</h3>
                <div class="page-title-subheading">
                    Xem báo cáo 

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Biểu đồ Số lượng bán ra </span>
                            <div class="btn-group" role="group" aria-label="Lọc theo">
                                <button type="button" class="btn btn-secondary" onclick="filterBy('day')">Ngày</button>
                                <button type="button" class="btn btn-secondary" onclick="filterBy('week')">Tuần</button>
                                <button type="button" class="btn btn-secondary" onclick="filterBy('month')">Tháng</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart1" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Biểu đồ Doanh thu</span>
                            <div class="btn-group" role="group" aria-label="Lọc theo">
                                <button type="button" class="btn btn-secondary" onclick="filterBy('day')">Ngày</button>
                                <button type="button" class="btn btn-secondary" onclick="filterBy('week')">Tuần</button>
                                <button type="button" class="btn btn-secondary" onclick="filterBy('month')">Tháng</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
<script>
    var productSalesData = @json($productSalesData);
    var colors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)'];


    // Get the canvas element
    var ctx1 = document.getElementById('myChart1').getContext('2d');

    // Create the bar chart
    var myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: productSalesData.labels.map(id => id.toString()), // Chuyển đổi ID sang chuỗi
            datasets: [{
                label: 'Số lượng bán ra',
                data: productSalesData.data,
                backgroundColor: colors,
                borderColor: colors.map(color => color.replace('0.5', '1')), // Tối màu cho viền
                borderWidth: 1
            }]
        },
    
    });
</script>



@endsection
