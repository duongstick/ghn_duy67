<div style="margin-top: 10px">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block">
            
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            
        <!-- <strong>{{ $message }}</strong> -->
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>