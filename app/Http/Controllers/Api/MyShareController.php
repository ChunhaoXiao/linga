<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyShareResource;
use Illuminate\Support\Facades\Auth;

class MyShareController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->manager()->exists()) {
            $datas = Post::with('cover')->latest()->paginate(20);
            return MyShareResource::collection($datas);
        }
        $datas = Auth::user()->posts()->with('cover')->latest()->paginate(20);
        return MyShareResource::collection($datas);
    }
}
