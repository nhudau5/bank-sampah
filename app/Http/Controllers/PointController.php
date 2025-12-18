<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function redeem(Request $request)
    {
        $user = Auth::user();

        if ($user->points < 100) {
            return back()->with('error', 'Poin belum cukup untuk redeem');
        }

        // contoh: 100 poin = Rp10.000
        $redeemPoint = 100;
        $redeemValue = 10000;

        $user->points -= $redeemPoint;
        $user->balance += $redeemValue;
        $user->save();

        return back()->with('success', 'Poin berhasil ditukar menjadi saldo');
    }
}
