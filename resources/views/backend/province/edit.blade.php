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
                    <h3>{{$info->name}}</h3>
                </div>
                <div class="card-body">
                    <div class="mt-2 row">
                       <div class="col-md-6">
                           <h4>Thông Tin Thành Phố</h4>
                           <form class="row" method="post" action="{{route('admin.province.update',$info->id)}}">
                               {{csrf_field()}}
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label>Tên thành phố <span class="text-danger">*</span></label>
                                       <div class="input-group">
                                           <div class="input-group-prepend">
                                               <div class="input-group-text">
                                                   <i class="fas fa-city"></i>
                                               </div>
                                           </div>
                                           <input type="text" class="form-control" placeholder="Tên thành phố..." name="name" value="{{$info->name}}" required>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label>Code</label>
                                       <div class="input-group">
                                           <div class="input-group-prepend">
                                               <div class="input-group-text">
                                                   <i class="fas fa-envelope"></i>
                                               </div>
                                           </div>
                                           <input type="text" class="form-control" placeholder="Ký hiệu thành phố..." name="code" value="{{$info->code}}" required>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-12 text-left">
                                   <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Cập nhật Thành Phố</button>
                               </div>
                           </form>
                       </div>
                        <div class="col-md-6">
                            <h4>Tạo Quận Huyện</h4>
                            <form class="row" method="post" action="{{route('admin.district.create')}}">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên quận huyện  <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-city"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Tên quận huyện..." name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Prefix</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Quận, Huyện..." name="prefix">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="province_id" value="{{$info->id}}">
                                <div class="col-md-12 text-left">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tạo</button>
                                </div>
                            </form>
                        </div>
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
                                            <td >

                                                {{isset($item-> wards) ? count($item-> wards) : 0}}
                                            </td>
                                            <td>
                                                <a href="{{route('admin.district.edit',$item->id)}}" class="btn btn-primary"><i class="fa fa-pen-fancy"></i></a>
                                                <a href="{{route('admin.district.delete',$item->id)}}" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
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
