@extends('adminlte::page')

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <style>
        nav svg {
            width: 20px;
            height: 20px;
        }
    </style>
@stop
@section('js')

<script>
  
        //公用js
       $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $("a.fa-trash-alt").on('click', e => {
            
            const url = $(e.currentTarget).data('url')
            del(url);
        })

        async function del(url) {
            let p = await Swal.fire({
            title: '确认删除',
            text: '确定要删除吗？',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '确定',
            cancelButtonText:'取消',
            });
            if(p.value) {
                //let res = await fetch(); 可以使用fetch
                $.ajax({
                    url:url,
                    type:'delete',
                    success:res => {
                        Swal.fire(
                        '删除成功!',
                        )
                        setTimeout(function(){location.reload()}, 1000)
                    },
                    error:res => {
                        Swal.fire(
                            res.responseJSON.message
                        )
                    }
                })
            }
        }

       })
    </script>
@endsection