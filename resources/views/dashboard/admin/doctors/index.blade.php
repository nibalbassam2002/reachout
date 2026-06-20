@extends('dashboard.layouts.master')
@section('title', 'Doctors Management')

@section('content')
<style>
.table-scroll {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.table-scroll table {
    min-width: 600px;
}

@media (max-width: 576px) {
    .doctors-header {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 12px;
    }
    .doctors-header a {
        width: 100%;
        text-align: center;
    }
}
</style>

<div class="pagetitle mb-4">
    <h1 style="color: #0f3963; font-weight: 700;">Doctors Team</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Team</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card mhf-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center py-3 mb-2 doctors-header">
                <h5 class="card-title m-0" style="color: #0f3963;">Registered Specialists</h5>
                <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary px-4 py-2" style="border-radius: 10px; background-color: #0d6efd;">
                    <i class="bi bi-plus-lg me-2"></i> Add New Doctor
                </a>
            </div>

            <div class="table-scroll">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Email Address</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                        <tr>
                            <td>
                                <div class="doctor-info">
                                    <img src="{{ asset('reachout/img/profile-img.jpg') }}" class="doctor-avatar" alt="Avatar">
                                    <div>
                                        <div style="font-weight: 600; color: #0f3963;">{{ $doctor->name }}</div>
                                        <small class="text-muted">{{ str_pad($loop->iteration, 1, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $doctor->email }}</td>
                            <td>
                                <span style="color: #4a85b5; font-weight: 500;">
                                    {{ $doctor->doctorProfile->specialization ?? 'General Psychology' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-active">Active</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn-action btn-edit me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action btn-delete delete-btn" title="Delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-people"></i>
                                    <p class="text-muted">No doctors found in the team yet.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "This doctor's account and profile will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#c94040',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                borderRadius: '15px'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection