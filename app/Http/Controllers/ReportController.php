<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function adminReport(Request $request)
    {
        $transactions = Transaction::with(['user','category'])->get();

        $totalTransactions = $transactions->count();
        $totalApproved = $transactions->where('status','approved')->sum('total_price');
        $totalRejected = $transactions->where('status','rejected')->sum('total_price');
        $totalPending = $transactions->where('status','pending')->sum('total_price');
        $totalWeight = $transactions->sum('weight');
        $totalPoints = $transactions->sum('points_earned');

        // jika ada query download=pdf
        if ($request->query('download') === 'pdf') {
            $pdf = Pdf::loadView('reports.admin_pdf', compact(
                'transactions', 'totalTransactions','totalApproved',
                'totalRejected','totalPending','totalWeight','totalPoints'
            ));
            return $pdf->download('laporan-admin-'.date('Y-m-d').'.pdf');
        }

        // versi web
        return view('reports.admin', compact(
            'transactions', 'totalTransactions','totalApproved',
            'totalRejected','totalPending','totalWeight','totalPoints'
        ));
    }

}
