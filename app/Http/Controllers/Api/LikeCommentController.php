<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-12-27 22:02:31
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class LikeCommentController extends Controller
{
    public function store(Request $request, PostComment $comment) {
        $user = Auth::user();
        if($comment->likes()->where('user_id', $user->id)->doesntExist()) {
            $user->likes()->save($comment->likes()->make());
            $user->createLikeFeed($comment);
            return response()->json(['status' => 1]);
        }
        $comment->likes()->where('user_id', $user->id)->delete();
        $user->deleteLikeFeed($comment);
        return response()->json(['status' => -1]);
    }
}
