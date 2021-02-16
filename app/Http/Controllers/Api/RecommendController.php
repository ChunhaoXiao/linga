<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\Post as PostResource;

class RecommendController extends Controller
{
    public function index() {
        $datas = Post::has('files')->vip()->with('cover')->latest()->limit(8)->get();
        return PostResource::collection($datas);
    }
}
