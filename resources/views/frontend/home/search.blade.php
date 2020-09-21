@extends('layouts.ghn')
@section('content')
    <div class="site-section bg-light" id="contact-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-7 text-center mb-5">
                    <h2>Tra Cứu Mã Vận Đơn</h2>
                </div>
            </div>
                <form method="get" class="row">
                <div class="col-lg-8 mb-5">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Nhập mã vận đơn..." name="bill_id" value="{{$bill_id}}" required>
                            </div>
                        </div>
                </div>
                <div class="col-lg-4 ml-auto">
                    <div class="bg-white">
                        <div class="form-group row">
                            <div class="col-md-12 mr-auto">
                                <input value="Tra cứu" type="submit" class="btn btn-block btn-primary text-white py-3 px-5">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
        </div>
    </div>
    <div class="col-md-12 m-b--5 mt-2">
        @if($bill_id != null && $bill_info == null)
            <div class="text-center">
                <h2>Thông Tin Đơn Hàng</h2>
                    <h4 class="text-danger">Không tìm thấy thông tin đơn hàng có mã là : <strong>{{$bill_id}}</strong></h4>
            </div>
        @elseif($bill_info != null)
            <div class="container site-section mb-5">
                <div class="row justify-content-center text-center">
                    <div class="col-7 text-center mb-5">
                        <h2>Trạng Thái Đơn Hàng</h2>
                    </div>
                </div>
                <div class="how-it-works d-flex text-center">
                    @if($bill_info['status'] == 'new')
                        @include('frontend.home.status.new')
                    @elseif($bill_info['status'] == 'waitting')
                        @include('frontend.home.status.new')
                        @include('frontend.home.status.waitting')
                    @elseif($bill_info['status'] == 'running')
                        @include('frontend.home.status.new')
                        @include('frontend.home.status.waitting')
                        @include('frontend.home.status.running')
                    @elseif($bill_info['status'] == 'done')
                        @include('frontend.home.status.new')
                        @include('frontend.home.status.waitting')
                        @include('frontend.home.status.running')
                        @include('frontend.home.status.done')
                    @endif
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Chi Tiết Đơn Hàng</h2>
                            <div class="invoice-number text-danger">Order #{{$bill_info['id']}}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <address>
                                    <strong>Người gửi:</strong><br>
                                    @if(isset($bill_info->seller))
                                        <p>{{$bill_info->seller->name}}</p>
                                        <p>{{$bill_info->seller->email}}</p>
                                        <p>{{$bill_info->seller->phone}}</p>
                                    @endif
                                </address>
                            </div>
                            <div class="col-md-4">
                                <address>
                                    <strong>Người nhận:</strong><br>
                                    @if(isset($bill_info->customer))
                                        <p>{{$bill_info->customer->name}}</p>
                                        <p>{{$bill_info->customer->email}}</p>
                                        <p>{{$bill_info->customer->phone}}</p>
                                    @endif

                                </address>
                            </div>
                            <div class="col-md-4">
                                <address>
                                    <strong>Shipper:</strong><br>
                                    @if(isset($bill_info->staff))
                                        <p>{{$bill_info->staff->name}}</p>
                                        <p>{{$bill_info->staff->email}}</p>
                                        <p>{{$bill_info->staff->phone}}</p>
                                    @else
                                        <p class="text-danger">Chưa được điều phối</p>
                                    @endif

                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <address>
                                    <strong>Gửi từ:</strong><br>
                                    {{$bill_info['from']}}
                                </address>
                            </div>
                            <div class="col-md-4">
                                <address>
                                    <strong>Gửi đến:</strong><br>
                                    {{$bill_info['to']}}<br><br>
                                </address>

                            </div>
                            <div class="col-md-4">
                                @if(isset($bill_info->staff))
                                <address>
                                    <strong>Người bán đánh giá:</strong><br>
                                    @if($bill_info['seller_rate'] > 0)
                                        @for($i=1;$i<= $bill_info['seller_rate'];$i++)
                                            <i class="text-warning fa fa-star"></i>
                                        @endfor
                                    @endif
                                </address>
                                <address>
                                    <strong>Khách hàng đánh giá:</strong><br>
                                    @if($bill_info['customer_rate'] > 0)
                                        @for($i=1;$i<= $bill_info['customer_rate'];$i++)
                                            <i class="text-warning fa fa-star"></i>
                                        @endfor
                                    @endif
                                </address>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">Phí Dịch Vụ</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tbody>
                                <tr>
                                    <th data-width="40" style="width: 40px;">#</th>
                                    <th>Dịch vụ</th>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                    <th class="text-right">Thành tiền</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Phí Ship</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">{{number_format($bill_info['cod_price'])}} Vnđ</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Giá trị đơn hàng</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">{{number_format($bill_info['money'])}} Vnđ</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="section-title"></div>
                                <div class="images">

                                </div>
                            </div>
                            <div class="col-lg-4 text-right">
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name"><strong>Tổng tiền</strong></div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">{{number_format($bill_info['money'] + $bill_info['cod_price'])}} Vnđ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
