@extends('layouts.ghn')
@section('css')
    <link href="{{asset('select2/select2.min.css')}}">
@endsection
@section('js')
    <script>
        function updateList(id_list,data) {
            var select = document.getElementById(id_list);
            select.options[select.options.length] = new Option(data.name, data.id,false,true);

        }
        function getDistrict() {
           let province_id = $('#province').val();
           if(province_id == null){
               return false;
           }
            $.ajax({
                url     : '{{route('getDistrict')}}',
                method  : 'get',
                data    : {
                    province_id  : province_id,
                },
                success : function(response){
                    $('#slb-district').html(response);
                    clearWard();
                },
                errors : function () {
                    alert('Lỗi, Vui lòng chọn lại !');
                }
            });
        }
        function getWard() {
            let district_id = $('#district').val();
            if (district_id == null) {
                return false;
            }
            $.ajax({
                url: '{{route('getWard')}}',
                method: 'get',
                data: {
                    district_id: district_id,
                },
                success: function (response) {
                    $('#slb-ward').html(response);
                },
                errors: function () {
                    alert('Lỗi, Vui lòng chọn lại !');
                }
            });
        }
        function clearWard() {
            $('#ward')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Chọn phường/xã</option>')
                .val('')
            ;
        }
    </script>
@endsection
@section('content')
    <div class="site-section bg-light" id="contact-section">
        <div class="container-fluid">
            <div class="row justify-content-center text-center">
                <div class="col-7 text-center mb-5">
                    <h2>Tạo Vận Đơn</h2>
                </div>
            </div>
            <form method="post" class="row">
                {{csrf_field()}}
                <div class="col-lg-3 ml-auto">
                    <div class="bg-white p-3 p-md-5">
                        <h3 class="text-black mb-3">Thông tin người gửi</h3>
                        <ul class="list-unstyled footer-link">
                            <li class="d-block mb-3"><span class="d-block text-black">Tên:</span><span><a href="#" class="__cf_email__" data-cfemail="4f262129200f36203a3d2b20222e2621612c2022">{{auth()->user()->name}}</a></span></li>
                            <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span><a href="#" class="__cf_email__" data-cfemail="4f262129200f36203a3d2b20222e2621612c2022">{{auth()->user()->email}}</a></span></li>
                            <li class="d-block mb-3"><span class="d-block text-black">Điện thoại:</span><span>{{auth()->user()->phone}}</span></li>
                            <li class="d-block mb-3">
                                <span class="d-block text-black">Địa chỉ:</span>
                                <span>{{auth()->user()->address}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 mb-5">
                    <h3 class="text-black mb-3">Thông tin người nhận</h3>
                       <div class="row">
                           <div class="col-md-8">
                               <div class="form-group row">
                                   <div class="col-md-12 mb-4 mb-lg-0">
                                       <input type="text" class="form-control" placeholder="Tên người nhận" name="name" required>
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <div class="col-md-6">
                                       <input type="text" class="form-control" placeholder="Email" name="email" required>
                                   </div>
                                   <div class="col-md-6">
                                       <input type="text" class="form-control" placeholder="Điện thoại" name="phone" required>
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <div class="col-md-6">
                                       <input type="number" class="form-control" placeholder="Giá đơn" min="0" name="money">
                                   </div>
                                   <div class="col-md-6">
                                       <input type="number" class="form-control" placeholder="Phí ship" min="0" name="cod_price">
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <div class="col-md-4">
                                       <select class=" form-control mb-3" name="province" id="province" onchange="getDistrict()">
                                           @if(count($provinces) > 0)
                                               @foreach($provinces as $item)
                                                   <option value="{{$item->id}}">{{$item->name}}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <div class="col-md-4" id="slb-district">
                                       @include('frontend.home.district',['data'=> $district])
                                   </div>
                                   <div class="col-md-4" id="slb-ward">
                                       @include('frontend.home.ward')

                                   </div>

                               </div>
                               <div class="form-group row">
                                   <div class="col-md-6 mr-auto">
                                       <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Tạo">
                                   </div>
                               </div>
                           </div>
                           <div class="col-lg-4 mb-5">
                               <div class="form-group row">
                                   <div class="col-md-12 mt-2">
                                       <textarea name="address" class="form-control" placeholder="Địa chỉ" cols="30" rows="5"></textarea>
                                   </div>
                               </div>
                               <div class="form-group row">
                                   <div class="col-md-12">
                                       <textarea name="notes" class="form-control" placeholder="Ghi chú" cols="30" rows="5"></textarea>
                                   </div>
                               </div>
                           </div>
                       </div>
                </div>
            </form>
        </div>
    </div>
@endsection
