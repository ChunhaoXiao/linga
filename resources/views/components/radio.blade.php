<div class="form-group">
    <label>{{$label??''}}</label>
    <div>
        @if(!empty($options))
            @foreach($options as $k => $v)
                <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="{{ $name.$k }}" name="{{ $name??'' }}" class="custom-control-input" value="{{$k}}" {{isset($checked) && $checked == $k ? 'checked' : ''}}>
                <label class="custom-control-label" for="{{ $name.$k }}">{{$v}}</label>
                </div>
            @endforeach
        @endif
    </div>
</div>