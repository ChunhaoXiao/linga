<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-09-28 22:59:12
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\Comment as CommentResource;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $datas = $post->comments()->with('user', 'comment.user')->withCount('likes', 'mylike')->paginate();

        return CommentResource::collection($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Post $post)
    {
        $comment = $post->comments()->make($request->input());
        $newComment = Auth::user()->comments()->create($comment->toArray());

        if ($request->comment_id || $post->user_id) {
            Auth::user()->feeds()->create([
                'action' => 'comment',
                'to_user' => $request->comment_id ? PostComment::find($request->comment_id)->user_id : $post->user_id,
                'related_post_id' => $post->id,
                'related_comment_id' => $newComment->id,
                'feedable_type' => $request->comment_id ? "App\Models\PostComment" : "App\Models\Post",
                'feedable_id' => $request->comment_id ?? $post->id,
            ]);
            // $comment = PostComment::find($request->comment_id);
            // $comment->feeds()->create([
            //     'related_comment_id' => $newComment->id ?? '',
            //     'action' => 'comment',
            //     'from_user' => Auth::id(),
            //     'to_user' => $comment->user_id,
            //     'related_post_id' => $post->id,
            // ]);
        }

        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
