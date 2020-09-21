@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{asset('backend')}}/assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet"
          href="{{asset('backend')}}/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('js')
    <!-- JS Libraies -->
    <script src="{{asset('backend')}}/assets/bundles/datatables/datatables.min.js"></script>
    <script
        src="{{asset('backend')}}/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('backend')}}/assets/js/page/datatables.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <section class="section">
                <div class="section-body">
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="invoice-title">
                                        <h2>Chi Tiết Đơn Hàng </h2>
                                        <div class="invoice-number">
                                            <span>Order #{{$info['id']}}</span>
                                            <p class="text-danger"> ( <small><strong>{{isset($info->staff->name) ? $info->staff->name : ''}}</strong></small> )</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Người gửi:</strong><br>
                                                @if(isset($info->seller))
                                                    <p>{{$info->seller->name}}</p>
                                                    <p>{{$info->seller->email}}</p>
                                                    <p>{{$info->seller->phone}}</p>
                                                @endif
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Người nhận:</strong><br>
                                                @if(isset($info->customer))
                                                    <p>{{$info->customer->name}}</p>
                                                    <p>{{$info->customer->email}}</p>
                                                    <p>{{$info->customer->phone}}</p>
                                                @endif

                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Gửi từ:</strong><br>
                                                {{$info['from']}}
                                            </address>
                                            <address>
                                                <strong>Đánh giá:</strong><br>
                                                @if($info['seller_rate'] > 0)
                                                    @for($i=1;$i<= $info['seller_rate'];$i++)
                                                        <i class="text-warning fas fa-star"></i>
                                                    @endfor
                                                @endif
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Gửi đến:</strong><br>
                                                {{$info['to']}}<br><br>
                                            </address>
                                            <address>
                                                <strong>Đánh giá:</strong><br>
                                                @if($info['customer_rate'] > 0)
                                                    @for($i=1;$i<= $info['customer_rate'];$i++)
                                                        <i class="text-warning fas fa-star"></i>
                                                    @endfor
                                                @endif
                                            </address>
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
                                                <td class="text-right">{{number_format($info['cod_price'])}} Vnđ</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Giá trị đơn hàng</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-right">{{number_format($info['money'])}} Vnđ</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-8">
                                            <div class="section-title">Hình thức thanh toán</div>
                                            <div class="images">
                                                <img src="{{asset('backend')}}/assets/img/cards/visa.png" alt="visa">
                                                <img src="{{asset('backend')}}/assets/img/cards/jcb.png" alt="jcb">
                                                <img src="{{asset('backend')}}/assets/img/cards/mastercard.png" alt="mastercard">
                                            </div>
                                            <div class="float-lg-left">
                                                @if($info['status'] == 'new' && auth()->user()->role == 'admin')
                                                    <form method="post" action="{{route('admin.bill.update',$info['id'])}}">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="status" value="waitting">
                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <div class="section-title">Chọn nhân viên vận chuyển</div>
                                                                <select class="form-control" name="staff_id">
                                                                    @foreach($staffs as $item)
                                                                        <option value="{{$item->id}}" @if($item->id == $info['staff_id']) selected @endif>{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i>Điều phối giao hàng</button>
                                                    </form>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-right">
                                            <hr class="mt-2 mb-2">
                                            <div class="invoice-detail-item">
                                                <div class="invoice-detail-name">Tổng tiền</div>
                                                <div class="invoice-detail-value invoice-detail-value-lg">{{number_format($info['money'] + $info['cod_price'])}} Vnđ</div>
                                            </div>
                                            <div class="text-md-right" style="margin-top:200px">

                                                @if(auth()->user()->role == 'staff')
                                                    @if($info['status'] == 'running')
                                                    <a href="{{route('admin.bill.status',['id'=> $info['id'],'status'=> 'done'])}}" class="btn btn-success btn-icon icon-left m-b-5"><i class="fas fa-check"></i> Xác nhận gửi</a>
                                                    <a href="{{route('admin.bill.status',['id'=> $info['id'],'status'=> 'error'])}}" class="btn btn-danger btn-icon icon-left m-b-5"><i class="fas fa-times"></i> Khách hủy/bùng hàng</a>
                                                    @elseif($info['status'] == 'waitting')
                                                        <a href="{{route('admin.bill.status',['id'=> $info['id'],'status'=> 'running'])}}" class="btn btn-danger btn-icon icon-left"><i class="fas fa-check"></i> Nhận đơn</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-3">
           @include('backend.bill.left_bill')
        </div>
    </div>

@endsection
