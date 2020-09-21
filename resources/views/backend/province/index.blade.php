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
                    <h3>Danh Sách Thành Phố</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <nav aria-label="breadcrumb" class="col-md-4">
                            <ol class="breadcrumb bg-white text-danger-all">
                                <li class="breadcrumb-item"><a href="{{route('admin.province.index')}}"><i >( {{count($data)}}</i> ) Thành Phố</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.province.district')}}"><i >( {{number_format($districts)}}</i> ) Quận - Huyện</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><i >( {{number_format($wards)}}</i> )  Phường - Xã</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="mt-2">
                        <form class="row" method="post" action="{{route('admin.province.create')}}">
                            {{csrf_field()}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tên thành phố <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-city"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Tên thành phố..." name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Code</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ký hiệu thành phố..." name="code" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-left">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tạo Thành Phố</button>
                            </div>
                        </form>

                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped data-table" id="table-2">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Code</th>
                                <th>Quận-Huyện</th>
                                <th>Phường-Xã</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && count($data) > 0)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                <h5>{{$item->name}}</h5>
                                            </td>
                                            <td >
                                                {{$item->code}}
                                            </td>
                                            <td>
                                              {{isset($item->districts) ? count($item->districts) : 0}}
                                            </td>
                                            <td >

                                                {{isset($item-> wards) ? count($item-> wards) : 0}}
                                            </td>
                                            <td>
                                                <a href="{{route('admin.province.edit',$item->id)}}" class="btn btn-primary"><i class="fa fa-pen-fancy"></i></a>
                                                <a href="{{route('admin.province.delete',$item->id)}}" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
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
