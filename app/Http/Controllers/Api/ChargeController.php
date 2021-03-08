<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ChargeRequest;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChargeController extends Controller
{
    // public function create()
    // {
    //     return view('charge.create');
    // }

    public function store(ChargeRequest $request)
    {
        //$user = User::where('name', $request->name)->first();
        $user = Auth::user();
        $card = Card::filter(['card_number' => $request->card])->first();
        $vip = $user->vips()->where('ended_at', '>', now())->first();
        $months = $card->vip_month;
        if ($vip) {
            $vip->update(['ended_at' => $vip->ended_at->addMonths($months)]);
        } else {
            $user->vips()->create(['started_at' => now(), 'ended_at' => now()->addMonths($months)]);
        }
        $card->update(['used_at' => now(), 'user_id' => $user->id]);

        return redirect()->route('charge')->with('success', 1);
    }
}
