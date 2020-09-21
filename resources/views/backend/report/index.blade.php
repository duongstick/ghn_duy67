@extends('layouts.admin')
@section('content')
    <div class="row">

        <div class="col-md-12 text-center">
            <div class="card">
                <div class="card-header">
                    <h4>Thời gian thống kê</h4>
                </div>
                <div class="card-body">
                    <form method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="from" value="{{$from}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="to" value="{{$to}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary">
                                    <i class="fa fa-search mr-2"></i>Thống kê
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15"> Khách hàng</h5>
                                    <h2 class="mb-3 font-18">{{$customers}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{asset('backend/assets/img/banner/4.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Đơn hàng mới</h5>
                                    <h2 class="mb-3 font-18">{{$new_bills}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{asset('backend/assets/img/banner/3.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Đơn đang vận chuyển</h5>
                                    <h2 class="mb-3 font-18">{{$running_bills}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{asset('backend/assets/img/banner/2.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Đơn hàng hoàn thành</h5>
                                    <h2 class="mb-3 font-18">{{$done_bills}}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{asset('backend/assets/img/banner/1.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Biểu đồ doanh thu</h4>
                </div>
                <div class="card-body">
                    <div class="recent-report__chart">
                        <canvas id="chart4"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('backend/assets/bundles/chartjs/chart.min.js')}}"></script>

    <script>
        $(function () {
            var data = JSON.parse('<?php echo json_encode($data_chart['data']) ?>');
            var categories = JSON.parse('<?php echo json_encode($data_chart['categories']) ?>');
                chart4(data,categories);
        });

        function chart4(data,categories) {
            console.log(data,categories)
            var ctx = document.getElementById("chart4");
            if (ctx) {
                ctx.height = 150;
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: categories,
                        datasets: [
                            {
                                label: "Doanh thu",
                                borderColor: "rgba(0, 123, 255, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(0, 123, 255, 0.5)",
                                pointHighlightStroke: "rgba(26,179,148,1)",
                                data: data
                            }
                        ]
                    },
                    options: {
                        legend: {
                            position: 'top',
                            labels: {
                            }

                        },
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontColor: "#9aa0ac", // Font Color
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#9aa0ac", // Font Color
                                }
                            }]
                        }

                    }
                });
            }

        }
    </script>
@endsection
