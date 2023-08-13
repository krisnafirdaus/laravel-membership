<?php

namespace App\Http\Controllers;

use ConsoleTVs\Charts\Facades\Charts;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller {
    public function valasMonthlyReport($valasName)
    {
        $valasData = Vala::where('NamaValas', $valasName)
                        ->whereBetween('Tanggal_Rate', [now()->startOfMonth(), now()->endOfMonth()])
                        ->get();

        $chart = Charts::database($valasData, 'line', 'chartjs')
                    ->title('Laporan Bulanan')
                    ->elementLabel('Nilai')
                    ->labels($valasData->pluck('Tanggal_Rate'))
                    ->values($valasData->pluck('Nilai_Jual'));

        return view('reports.valas', ['chart' => $chart]);
    }

    public function customerMembershipReport()
    {
        $customers = Customer::with(['membership'])
                            ->whereHas('transactions', function($query) {
                                $query->where('profit', '>=', 'memberships.Minimum_Profit');
                            })->get();

        return view('reports.customers', compact('customers'));
    }

    public function totalProfitReport()
    {
        $totalProfit = Transaction::sum(DB::raw('total - discount')); // Sesuaikan formula profit Anda

        return view('reports.profit', compact('totalProfit'));
    }


}
