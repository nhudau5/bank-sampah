<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\WasteCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of withdrawals
     */

    public function show($id)
    {
        $withdrawal = Withdrawal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('withdrawals.user.show', compact('withdrawal'));
    }


    public function index(){
        $withdrawals = Withdrawal::where('user_id', Auth::id())
        ->latest()    
        ->paginate(10);    

    return view('withdrawals.user.index', compact('withdrawals'));
    }

    public function create(){
        return view('withdrawals.user.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $user = Auth::user();

        if ($request->amount > $user->saldo) {
            return back()->with('error', 'Saldo tidak mencukupi.');
        }

        // =========================
        // GENERATE KODE WITHDRAWAL
        // =========================
        $today = now()->format('Ymd');

        $lastWithdrawal = \App\Models\Withdrawal::whereDate('created_at', now()->toDateString())
            ->orderBy('id', 'desc')
            ->first();

        $number = $lastWithdrawal
            ? str_pad(((int) substr($lastWithdrawal->withdrawal_code, -4)) + 1, 4, '0', STR_PAD_LEFT)
            : '0001';

        $withdrawalCode = 'WD-' . $today . '-' . $number;

        // =========================
        // SIMPAN
        // =========================
        \App\Models\Withdrawal::create([
            'withdrawal_code' => $withdrawalCode,
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        // potong saldo
        $user->saldo -= $request->amount;
        $user->save();

        return redirect()
            ->route('withdrawals.user.index')
            ->with('success', 'Permintaan penarikan berhasil dikirim.');
    }


    // ADMIN
    public function adminIndex()
    {
        $withdrawals = Withdrawal::with('user')->latest()->get();
        return view('withdrawals.admin.index', compact('withdrawals'));
    }

    public function approve(Withdrawal $withdrawal)
    {
        $withdrawal->update(['status'=>'approved']);
        $withdrawal->user->decrement('balance', $withdrawal->amount);

        return back()->with('success','Withdraw disetujui');
    }

    public function reject(Withdrawal $withdrawal)
    {
        $withdrawal->update(['status'=>'rejected']);
        return back()->with('success','Withdraw ditolak');
    }

    /**
     * Remove the specified withdrawal (Admin only)
     */
    public function destroy(Withdrawal $withdrawal)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $withdrawal->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Data penarikan berhasil dihapus.');
    }
}
