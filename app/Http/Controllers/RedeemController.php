<?php

namespace App\Http\Controllers;

use App\Models\Redeem;
use App\Models\RedeemReward;
use Illuminate\Support\Facades\Auth;

class RedeemController extends Controller
{
    public function index()
    {
        return view('redeem.user.index', [
            'rewards' => RedeemReward::all()
        ]);
    }

    public function store($id)
    {
        $user = Auth::user();
        $reward = RedeemReward::findOrFail($id);

        if ($user->points < $reward->point_cost) {
            return back()->with('error', 'Poin tidak cukup');
        }

        $user->points -= $reward->point_cost;
        $user->save();

        Redeem::create([
            'user_id' => $user->id,
            'redeem_reward_id' => $reward->id,
            'points_used' => $reward->point_cost,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Redeem berhasil, tunggu konfirmasi admin');
    }
}
