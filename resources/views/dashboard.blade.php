@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card bg-gradient-primary text-white p-2 rounded-lg shadow">
                <div class="d-flex justify-content-between align-items-center">
                    
                    <div class="welcome-icon">
                        <i class="fas fa-leaf fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Users Card -->
        <div class="col-md-3">
            <div class="card stat-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Users</h6>
                            <h3 class="mb-0">{{ $totalUsers ?? 0 }}</h3>
                            <p class="text-success mb-0">
                                <i data-feather="arrow-up"></i> 12% from last month
                            </p>
                        </div>
                        <div class="stat-icon bg-primary-light">
                            <i data-feather="users" class="text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Scans Submitted Card -->
        <div class="col-md-3">
            <div class="card stat-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Scans Submitted</h6>
                            <h3 class="mb-0">{{ $totalScansSubmitted ?? 0 }}</h3>
                            <p class="text-muted mb-0">
                                <i data-feather="bar-chart-2"></i> Overall count
                            </p>
                        </div>
                        <div class="stat-icon bg-warning-light">
                            <i data-feather="leaf" class="text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Users Card -->
        <div class="col-md-3">
            <div class="card stat-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Active Users</h6>
                            <h3 class="mb-0">{{ $activeUsers ?? 0 }}</h3>
                            <p class="text-success mb-0">
                                <i data-feather="arrow-up"></i> 8% from last week
                            </p>
                        </div>
                        <div class="stat-icon bg-success-light">
                            <i data-feather="user-check" class="text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Users Card -->
        <div class="col-md-3">
            <div class="card stat-card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">New Users</h6>
                            <h3 class="mb-0">{{ $newUsers ?? 0 }}</h3>
                            <p class="text-success mb-0">
                                <i data-feather="arrow-up"></i> 15% from yesterday
                            </p>
                        </div>
                        <div class="stat-icon bg-info-light">
                            <i data-feather="user-plus" class="text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
        <!-- Disease Detection Trends -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Disease Detection Trends</h5>
                </div>
                <div class="card-body">
                    <canvas id="diseaseTrendsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Detected Diseases -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Top Detected Diseases</h5>
                </div>
                <div class="card-body">
                    <canvas id="topDiseasesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- User Growth Over Time -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">User Growth Over Time</h5>
                </div>
                <div class="card-body">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="{{ route('users.create') }}" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-user-plus me-2"></i> Add New User
                        </a>
                        <a href="{{ route('reports.generate') }}" class="btn btn-success w-100 mb-2">
                            <i class="fas fa-file-alt me-2"></i> Generate Report
                        </a>
                        <a href="{{ route('settings.show') }}" class="btn btn-info w-100">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Removed Recent Activity Section --}}

</div>

<style>
    .welcome-card {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }

    .stat-card {
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-primary-light {
        background-color: rgba(78, 115, 223, 0.1);
    }

    .bg-success-light {
        background-color: rgba(40, 167, 69, 0.1);
    }

    .bg-info-light {
        background-color: rgba(23, 162, 184, 0.1);
    }

    .activity-list {
        max-height: 400px;
        overflow-y: auto;
    }

    .activity-item {
        padding: 10px;
        border-radius: 8px;
        transition: background-color 0.2s;
    }

    .activity-item:hover {
        background-color: #f8f9fa;
    }

    .activity-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quick-actions .btn {
        padding: 12px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .quick-actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@push('scripts')
<!-- Required JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="{{ asset('files/js/dashboard-charts.js') }}"></script>

<!-- Debug script -->
<script>
    $(document).ready(function() {
        console.log('Dashboard page loaded');
        
        // Test chart data endpoint
        $.ajax({
            url: '/dashboard/chart-data',
            method: 'GET',
            success: function(response) {
                console.log('Chart data received:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching chart data:', error);
            }
        });
    });
</script>
@endpush