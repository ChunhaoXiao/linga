@extends('admin.layout')

@section('content')
    <form action="{{ route('admin.users.update', $data)}}" method="post">
        <div class="form-group">
            <label>会员到期时间</label>
            <input type="date" class="form-control" name="vip_date"> 
        </div>
        @csrf 
        @method('PUT')
        <div class="form-group">
            <button class="btn btn-primary">提交</button>
        </div>
    </form>
@endsection