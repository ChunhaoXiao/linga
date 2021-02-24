<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;

class SensitiveWordController extends Controller
{
    public function index()
    {
        $datas = Word::paginate(30);

        return view('admin.word.index', ['datas' => $datas]);
    }

    public function create()
    {
        return view('admin.word.create');
    }

    public function store(Request $request)
    {
        $words = $request->words;
        $words = str_replace([' ', ',', '，', PHP_EOL], ',', $words);
        $words = array_filter(explode(',', $words));
        foreach ($words as $v) {
            $v = trim($v);
            if (Word::where('name', $v)->doesntExist()) {
                Word::create(['name' => $v]);
            }
        }

        // return redirect()->route('admin.words.index');
    }
}
