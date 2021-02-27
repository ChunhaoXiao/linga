@extends('admin.layout')

@section('content')
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