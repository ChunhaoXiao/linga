<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardFile;

class CardFileController extends Controller
{
    public function index()
    {
        $datas = CardFile::latest()->paginate(30);

        return view('admin.cardfile.index', ['datas' => $datas]);
    }

    public function show(CardFile $cardfile)
    {
        $datas = Card::where('mark', $cardfile->filename)->get();
        $res = $datas->pluck('card_number')->toArray();
        $str = implode('<br>', $res);
        echo $str;
    }

    public function destroy(CardFile $cardfile)
    {
        Card::where('mark', $cardfile->filename)->delete();
        $cardfile->delete();

        return response()->json(['success' => 1]);
    }
}
