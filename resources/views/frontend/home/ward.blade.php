<select class="form-control" name="ward" id="ward">

    @if(isset($data) && count($data) > 0)
        @foreach($data as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    @else
        <option value="">Chọn phường/xã</option>
    @endif
</select>
