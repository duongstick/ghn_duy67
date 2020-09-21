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
                    <h4>{{isset($title) ? $title : 'Danh Sách Khách Hàng'}} </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped data-table" id="table-2">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Giới tính</th>
                                @if(Auth::user()->role != 'customer')
                                    <th>Quyền</th>
                                @endif
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && count($data) > 0)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                <img alt="image" src="{{asset('images')}}/{{$item->avatar}}" width="40">
                                            </td>
                                            <td>
                                                <h5>{{$item->name}}</h5>
                                            </td>
                                            <td >
                                                {{$item->email}}
                                            </td>
                                            <td >
                                                {{$item->phone}}
                                            </td>
                                            <td>
                                                @if($item['gender'] == 'male')
                                                    Nam
                                                @elseif($item['gender'] == 'female')
                                                    Nữ
                                                @else
                                                    Khác
                                                @endif
                                            </td>
                                            @if(Auth::user()->role != 'customer')
                                                <td>
                                                    @if($item['role'] == 'admin')
                                                        <div class="badge badge-danger badge-shadow">Admin</div>
                                                        @elseif($item['role'] == 'staff')
                                                            <div class="badge badge-success badge-shadow">Nhân viên</div>
                                                    @else
                                                        <div class="badge badge-primary badge-shadow">Khách</div>
                                                    @endif

                                                </td>
                                            @endif
                                            <td>
                                                @if($item['status'] == 'enable')
                                                    <div class="badge badge-success badge-shadow">Hoạt động</div>
                                                @else
                                                    <div class="badge badge-danger badge-shadow">Vô hiệu hóa</div>
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{route('admin.user.profile',$item->id)}}" class="btn btn-primary"><i class="fa fa-info"></i></a>
                                                @if(Auth::user()->role == 'admin')
                                                    <a href="{{route('admin.user.delete',$item->id)}}}" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
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
        </div>
    </div>
@endsection
