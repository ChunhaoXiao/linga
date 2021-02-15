<?php
/*
 * @Author: your name
 * @Date: 2020-12-25 22:24:13
 * @LastEditTime: 2021-01-09 21:25:49
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \linga\app\Http\Controllers\Api\MyCommentController.php
 */


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\History;
use App\Http\Resources\MyComment;
use App\Models\PostComment;

class MyCommentController extends Controller
{
    /**
     * @description: 
     * @param {*}
     * @return {*}
     */
    public function index() {
        $posts = Post::whereHas('comments', function($query){$query->where('user_id', Auth::id());})->orderByDesc(
            PostComment::select('created_at')
                ->whereColumn('post_id', 'posts.id')
                ->orderByDesc('created_at')
                ->limit(1)
        )->with('my_last_comment')->paginate();
    
        return MyComment::collection($posts);
    }
}
