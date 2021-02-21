<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Models\CardFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $card = Card::filter($request->query() ?? [])->paginate(20);

        return view('admin.card.index', ['datas' => $card]);
    }

    public function create()
    {
        return view('admin.card.create');
    }

    public function store(CardRequest $request)
    {
        $type = $request->type;
        $mark = (string) Str::uuid();
        for ($i = 0; $i < $request->quantity; ++$i) {
            $number = random_int(100000, 999999).random_int(100000, 999999).random_int(100, 999).random_int(100, 999);
            Card::create([
                'card_number' => $number,
                'type' => $type,
                'mark' => $mark,
            ]);
        }
        CardFile::create(['filename' => $mark]);

        return redirect()->route('admin.card.index');
    }
}
