@extends('admin.layout')

@section('content_header')
    <x-contentheader title="敏感词管理">
        <a href="{{route('admin.words.create')}}" class="btn btn-info">添加敏感词</a>
    </x-contentheader>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <th>名字</th>
            <th>操作</th>
            <!-- <th></th>
            <th></th> -->
        </thead>
        <tbody>
            @foreach($datas as $v)
                <tr>
                    <td>{{$v->name}}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>{{$datas->links()}}</p>
@endsection