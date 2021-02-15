<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2020-12-27 20:45:29
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CollectController extends Controller
{
    public function store(Post $post) {
        $res = Auth::user()->collection_posts()->toggle($post);
        return response()->json(['status' => $res]);
    }
}
