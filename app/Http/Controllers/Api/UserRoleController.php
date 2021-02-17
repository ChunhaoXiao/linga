<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    public function index()
    {
        $role = Auth::user()->manager()->exists();

        return response()->json(['role' => $role]);
    }
}
