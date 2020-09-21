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
                           <h4>Thông Tin Phường Xã</h4>
                           <form class="row" method="post" action="{{route('admin.ward.update',$info->id)}}">
                               {{csrf_field()}}
                               <div class="col-md-12">
                                   <div class="form-group">
                                       <label>Tên  <span class="text-danger">*</span></label>
                                       <div class="input-group">
                                           <div class="input-group-prepend">
                                               <div class="input-group-text">
                                                   <i class="fas fa-city"></i>
                                               </div>
                                           </div>
                                           <input type="text" class="form-control" name="name" value="{{$info->name}}" required>
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
                                           <input type="text" class="form-control"  name="prefix" value="{{$info->prefix}}" required>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-12 text-left">
                                   <button class="btn btn-primary">Cập nhật</button>
                               </div>
                           </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
