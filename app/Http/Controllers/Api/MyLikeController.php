<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-12-27 14:37:15
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyLike;
use Illuminate\Support\Facades\Auth;

class MyLikeController extends Controller
{
    public function index()
    {
        $datas = Auth::user()->likes()->post()->with('likeable.cover')->latest()->paginate();

        return MyLike::collection($datas);
    }
}
