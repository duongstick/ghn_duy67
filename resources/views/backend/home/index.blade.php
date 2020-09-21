@extends('layouts.admin')
@section('content')
    <div class="row ">
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
                                    <h5 class="font-15">Đơn hàng đang vận chuyển</h5>
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
        <div class="col-12">
            @if(auth()->user()->role == 'admin')
                <div class="card">
                <div class="card-header">
                    <h4>Đơn hàng chờ điều phối</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Người tạo đơn</th>
                                <th>Khách nhận</th>
                                <th>Hình thức</th>
                                <th>Phí Ship</th>
                                <th>Trạng thái</th>
                                <th>Đơn vị vận chuyển</th>
                                <th>Thời gian tạo</th>
                                <th class="text-center">Xác nhận</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data) && count($data) > 0)
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>
                                            @if(isset($item->seller))
                                                <p>{{$item->seller->name}}</p>
                                                <p>{{$item->seller->email}}</p>
                                                <p>{{$item->seller->phone}}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($item->customer))
                                                <p>{{$item->customer->name}}</p>
                                                <p>{{$item->customer->email}}</p>
                                                <p>{{$item->customer->phone}}</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{$item->type}}
                                        </td>
                                        <td>
                                            {{number_format($item->money)}} Vnđ
                                        </td>
                                        <td>
                                            <div class="badge badge-success">Đơn mới</div>
                                        </td>
                                        <td>
                                            <span class="text-danger"><strong>{{isset($item->transport->name) ? $item->transport->name : ''}}</strong></span>
                                        </td>
                                        <td>
                                            {{date('H:i d/m/Y',strtotime($item->created_at))}}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('admin.bill.status',['id'=> $item['id'],'status'=>'waitting'])}}" class="btn btn-success btn-icon icon-left"><i class="fas fa-check"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @elseif(auth()->user()->role == 'staff')
                <div class="card">
                    <div class="card-header">
                        <h4>Đơn hàng chờ nhận</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Người tạo đơn</th>
                                    <th>Khách nhận</th>
                                    <th>Hình thức</th>
                                    <th>Phí Ship</th>
                                    <th>Trạng thái</th>
                                    {{--<th>Đơn vị vận chuyển</th>--}}
                                    <th>Thời gian tạo</th>
                                    <th class="text-center">Nhận đơn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($watting_bills) && count($watting_bills) > 0)
                                    @foreach($watting_bills as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                @if(isset($item->seller))
                                                    <p>{{$item->seller->name}}</p>
                                                    <p>{{$item->seller->email}}</p>
                                                    <p>{{$item->seller->phone}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($item->customer))
                                                    <p>{{$item->customer->name}}</p>
                                                    <p>{{$item->customer->email}}</p>
                                                    <p>{{$item->customer->phone}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->type}}
                                            </td>
                                            <td>
                                                {{number_format($item->cod_price)}} Vnđ
                                            </td>
                                            <td>
                                                <div class="badge badge-success">Đơn mới</div>
                                            </td>
                                            {{--<td>--}}
                                                {{--<span class="text-danger"><strong>{{isset($item->transport->name) ? $item->transport->name : ''}}</strong></span>--}}
                                            {{--</td>--}}
                                            <td>
                                                {{date('H:i d/m/Y',strtotime($item->created_at))}}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.bill.status',['id'=> $item['id'],'status'=>'running'])}}" class="btn btn-success btn-icon icon-left"><i class="fas fa-check"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
