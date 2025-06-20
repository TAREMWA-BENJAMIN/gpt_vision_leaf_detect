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

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     */
    public function index(): View
    {
        // Get user statistics
        $totalUsers = User::count();
        $newUsers = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        
        // Check if last_active_at column exists before using it
        $activeUsers = Schema::hasColumn('users', 'last_active_at') 
            ? User::where('last_active_at', '>=', Carbon::now()->subMinutes(5))->count()
            : User::count(); // Fallback to total users if column doesn't exist

        // Get total scans submitted
        $totalScansSubmitted = PgtAiResult::count();

        return view('dashboard', compact(
            'totalUsers',
            'newUsers',
            'activeUsers',
            'totalScansSubmitted'
        ));
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
        // Implement PDF export logic here
        // You will likely need a library like Barryvdh\Dompdf
        // Example: return Pdf::loadView('reports.pgt_ai_results_pdf', compact('pgtAiResults'))->download('pgt_ai_results.pdf');
        return response()->json(['message' => 'PDF export functionality to be implemented.']);
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