@extends('admin.layout')

@section('content')
<p>
<form class="form-inline" action="{{route('admin.users.index')}}">
  <div class="form-group mb-2 mx-2">
    <label for="" class="mr-1">用户名</label>
    <input type="text" class="form-control" name="name" value="{{request()->name??''}}">
  </div>
  <div class="form-group mb-2 mx-2">
    <button class="btn btn-info">搜索</button>
  </div>
</form>  
</p>
    <table class="table table-bordered">
        <thead>
            <th>用户名</th>
            <th>创建时间</th>
            <th>是否是vip</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($datas as $v)
                <tr>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->created_at }}</td>
                    <td>{{ !empty($v->vip->id)?'是':'否' }}</td>
                    <td><a href="{{route('admin.users.edit', $v)}}">编辑</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
@endsection