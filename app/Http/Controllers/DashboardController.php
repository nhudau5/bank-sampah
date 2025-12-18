<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\WasteCategory;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        return $this->userDashboard($user);
    }

    private function adminDashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalTransactions = Transaction::where('status', 'approved')->count();
        $totalWaste = Transaction::where('status', 'approved')->sum('weight');
        $totalRevenue = Transaction::where('status', 'approved')->sum('total_price');

        $pendingTransactions = Transaction::where('status', 'pending')
            ->with(['user', 'wasteCategory'])
            ->latest()
            ->take(5)
            ->get();

        $pendingWithdrawals = Withdrawal::where('status', 'pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        $monthlyWaste = Transaction::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(weight) as total_weight')
            )
            ->where('status', 'approved')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $wasteByCategory = Transaction::select(
                'waste_categories.name',
                DB::raw('SUM(transactions.weight) as total_weight')
            )
            ->join('waste_categories', 'transactions.waste_category_id', '=', 'waste_categories.id')
            ->where('transactions.status', 'approved')
            ->groupBy('waste_categories.name')
            ->get();

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalTransactions',
            'totalWaste',
            'totalRevenue',
            'pendingTransactions',
            'pendingWithdrawals',
            'monthlyWaste',
            'wasteByCategory'
        ));
    }

    private function userDashboard($user)
    {
        // ===== STATISTIK =====
        $totalTransactions = $user->transactions()
            ->where('status', 'approved')
            ->count();

        $totalWaste = $user->transactions()
            ->where('status', 'approved')
            ->sum('weight');

        $saldo = $user->saldo;
        $points = $user->total_points;

        // ===== TRANSAKSI TERAKHIR =====
        $recentTransactions = $user->transactions()
            ->with('wasteCategory')
            ->latest()
            ->take(10)
            ->get();

        // ===== DATA CHART 6 BULAN =====
        $monthlyWaste = $user->transactions()
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(weight) as total_weight')
            )
            ->where('status', 'approved')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // ===== FORMAT BUAT CHART.JS =====
        $chartLabels = [];
        $chartData = [];

        foreach ($monthlyWaste as $item) {
            $chartLabels[] = date('M Y', strtotime($item->month . '-01'));
            $chartData[] = (float) $item->total_weight;
        }

        return view('dashboard.user', compact(
            'totalTransactions',
            'totalWaste',
            'saldo',
            'points',
            'recentTransactions',
            'chartLabels',
            'chartData'
        ));
    }
}
