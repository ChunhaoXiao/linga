<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function create()
    {
        $data = Config::first();

        return view('admin.config.create', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $config = Config::first();
        if ($config) {
            $config->update($request->input());
        } else {
            Config::create($request->input());
        }

        return redirect()->route('admin.config.create')->with('success', 1);
    }
}
