<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\Post as PostResource;
class IndexSwiperController extends Controller
{
    public function index() {
        //使用子查询
        $post = Post::has('files')->vip()->with('cover')->latest()->limit(5)->get();
        return PostResource::collection($post);
    }
}
