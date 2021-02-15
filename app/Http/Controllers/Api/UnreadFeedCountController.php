<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnreadFeedCountController extends Controller
{
    public function index()
    {
        $count = Auth::user()->related_me()->unread()->count();

        return response()->json(['count' => $count]);
    }
}
