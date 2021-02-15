
<div class="form-group">
    <label for="">{{ $label??'' }}</label>

    <textarea {{ $attributes }} class="form-control">{{$value??''}}</textarea>
           
    <div class="d-sm-flex align-items-sm-center"><span>{{ $slot }}</span></div>
        
</div>