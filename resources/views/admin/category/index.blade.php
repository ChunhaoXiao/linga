@extends('admin.layout')
@section('content_header')
    <x-contentheader title="分类管理">
        <a href="{{route('admin.category.create')}}" class="btn btn-info">添加分类</a>
    </x-contentheader>
@endsection

@section('content')
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <th>分类名称</th>
                       
                        <th>图标</th>
                        <th>是否显示</th>
                        <th>
                            文章数量
                        </th>

                        <th>排序</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($datas as $v)
                            <tr>
                                <td>{{$v->name}}</td>
                                <td>@if($v->icon) <img src="{{asset('storage/'.$v->icon)}}" alt="" width="50" height="50"> @endif</td>
                                <td>{{$v->enabled == 1? '显示':'不显示'}}</td>
                                <td></td>
                                <td>{{$v->sort}}</td>
                                <td>
                                    <x-editicon :url="route('admin.category.edit', [$v])"/>
                                    <x-deleteicon :url="route('admin.category.destroy', [$v])" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection