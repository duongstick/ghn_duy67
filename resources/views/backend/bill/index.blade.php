@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{asset('backend')}}/assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('js')
    <!-- JS Libraies -->
    <script src="{{asset('backend')}}/assets/bundles/datatables/datatables.min.js"></script>
    <script src="{{asset('backend')}}/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('backend')}}/assets/js/page/datatables.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Danh Sách Đơn Hàng </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped data-table" id="table-2">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Người tạo đơn</th>
                                <th>NV nhận đơn</th>
                                <th>Khách nhận</th>
                                <th>Hình thức</th>
                                <th>Phí Ship</th>
                                <th>Trạng thái</th>
                                {{--<th>Đơn vị vận chuyển</th>--}}
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
                                                    <div class="badge badge-warning">Đơn mới</div>
                                                @elseif($item['status'] == 'waitting')
                                                    <div class="badge badge-primary">Chờ lấy hàng</div>
                                                @elseif($item['status'] == 'running')
                                                    <div class="badge badge-danger">Đang vận chuyển</div>
                                                @elseif($item['status'] == 'done')
                                                    <div class="badge badge-success">Khách đã nhận</div>
                                                @elseif($item['status'] == 'error')
                                                    <div class="badge badge-danger">Khách huy/Bùng hàng</div>
                                                @endif
                                            </td>
                                            {{--<td>--}}
                                                {{--<span class="text-danger"><strong>{{isset($item->staff->name) ? $item->staff->name : ''}}</strong></span>--}}
                                            {{--</td>--}}
                                            <td>
                                                <p>Người bán</p>
                                                <p>
                                                    @if($item['seller_rate'] > 0)
                                                        @for($i=1;$i<= $item['seller_rate'];$i++)
                                                            <i class="text-warning fas fa-star"></i>
                                                        @endfor
                                                     @endif
                                                </p>
                                                <p>Người nhận</p>
                                                @if($item['customer_rate'] > 0)
                                                    @for($i=1;$i<= $item['customer_rate'];$i++)
                                                        <i class="text-warning fas fa-star"></i>
                                                    @endfor
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.bill.view',$item->id)}}" class="btn btn-primary"><i class="fa fa-info"></i></a>
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
@endsection
