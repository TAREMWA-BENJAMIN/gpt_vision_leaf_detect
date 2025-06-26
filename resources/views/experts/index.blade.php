@extends('layouts.app')

@section('content')
<div class="page-content">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Agricultural Experts List</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Photo</th>
                                    <th>District</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($experts as $expert)
                                <tr>
                                    <td>{{ $expert->id }}</td>
                                    <td>{{ $expert->name }}</td>
                                    <td>{{ $expert->email }}</td>
                                    <td>{{ $expert->phone_number }}</td>
                                    <td>
                                        <img src="{{ $expert->photo ? asset('storage/' . $expert->photo) : asset('images/default-avatar.png') }}" alt="{{ $expert->name }}" class="rounded-circle" width="40" height="40">
                                    </td>
                                    <td>{{ $expert->district->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $expert->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($expert->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $expert->created_at ? $expert->created_at->format('Y-m-d') : '' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm btn-view-expert" data-id="{{ $expert->id }}">View</button>
                                        <a href="{{ route('users.edit', $expert->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('users.destroy', $expert->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this expert?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Expert Details Modal -->
<div class="modal fade" id="expertDetailsModal" tabindex="-1" aria-labelledby="expertDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="expertDetailsModalLabel">Expert Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="expert-details-content">
        <!-- Details will be loaded here -->
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        'use strict';
        $('#dataTableExample').DataTable({
            "aLengthMenu": [
                [10, 30, 50, -1],
                [10, 30, 50, "All"]
            ],
            "iDisplayLength": 10,
            "language": {
                search: ""
            }
        });
        $('#dataTableExample').each(function() {
            var datatable = $(this);
            var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
            search_input.attr('placeholder', 'Search...');
            search_input.removeClass('form-control-sm');
            var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
            length_sel.removeClass('form-control-sm');
        });

        // View Expert Details
        $('.btn-view-expert').on('click', function() {
            var expertId = $(this).data('id');
            $.get('/users/' + expertId, function(user) {
                var html = `
                    <div class="text-center mb-3">
                        <img src="${user.photo}" alt="${user.name}" class="rounded-circle mb-2" width="70" height="70">
                    </div>
                    <p><strong>Name:</strong> ${user.name}</p>
                    <p><strong>Email:</strong> ${user.email}</p>
                    <p><strong>Phone Number:</strong> ${user.phone_number}</p>
                    <p><strong>Role:</strong> ${user.role}</p>
                    <p><strong>District:</strong> ${user.district && user.district.name ? user.district.name : 'Not specified'}</p>
                    <p><strong>Region:</strong> ${user.region ? user.region : 'Not specified'}</p>
                    <p><strong>Status:</strong> <span class="badge bg-${user.status === 'active' ? 'success' : 'danger'}">${user.status.charAt(0).toUpperCase() + user.status.slice(1)}</span></p>
                    ${user.role === 'admin' ? `<p><strong>Title:</strong> ${user.title || ''}</p><p><strong>Specialization:</strong> ${user.specialization || ''}</p><p><strong>Organization:</strong> ${user.organization || ''}</p>` : ''}
                `;
                $('#expert-details-content').html(html);
                $('#expertDetailsModal').modal('show');
            });
        });
    });
</script>
@endpush 