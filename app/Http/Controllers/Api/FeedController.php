<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Feed;
use Auth;

class FeedController extends Controller
{
    public function index()
    {
        $data = Auth::user()->related_me()->with('feedable', 'user', 'post', 'comment')->orderBy('viewed')->orderBy('created_at', 'desc')->paginate(20);
        Auth::user()->related_me()->whereNull('viewed')->update(['viewed' => 1]);

        return Feed::collection($data);
    }
}
