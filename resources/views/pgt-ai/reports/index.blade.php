@extends('layouts.app')

@section('title', 'Generated PGT-AI Reports')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}">
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">PGT-AI Reports</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">PGT-AI Scan Results</h6>
                <p class="text-muted mb-3">A comprehensive list of all plant scan results from the PGT-AI system.</p>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Plant Name</th>
                                <th>Plant Image</th>
                                <th>Status</th>
                                <th>Disease Name</th>
                                <th>Disease Details</th>
                                <th>Suggested Solution</th>
                                <th>Shared</th>
                                <th>Detected On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->id }}</td>
                                    <td>{{ $result->user->name ?? 'N/A' }}</td>
                                    <td>{{ $result->plant_name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $result->plant_image) }}" alt="{{ $result->plant_name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $result->status == 'diseased' ? 'danger' : 'success' }}">
                                            {{ ucfirst($result->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $result->disease_name ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($result->disease_details ?? 'N/A', 50) }}</td>
                                    <td>{{ Str::limit($result->suggested_solution ?? 'N/A', 50) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $result->shared ? 'primary' : 'secondary' }}">
                                            {{ $result->shared ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>{{ $result->created_at->format('d M, Y H:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $results->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
@endpush 