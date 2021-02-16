@extends('adminlte::page')

@section("content_header")
    <h3>生成卡密</h3>
@endsection
@section('content')
    <form action="{{ route('admin.card.store') }}" method="post">
        <div class="form-group">
            <label for=""></label>
            <select name="type" id="" class="form-control">
                @foreach([1 => '月度卡',2 => '季度卡',3 => '年度卡'] as $k => $v )
                    <option value="{{$k}}">{{$v}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">数量</label>
            <input type="text" class="form-control" name="quantity">
        </div>
        @csrf
        <div class="form-group">
            <button type="submit" class="btn btn-primary">确定</button>
        </div>
    </form>
@endsection