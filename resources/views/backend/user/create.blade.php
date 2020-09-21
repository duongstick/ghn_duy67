@extends('layouts.admin')
@section('content')
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="padding-20">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                   aria-selected="true">Tạo Người Dùng Mới</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                <form method="post" class="needs-validation" action="{{route('admin.user.postCreate')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-7 col-lg-7">
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Tên</label>
                                                        <input type="text" class="form-control" name="name" required value="{{old('name')}}">
                                                        <div class="invalid-feedback">
                                                            Vui lòng điền đầy đủ tên
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Điện thoại</label>
                                                        <input type="number" class="form-control"  name="phone" maxlength="10" minlength="10" value="{{old('phone')}}">
                                                    </div>
                                                    <div class="form-group col-md-12 col-12">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control"  name="email" required value="{{old('email')}}">
                                                        <div class="invalid-feedback">
                                                            Vui lòng điền đầy đủ Email
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Ngày sinh</label>
                                                        <input type="date" class="form-control"  name="birthday" value="{{old('birthday')}}">
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Giới tính</label>
                                                        <select class="form-control" name="gender">
                                                            <option value="male" >Nam</option>
                                                            <option value="female" >Nữ</option>
                                                            <option value="other" selected >Khác</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="form-group col-md-6 col-12">
                                                            <label>Quyền</label>
                                                            <select class="form-control" name="role">
                                                                <option value="admin" >Admin</option>
                                                                <option value="staff" >Nhân viên</option>
                                                                <option value="customer" selected >Khách</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6 col-12">
                                                            <label>Trạng thái</label>
                                                            <select class="form-control" name="status">
                                                                <option value="disable" >Vô hiệu hóa</option>
                                                                <option value="enable" selected >Hoạt động</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <label>Ghi chú</label>
                                                        <textarea class="form-control summernote-simple" name="description">{{old('description')}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-5 col-lg-5">
                                                <div class="row">
                                                    <div class="form-group col-md-12 col-12">
                                                        <label>Avatar</label>
                                                        <input type="file" class="form-control" name="avatar" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Mật khẩu</label>
                                                        <input type="password" class="form-control" name="password" required>
                                                        <div class="invalid-feedback">
                                                            Vui lòng điền đầy đủ mật khẩu
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Xác thực mật khẩu</label>
                                                        <input type="password" class="form-control" name="password_confirmation" required >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary btn-lg"><i class="fa fa-save"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection