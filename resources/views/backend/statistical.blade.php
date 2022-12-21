@extends('backend.dashboard')
@section('content-body')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $countOrderToday }}</h3>

                            <p>Đơn hàng mới</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a class="small-box-footer" href="{{ route('admin.order.list') }}">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $revenueDifference }}<sup style="font-size: 20px">%</sup></h3>

                            <p>Doanh thu tháng này</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a class="small-box-footer" href=""><i class="fa-solid fa-money-bill-trend-up"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $countUser }}</h3>

                            <p>Người dùng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a class="small-box-footer" href="{{ route('admin.account.list') }}">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                {{-- <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a class="small-box-footer" href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div> --}}
                <!-- ./col -->
            </div>

            <div class="row d-flex flex-row flex-xl-nowrap flex-wrap">
                <div class="panel-body col-xl-6 col-12 border m-2 p-5">
                    <canvas height="280" id="canvas" width="600"></canvas>
                </div>

                <div class="panel-body col-xl-6 col-12 border m-2 p-5">
                    <canvas height="280" id="order" width="600"></canvas>
                </div>
            </div>
            <div class="row d-flex flex-row flex-xl-nowrap flex-wrap">
                <div class="panel-body col-xl-6 col-12 border m-2 p-5">
                    <canvas height="280" id="revenue" width="600"></canvas>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        var order = {!! $arrayOrderStatus !!}
        var orderData = {
            labels: [
                'Chờ xác nhận',
                'Giao hàng',
                'Thành công',
                'Bị hủy'
            ],
            datasets: [{
                label: 'Đơn hàng',
                backgroundColor: [
                    'rgb(251, 193, 11)',
                    'rgb(35, 106, 217)',
                    'rgb(41, 167, 69)',
                    'rgb(220, 53, 69)'
                ],
                data: Object.values(order)
            }]
        };

        var orderByDay = {!! $orderByDay !!}
        var orderDataDay = {
            labels: Object.keys(orderByDay),
            datasets: [{
                label: 'Số lượng',
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                data: Object.values(orderByDay)
            }]
        };

        var revenueMonth = {!! $revenueMonth !!}
        var revenueMonthData = {
            labels: Object.keys(revenueMonth),
            datasets: [{
                label: 'Doanh thu',
                fill: false,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgb(54, 162, 235)',
                data: Object.values(revenueMonth)
            }]
        };

        window.onload = function() {
            var orderDay = document.getElementById("order").getContext("2d");
            window.lineOrder = new Chart(orderDay, {
                type: 'line',
                data: orderDataDay,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Đơn hàng theo ngày trong 30 ngày qua'
                    }
                }
            });

            // Order By Day
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'doughnut',
                data: orderData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Đơn hàng trong 30 ngày qua'
                    }
                }
            });
            // Revenue By Month
            var revenueCv = document.getElementById("revenue").getContext("2d");
            window.myRevenueBar = new Chart(revenueCv, {
                type: 'bar',
                data: revenueMonthData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Doanh thu'
                    }
                }
            });
        };
    </script>
@endsection
