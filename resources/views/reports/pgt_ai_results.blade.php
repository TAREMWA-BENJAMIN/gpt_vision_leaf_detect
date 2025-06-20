@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">AI Scan Results Report</h5>
                    <div class="d-flex">
                        <a href="{{ route('reports.pgt-ai-results.pdf') }}" class="btn btn-danger btn-sm me-2">
                            <i class="fas fa-file-pdf me-1"></i> Export to PDF
                        </a>
                        <a href="{{ route('reports.pgt-ai-results.excel') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel me-1"></i> Export to Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image Path</th>
                                    <th>Disease Name</th>
                                    <th>Confidence</th>
                                    <th>Crop Type</th>
                                    <th>Detected At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pgtAiResults as $result)
                                <tr>
                                    <td>{{ $result->id }}</td>
                                    <td>{{ $result->image_path }}</td>
                                    <td>{{ $result->disease_name }}</td>
                                    <td>{{ $result->confidence }}</td>
                                    <td>{{ $result->crop_type }}</td>
                                    <td>{{ $result->created_at->format('M d, Y H:i:s') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No AI scan results found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 