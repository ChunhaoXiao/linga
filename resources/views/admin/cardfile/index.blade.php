@extends('adminlte::page')


@section('content')
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <th>文件名</th>
            <th>生成时间</th>
            <th>操作</th>
            <!-- <th>生成时间</th>
            <th>使用者</th>
            <th>使用时间</th> -->
            
        </thead>
        <tbody>
            @foreach($datas as $v)
                <tr>
                    <td><a href="{{route('admin.cardfile.show', $v)}}">{{ $v->filename }}</a></td>
                    <td>{{ $v->created_at }}</td>
                    <td><a class="fa fa-trash" data-url="{{route('admin.cardfile.destroy', $v)}}"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
@endsection

@section('js')
    <script>
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".fa-trash").on('click', function() {
                const url = $(this).data('url')
                Swal.fire(
                    {
                        title: '确定删除？',
                        text: "此操作不能恢复",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '确定',
                        cancelButtonText:'取消'
                    }
                ).then(res => {
                    console.log(res)
                    if(res.value) {
                        console.log(url)
                        $.ajax({
                            url:url,
                            type:"delete",
                            success:res => {
                                console.log(res)
                                location.reload();
                            }
                        })
                    }
                });
            })
        })
    </script>
@endsection