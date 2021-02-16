<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>升级 VIP 用户</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
            margin: 0 auto;

        }
    </style>
</head>
<body>
    <div class="container h-100">
        <div class="row align-items-center  border h-100">
            <div class="col">
                <h2 class="py-2">小程序用户充值升级</h2>
                @if(session('success') == 1)
                    <div class="alert alert-success">已经成功升级为 VIP 会员，  <a href="{{route('charge')}}">返回</a></div>
                @else
                <form action="{{ route('charge.store') }}" method="post">
                    <div class="form-group">
                        <label for="">用户名(小程序注册的用户名)</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                        <label for="">卡密</label>
                        <input type="text" class="form-control" name="card_number">
                    </div>
                    @csrf
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">提交</button>
                    </div>
                   
                </form>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</body>
</html>