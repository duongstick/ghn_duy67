@extends('layouts.auth')
@section('title') Đăng Ký Tài Khoản @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('backend')}}/assets/bundles/jquery-selectric/selectric.css">
@endsection
@section('js')
    <script src="{{asset('backend')}}/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="{{asset('backend')}}/assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script>
        function changeRole() {
            var role = $('#role').val();
            var url_default = '{{route('register')}}';
            if (role){
                url = url_default+'?role='+role;
            }else {
                url = url_default;
            }
            window.location.href = url;
        }
    </script>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('register')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label  class="d-block">Quyền</label>
                                    <select class="form-control" name="role" id="role" onchange="changeRole()">
                                        <option value="customer" @if(request('role') == 'customer') selected @endif>Khách hàng</option>
                                        <option value="seller" @if(request('role') == 'seller') selected @endif>Người bán</option>
                                        <option value="staff" @if(request('role') == 'staff') selected @endif>Nhân viên</option>

                                    </select>
                                </div>
                                {{--<div class="form-group col-6">--}}
                                    {{--@if(request('role') == 'staff')--}}
                                        {{--<label  class="d-block">Đơn vị vận chuyển</label>--}}
                                        {{--<select class="form-control" name="transport_id" >--}}
                                            {{--<?php--}}
                                            {{--$transport = \App\Models\Transport::all();--}}
                                            {{--?>--}}
                                            {{--@foreach($transport as $item)--}}
                                                {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="frist_name">Name</label>
                                    <input id="frist_name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="last_name">Avatar</label>
                                    <input type="file" class="form-control" name="avatar">
                                    @error('avatar')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                <div class="invalid-feedback">
                                </div>
                                @error('email')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="phone" class="d-block">Điện thoại</label>
                                    <input id="phone" type="text" class="form-control"
                                           name="phone">
                                    @error('phone')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="address" class="d-block">Địa chỉ</label>
                                    <input id="address" type="text" class="form-control" name="address">
                                    @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="password" class="d-block">Mật khẩu</label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                                           name="password" required>
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                    @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password2" class="d-block">Xác nhận mật khẩu</label>
                                    <input id="password2" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<div class="custom-control custom-checkbox">--}}
                                    {{--<label class="custom-control-label" for="agree">I agree with the terms and conditions</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Đăng Ký
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mb-4 text-muted text-center">
                        Đã có tài khoản ? <a href="{{route('login')}}">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
