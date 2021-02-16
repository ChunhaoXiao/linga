@extends('adminlte::page')


@section('content')
    <p>
        <a href="{{route('admin.card.create')}}" class="btn btn-info">添加卡密</a>
    </p>

    <table class="table table-bordered">
        <thead class="table-dark">
            <th>卡号</th>
            <th>类型</th>
            <th>生成时间</th>
            <th>使用者</th>
            <th>使用时间</th>
            
        </thead>
        <tbody>
            @foreach($datas as $v)
                <tr>
                    <td>{{ $v->card_number }}</td>
                    <td>{{ $v->type }}</td>
                    <td>{{ $v->created_at }}</td>
                    <td></td>
                    <td>{{$v->used_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
@endsection