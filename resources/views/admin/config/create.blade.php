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
        @method('PUT')
        @csrf
        <div class="form-group">
            <button type="submit" class="btn btn-primary">确定</button>
        </div>
    </form>
@endsection