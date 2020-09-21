<section class="section">
    <div class="section-body">
        <h2 class="section-title">Trạng Thái Đơn Hàng</h2>
        <div class="row">
            <div class="col-12">
                <div class="activities">
                    @if($info['status'] == 'new')
                        @include('backend.bill.status.new')
                    @elseif($info['status'] == 'waitting')
                        @include('backend.bill.status.new')
                        @include('backend.bill.status.waitting')
                    @elseif($info['status'] == 'running')
                        @include('backend.bill.status.new')
                        @include('backend.bill.status.waitting')
                        @include('backend.bill.status.running')
                    @elseif($info['status'] == 'done')
                        @include('backend.bill.status.new')
                        @include('backend.bill.status.waitting')
                        @include('backend.bill.status.running')
                        @include('backend.bill.status.done')
                    @elseif($info['status'] == 'error')
                        @include('backend.bill.status.new')
                        @include('backend.bill.status.waitting')
                        @include('backend.bill.status.running')
                        @include('backend.bill.status.error')
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <section class="section">
                    <div class="section-body">
                        <div class="invoice">
                            <div class="invoice-print">
                                <address>
                                   <h2 class="section-title">
                                       <strong>Nhân viên nhân đơn:</strong>
                                   </h2>
                                    @if(isset($info->staff))
                                        <p><i class="fas fa-user mr-2"></i>{{$info->staff->name}}</p>
                                        <p><i class="far fa-envelope mr-2"></i>{{$info->staff->email}}</p>
                                        <p><i class="fas fa-phone mr-2"></i>{{$info->staff->phone}}</p>
                                    @endif
                                </address>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</section>
