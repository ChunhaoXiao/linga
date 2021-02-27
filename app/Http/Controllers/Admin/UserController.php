<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $datas = User::with('vip')->name($request->name ?? '')->latest()->paginate();

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
        $user = User::findOrFail($id);
        if ($user->is_vip()) {
            $user->vip->update(['ended_at' => $date]);
        } else {
            if (now()->diffInDays(Carbon::parse($date), false) > 0) {
                $user->vips()->create(['started_at' => now(), 'ended_at' => $date]);
            }
        }

        return redirect()->route('admin.users.index');
    }
}
