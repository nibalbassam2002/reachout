@extends('dashboard.layouts.master')
@section('title', 'Complaints — Mental Health Frontline')
@section('content')
<div class="pagetitle">
    <h1>Policy Complaints</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Complaints</li>
        </ol>
    </nav>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($complaints->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <i class="bi bi-folder2-open" style="font-size:48px;"></i>
            <p class="mt-3">No complaints submitted yet.</p>
        </div>
    </div>
@else
    <div class="complaints-grid">
        @foreach($complaints as $complaint)
        <div class="complaint-card {{ $complaint->status === 'new' ? 'is-new' : '' }}">

            {{-- Header --}}
            <div class="cc-header">
                <div class="cc-id">#{{ $complaint->id }}</div>
                <div class="cc-time">
                    <i class="bi bi-clock"></i>
                    {{ $complaint->created_at->diffForHumans() }}
                </div>
                @if($complaint->status === 'new')
                    <span class="cc-badge badge-new">New</span>
                @elseif($complaint->status === 'reviewed')
                    <span class="cc-badge badge-reviewed">Reviewed</span>
                @else
                    <span class="cc-badge badge-resolved">Resolved</span>
                @endif
            </div>

            {{-- Contact --}}
            <div class="cc-row">
                <i class="bi bi-person"></i>
                <span class="cc-label">Contact:</span>
                <span>{{ $complaint->contact_info }}</span>
            </div>

            {{-- Type --}}
            <div class="cc-row">
                <i class="bi bi-tag"></i>
                <span class="cc-label">Type:</span>
                <span>{{ $complaint->type_of_concern }}</span>
            </div>

            {{-- Details --}}
            <div class="cc-row cc-row-details">
                <i class="bi bi-file-text"></i>
                <span class="cc-label">Details:</span>
            </div>
            <div class="cc-details">
                {{ $complaint->details }}
            </div>

            {{-- Footer: Change Status --}}
            <form action="{{ route('admin.complaints.updateStatus', $complaint) }}" method="POST" class="cc-footer">
                @csrf
                @method('PATCH')
                <select name="status" class="cc-select">
                    <option value="new"      {{ $complaint->status === 'new'      ? 'selected' : '' }}>🔵 New</option>
                    <option value="reviewed" {{ $complaint->status === 'reviewed' ? 'selected' : '' }}>🟡 Reviewed</option>
                    <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>🟢 Resolved</option>
                </select>
                <button type="submit" class="cc-save-btn">Save</button>
            </form>

        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $complaints->links() }}
    </div>
@endif

@endsection
