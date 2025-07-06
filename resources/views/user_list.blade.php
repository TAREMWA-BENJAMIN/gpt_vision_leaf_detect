@extends('layouts.app')

@section('content')
<div class="page-content">

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title mb-0">User List</h6>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i> Add User
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Photo</th>
                                    <th>Role</th>
                                    <th>District</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>
                                        @php
                                            $photo = $user->photo;
                                            $isBase64 = $photo && str_starts_with($photo, 'data:image');
                                            $imgSrc = $isBase64 ? $photo : ($photo ? asset('storage/' . $photo) : asset('images/default-avatar.png'));
                                        @endphp
                                        <img src="{{ $imgSrc }}" alt="{{ $user->first_name }}" class="rounded-circle" width="40" height="40">
                                    </td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->district->name ?? 'Not specified' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm view-user-btn" data-bs-toggle="modal" 
                                        data-bs-target="#viewUserModal" data-user-id="{{ $user->id }}">View</button>

                                        <a href="{{ route('users.edit', $user->id) }}" 
                                            class="btn btn-primary btn-sm">Edit</a>

                                        <form action="{{ route('users.destroy', $user->id) }}" 
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
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

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="userDetailsContent">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

        $('#viewUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var userId = button.data('user-id'); // Extract info from data-* attributes

            var modal = $(this);
            modal.find('.modal-title').text('User Details');
            modal.find('#userDetailsContent').html('<p>Loading user details...</p>');

            $.ajax({
                url: '/users/' + userId,
                method: 'GET',
                success: function(data) {
                    var user = data;
                    var detailsHtml = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center mb-3">
                                <img src="${user.photo}" alt="${user.name}" class="" width="100%" height="400">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Name:</strong> ${user.name}</p>
                            <p><strong>Email:</strong> ${user.email}</p>
                            <p><strong>Phone Number:</strong> ${user.phone_number}</p>
                            <p><strong>Role:</strong> ${user.role}</p>
                            <p><strong>District:</strong> ${user.district && user.district.name ? user.district.name : 'Not specified'}</p>
                            <p><strong>Region:</strong> ${user.region ? user.region : 'Not specified'}</p>
                            <p><strong>Status:</strong> <span class="badge bg-${user.status === 'active' ? 'success' : 'danger'}">${user.status.charAt(0).toUpperCase() + user.status.slice(1)}</span></p>
                            <p><strong>Created At:</strong> ${user.created_at}</p>
                            ${user.role === 'admin' ? `<p><strong>Title:</strong> ${user.title || ''}</p><p><strong>Specialization:</strong> ${user.specialization || ''}</p><p><strong>Organization:</strong> ${user.organization || ''}</p>` : ''}
                        </div>
                    </div>
                    `;
                    modal.find('#userDetailsContent').html(detailsHtml);
                },
                error: function(error) {
                    modal.find('#userDetailsContent').html('<p>Error loading user details.</p>');
                    console.error('Error fetching user details:', error);
                }
            });
        });
    });
</script>
@endpush