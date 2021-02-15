<div class="form-group">
    <label>{{$label??''}}</label>
    
        <select name="{{$name}}" class="form-control">
          <option value="">{{$emptytext??'请选择'}}</option>
          @foreach($options as $k => $v)
            <option value="{{$k}}" {{isset($selected) && $selected == $k ?'selected':''}}>{{$v}}</option>
          @endforeach
        </select>
    
</div>