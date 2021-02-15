<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikePostController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $user = Auth::user();
        if ($post->likes()->where('user_id', $user->id)->doesntExist()) {
            $data = $user->likes()->save($post->likes()->make());
            $user->createLikeFeed($post);

            return response()->json(['status' => 1]);
        }
        $post->likes()->where('user_id', $user->id)->delete();
        $user->deleteLikeFeed($post);

        return response()->json(['status' => -1]);
    }
}
