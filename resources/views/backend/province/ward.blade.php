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
                    <h3>Danh Sách Quận Huyện</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <nav aria-label="breadcrumb" class="col-md-4">
                            <ol class="breadcrumb bg-white text-danger-all">
                                <li class="breadcrumb-item"><a href="{{route('admin.province.ward')}}"><i >( {{count($data)}}</i> ) Quận Huyện</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped data-table" id="table-2">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Prefix</th>
                                <th>Thành phố</th>
                                <th>Quận-Huyện</th>
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
                                            {{$item->prefix}}
                                        </td>
                                        <td>
                                            {{isset($item->province) ? $item->province->name : ''}}
                                        </td>
                                        <td>
                                            {{isset($item->district) ? $item->district->name : ''}}
                                        </td>
                                        <td>
                                            <a href="{{route('admin.ward.edit',$item->id)}}" class="btn btn-primary"><i class="fa fa-pen-fancy"></i></a>
                                            <a href="{{route('admin.ward.delete',$item->id)}}" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
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
