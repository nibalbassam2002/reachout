@extends('dashboard.layouts.master')
@section('title', 'Doctor Dashboard — MHF')

@section('content')
<div class="pagetitle">
  <h1>Welcome, Dr. {{ auth()->user()->name }}</h1>
  <p class="text-muted">Mental Health Frontline — Specialist Panel</p>
</div>

<section class="section">
    <div class="row">
        <!-- كرت إحصائيات سريع للدكتور -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm" style="border-radius:15px; border:none; border-left: 5px solid #0f3963;">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-light p-3 rounded-3 me-3">
                        <i class="bi bi-people-fill text-primary" style="font-size: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">My Active Cases</h6>
                        <h3 class="mb-0">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 shadow-sm" style="border-radius:15px; border:none;">
        <div class="card-body p-5 text-center">
            <i class="bi bi-clipboard-pulse text-muted" style="font-size: 50px; opacity: 0.3;"></i>
            <h4 class="mt-3" style="color: #0f3963;">No assigned cases yet</h4>
            <p class="text-muted">New cases assigned by the admin will appear here.</p>
        </div>
    </div>
</section>
@endsection