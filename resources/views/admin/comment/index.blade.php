@extends('admin.layout')

@section('content_header')
    <x-contentheader title="评论管理">
       
    </x-contentheader>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <th>内容</th>
            <th>所属文章</th>
            <th>操作</th>
            <!-- <th></th>
            <th></th> -->
        </thead>
        <tbody>
            @foreach($datas as $v)
                <tr>
                    <td>{{$v->body}}</td>
                    <td>{{$v->post->title}}</td>
                    <td><a class="far fa-trash-alt" data-url="{{route('admin.comments.destroy', $v)}}"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>{{$datas->links()}}</p>
@endsection