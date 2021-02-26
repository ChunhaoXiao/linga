<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::with('vip')->latest()->paginate();

        return view('admin.user.index', ['datas' => $datas]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', ['data' => $user]);
    }

    public function update(Request $request, $id)
    {
        $date = $request->vip_date;
    }
}
