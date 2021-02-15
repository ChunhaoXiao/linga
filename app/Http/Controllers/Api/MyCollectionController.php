<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-02 22:29:19
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MyCollection;
use App\Http\Resources\Post;

class MyCollectionController extends Controller
{
    public function index() {
        $datas = Auth::user()->collection_posts()->paginate();
        //return Post::collection($datas);
        return MyCollection::collection($datas);
    }
}
