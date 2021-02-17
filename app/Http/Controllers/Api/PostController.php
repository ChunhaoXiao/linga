<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-09-23 18:26:41
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Post as PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category', 0);
        if ($category) {
            $category = Category::findOrFail($category);

            return PostResource::collection($category->posts()->vip()->with('cover')->latest()->paginate());
        }

        return PostResource::collection(Post::vip()->with('cover')->latest()->paginate());
    }

    public function show(Post $post)
    {
        $user = Auth::user();
        if ($user->cannot('view', $post)) {
            abort(404);
        }
        $user->updateViewHistory($post);

        return new PostResource($post);
    }

    public function store(PostRequest $request)
    {
        $user = Auth::user();
        $datas = $request->only(['title', 'body', 'category_id', 'is_vip']);
        $datas['is_vip'] = $user->manager()->exists() ? $datas['is_vip'] : 1;
        $post = Auth::user()->posts()->create($datas);
        $post->files()->createMany(array_map(function ($item) { return ['path' => $item]; }, $request->file));

        return response()->json(['success' => 1]);
    }

    public function destroy(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            $post->delete();

            return response()->json(['status' => 1]);
        }

        return response()->json(['status' => 0], 403);
    }
}
