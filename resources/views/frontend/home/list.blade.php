@extends('layouts.ghn')
@section('content')
    <div class="site-section bg-white" id="contact-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-7 text-center mb-5">
                <h2>Danh Sách Đơn Hàng</h2>
            </div>
            <div class="col-md-12">
                <div class="text-left">
                    <button class="btn btn-warning" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1">Tất Cả ({{count($me) + count($data)}})</button>

                    <button class="btn btn-primary" data-toggle="collapse"  data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1">Đơn Gửi ({{count($me)}})</button>
                    <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Đơn Nhận ({{count($data)}})</button>
                </div>

                <div class="row ">
                    <div class="col-md-12 mt-5">
                        <div class="collapse multi-collapse show" id="multiCollapseExample1">
                            <div class="card card-body table-responsive">
                                <table class="table data-table tab-bordered" >
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NV nhận đơn</th>
                                        <th>Khách nhận</th>
                                        <th>Hình thức</th>
                                        <th>Phí Ship</th>
                                        <th>Trạng thái</th>
                                        <th>Đánh giá </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($me) && count($me) > 0)
                                        @foreach($me as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>
                                                    @if(isset($item->staff))
                                                        <p>{{$item->staff->name}}</p>
                                                        <p>{{$item->staff->email}}</p>
                                                        <p>{{$item->staff->phone}}</p>
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
                                                    @if($item['status'] == 'new')
                                                        <div class="badge badge-warning text-white">Đơn mới</div>
                                                    @elseif($item['status'] == 'waitting')
                                                        <div class="badge badge-primary text-white">Chờ lấy hàng</div>
                                                    @elseif($item['status'] == 'running')
                                                        <div class="badge badge-danger text-white">Đang vận chuyển</div>
                                                    @elseif($item['status'] == 'done')
                                                        <div class="badge badge-success text-white">Khách đã nhận</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item['status'] == 'done')
                                                        <p>Người bán</p>
                                                        @if($item['seller_rate'] > 0)
                                                            <p>
                                                                @for($i=1;$i<= $item['seller_rate'];$i++)
                                                                    <i class="text-warning fa fa-star"></i>
                                                                @endfor
                                                            </p>
                                                        @endif
                                                        @if(isset($item->staff))
                                                            <select class="form-control slt-seller-rate mt-2" name="seller_rate" data-id="{{$item['id']}}">
                                                                <option value="">Đánh giá Shipper</option>
                                                                @for($i=1;$i<= 5;$i++)
                                                                    <option value="{{$i}}">{{$i}} Sao</option>
                                                                @endfor
                                                            </select>
                                                        @endif
                                                        <p class="mt-2">Người nhận</p>
                                                        @if($item['customer_rate'] > 0)
                                                            @for($i=1;$i<= $item['customer_rate'];$i++)
                                                                <i class="text-warning fa fa-star"></i>
                                                            @endfor
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('search','bill_id='.$item->id)}}" class="btn btn-primary"><i class="fa fa-info"></i></a>
                                                @if($item['status'] == 'new')
                                                        <p class="mt-2">
                                                            <a href="{{route('bill.delete',$item->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                        </p>

                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                            <div class="card card-body table-responsive">
                                <table class="table table-striped data-table" >
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Người tạo đơn</th>
                                        <th>NV nhận đơn</th>
                                        <th>Hình thức</th>
                                        <th>Phí Ship</th>
                                        <th>Trạng thái</th>
                                        <th>Đánh giá </th>
                                        <th class="text-center">Action</th>
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
                                                    @if(isset($item->staff))
                                                        <p>{{$item->staff->name}}</p>
                                                        <p>{{$item->staff->email}}</p>
                                                        <p>{{$item->staff->phone}}</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$item->type}}
                                                </td>
                                                <td>
                                                    {{number_format($item->cod_price)}} Vnđ
                                                </td>
                                                <td>
                                                    @if($item['status'] == 'new')
                                                        <div class="badge badge-warning text-white">Đơn mới</div>
                                                    @elseif($item['status'] == 'waitting')
                                                        <div class="badge badge-primary text-white">Chờ lấy hàng</div>
                                                    @elseif($item['status'] == 'running')
                                                        <div class="badge badge-danger text-white">Đang vận chuyển</div>
                                                    @elseif($item['status'] == 'done')
                                                        <div class="badge badge-success text-white">Khách đã nhận</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item['status'] == 'done')
                                                        <p>Người bán</p>
                                                        <p>
                                                            @if($item['seller_rate'] > 0)
                                                                @for($i=1;$i<= $item['seller_rate'];$i++)
                                                                    <i class="text-warning fa fa-star"></i>
                                                                @endfor
                                                            @endif
                                                        </p>

                                                        <p>Người nhận</p>
                                                        @if($item['customer_rate'] > 0)
                                                            @for($i=1;$i<= $item['customer_rate'];$i++)
                                                                <i class="text-warning fa fa-star"></i>
                                                            @endfor
                                                        @endif
                                                        @if(isset($item->staff))
                                                            <select class="form-control slt-customer-rate mt-2" name="customer_rate" data-id="{{$item['id']}}">
                                                                <option value="">Đánh giá Shipper</option>
                                                                @for($i=1;$i<= 5;$i++)
                                                                    <option value="{{$i}}">{{$i}} Sao</option>
                                                                @endfor
                                                            </select>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('search','bill_id='.$item->id)}}" class="btn btn-primary"><i class="fa fa-info"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
@section('js')
    <script>
        $('.slt-seller-rate').on('change',function () {
            var id = parseInt($(this).attr('data-id'));
            var star = parseInt($(this).val());
            if(star <= 0){
                return false;
            }
            var url = 'seller-rate/'+id+'/'+star;
            console.log(url);
            window.location.href = url;

        });
        $('.slt-customer-rate').on('change',function () {
            var id = parseInt($(this).attr('data-id'));
            var star = parseInt($(this).val());
            if(star <= 0){
                return false;
            }
            var url = 'customer-rate/'+id+'/'+star;
            console.log(url);
            window.location.href = url;

        })

    </script>
@endsection
