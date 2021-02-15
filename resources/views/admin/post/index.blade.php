@extends('admin.layout')
@section('content_header')
    <x-contentheader title="文章管理">
        <a href="{{route('admin.post.create')}}" class="btn btn-info">添加文章</a>
    </x-contentheader>
@endsection

@section('content')
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <th>标题</th>
                       
                        <th>所属分类</th>
                        <th>是否vip</th>
                        <th>文章类型</th>
                        <th>创建时间</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($datas as $v)
                            <tr>
                                <td>{{$v->title}}</td>
                                <td>{{$v->category->name??''}}</td>
                                <td>{{$v->is_vip?'是' : '否'}}</td>
                                <td>{{$v->post_type}}</td>
                                <td>{{$v->created_at}}</td>
                                <td>
                                    <x-editicon :url="route('admin.post.edit', [$v])"/>
                                    <x-deleteicon :url="route('admin.post.destroy', [$v])" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection