<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyShareResource;
use Illuminate\Support\Facades\Auth;

class MyShareController extends Controller
{
    public function index()
    {
        $datas = Auth::user()->posts()->latest()->paginate(20);

        return MyShareResource::collection($datas);
    }
}
