<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-12-19 21:35:21
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyHistory;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $datas = Auth::user()->histories()->with('post.cover')->latest('updated_at')->paginate();

        return MyHistory::collection($datas);
    }
}
