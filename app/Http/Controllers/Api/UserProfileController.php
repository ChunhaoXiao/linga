<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\User;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return new User($user);
    }

    public function update(UserUpdateRequest $request)
    {
        Auth::user()->update($request->input());

        return response()->json(['status' => 0]);
    }
}
