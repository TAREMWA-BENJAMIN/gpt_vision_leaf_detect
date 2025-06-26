<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PgtAiResult;
use App\Models\Disease;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use PDF;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     */
    public function index(): View
    {
        // --- User Statistics ---

        // Total Users
        $totalUsers = User::count();
        $totalUsersLastMonth = User::where('created_at', '<', Carbon::now()->subMonth())->count();
        $totalUsersPercentageChange = $totalUsersLastMonth > 0
            ? (($totalUsers - $totalUsersLastMonth) / $totalUsersLastMonth) * 100
            : ($totalUsers > 0 ? 100 : 0);

        // New Users (today)
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
        $newUsersYesterday = User::whereDate('created_at', Carbon::yesterday())->count();
        $newUsersPercentageChange = $newUsersYesterday > 0
            ? (($newUsersToday - $newUsersYesterday) / $newUsersYesterday) * 100
            : ($newUsersToday > 0 ? 100 : 0);

        // Active Users (this week)
        $activeUsersThisWeek = Schema::hasColumn('users', 'last_active_at')
            ? User::where('last_active_at', '>=', Carbon::now()->subWeek())->count()
            : 0;
        $activeUsersLastWeek = Schema::hasColumn('users', 'last_active_at')
            ? User::whereBetween('last_active_at', [Carbon::now()->subWeeks(2), Carbon::now()->subWeek()])->count()
            : 0;
        $activeUsersPercentageChange = $activeUsersLastWeek > 0
            ? (($activeUsersThisWeek - $activeUsersLastWeek) / $activeUsersLastWeek) * 100
            : ($activeUsersThisWeek > 0 ? 100 : 0);

        // --- Scan Statistics ---
        $totalScansSubmitted = PgtAiResult::count();

        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'totalUsersPercentageChange' => round($totalUsersPercentageChange),
            'newUsers' => $newUsersToday,
            'newUsersPercentageChange' => round($newUsersPercentageChange),
            'activeUsers' => $activeUsersThisWeek,
            'activeUsersPercentageChange' => round($activeUsersPercentageChange),
            'totalScansSubmitted' => $totalScansSubmitted
        ]);
    }

    /**
     * Display all data from pgt_ai_results table.
     */
    public function showPgtAiResults(): View
    {
        $pgtAiResults = PgtAiResult::all();
        return view('reports.pgt_ai_results', compact('pgtAiResults'));
    }

    /**
     * Export pgt_ai_results to PDF.
     */
    public function exportPgtAiResultsPdf()
    {
        $pgtAiResults = \App\Models\PgtAiResult::with('user')->get();
        $pdf = PDF::loadView('reports.pgt_ai_results_pdf', compact('pgtAiResults'));
        return $pdf->download('pgt_ai_results.pdf');
    }

    /**
     * Export pgt_ai_results to Excel.
     */
    public function exportPgtAiResultsExcel()
    {
        // Implement Excel export logic here
        // You will likely need a library like Maatwebsite\Excel
        // Example: return Excel::download(new PgtAiResultsExport, 'pgt_ai_results.xlsx');
        return response()->json(['message' => 'Excel export functionality to be implemented.']);
    }

    public function getChartData()
    {
        // Get the last 6 months for the x-axis
        $months = collect(range(5, 0))->map(function($i) {
            return Carbon::now()->subMonths($i)->format('M Y');
        })->toArray();

        // Disease Detection Trends (Line Chart)
        $diseaseTrends = PgtAiResult::select(DB::raw('DATE_FORMAT(created_at, \'%b %Y\') as month'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month');
        
        $diseaseTrendData = [];
        foreach ($months as $month) {
            $diseaseTrendData[] = $diseaseTrends->get($month, 0);
        }

        // Top Detected Diseases (Bar Chart)
        $topDiseases = PgtAiResult::select('disease_name', DB::raw('count(*) as count'))
            ->groupBy('disease_name')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        // User Growth Over Time (Line Chart)
        $userGrowth = User::select(DB::raw('DATE_FORMAT(created_at, \'%b %Y\') as month'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month');
        
        $userGrowthData = [];
        foreach ($months as $month) {
            $userGrowthData[] = $userGrowth->get($month, 0);
        }

        return response()->json([
            'diseaseTrends' => [
                'labels' => $months,
                'data' => $diseaseTrendData
            ],
            'topDiseases' => [
                'labels' => $topDiseases->pluck('disease_name')->toArray(),
                'data' => $topDiseases->pluck('count')->toArray()
            ],
            'userGrowth' => [
                'labels' => $months,
                'data' => $userGrowthData
            ]
        ]);
    }
} 