@extends('adminlte::page')

@section("content_header")
    <h3>系统设置</h3>
@endsection
@section('content')
    <form action="{{ route('admin.config.update') }}" method="post">
        
        <div class="form-group">
            <label for="">分享按钮文字</label>
            <input type="text" class="form-control" name="share_text" value="{{$data->share_text??''}}">
        </div>
        <div class="form-group">
            <label for="">卡密购买地址</label>
            <input type="text" class="form-control" name="buy_address" value="{{$data->buy_address??''}}">
        </div>

        <div class="form-group">
            <label for="">开启审核模式</label>
            <div>
                <span class="mr-2">是<input type="radio" name="review_mode" value="1" {{$data->review_mode == 1? 'checked':''}}></span>
                <span>否<input type="radio" name="review_mode" value="0" {{$data->review_mode == 0? 'checked':''}}></span>
            </div>
        </div>

        @method('PUT')
        @csrf
        <div class="form-group">
            <button type="submit" class="btn btn-primary">确定</button>
        </div>
    </form>
@endsection