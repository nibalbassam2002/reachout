@extends('dashboard.layouts.master')
@section('title', 'Edit Doctor')

@section('styles')
<style>
    .edit-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(15, 57, 99, 0.08);
        overflow: hidden;
    }
    .edit-card-header {
        background-color: #f8fbff;
        border-bottom: 1px solid #edf2f9;
        padding: 20px 25px;
    }
    .form-label {
        font-weight: 600;
        color: #0f3963;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    .form-control {
        border-radius: 12px;
        border: 1px solid #e0e6ed;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s;
        background-color: #fdfdfd;
    }
    .form-control:focus {
        border-color: #1f5a8a;
        box-shadow: 0 0 0 4px rgba(31, 90, 138, 0.08);
        background-color: #fff;
    }
    .bio-textarea {
        resize: none;
    }
    .btn-update {
        background-color: #0f3963;
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 12px 35px;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(15, 57, 99, 0.2);
    }
    .btn-update:hover {
        background-color: #1f5a8a;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(15, 57, 99, 0.3);
        color: #fff;
    }
    .btn-cancel {
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 600;
        color: #6b7f96;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
    .section-title {
        font-size: 14px;
        color: #4a85b5;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #eee;
    }
</style>
@endsection

@section('content')
<div class="pagetitle mb-4">
    <h1 style="color: #0f3963; font-weight: 800; font-size: 24px;">Update Specialist Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">Doctors Team</a></li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card edit-card">
                <div class="edit-card-header">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 50px; height: 50px; background: #e8f4fd; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person-gear" style="font-size: 24px; color: #0f3963;"></i>
                        </div>
                        <div>
                            <h5 class="m-0" style="color: #0f3963; font-weight: 700;">Edit Information for Dr. {{ $doctor->name }}</h5>
                            <small class="text-muted">Update account credentials and professional details</small>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Account Section -->
                        <div class="section-title">
                            <i class="bi bi-shield-lock-fill"></i> ACCOUNT DETAILS
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" placeholder="Enter doctor's name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" placeholder="email@example.com" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Update Password <small class="text-muted fw-normal">(Leave blank to keep current)</small></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-key text-muted"></i></span>
                                    <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" style="border-radius: 0 12px 12px 0;">
                                </div>
                            </div>
                        </div>

                        <!-- Professional Section -->
                        <div class="section-title">
                            <i class="bi bi-briefcase-fill"></i> PROFESSIONAL PROFILE
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Specialization</label>
                                <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $doctor->doctorProfile->specialization ?? '') }}" placeholder="e.g. Clinical Psychologist" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Short Bio / Experience</label>
                                <textarea name="bio" class="form-control bio-textarea" rows="4" placeholder="Write a brief professional summary...">{{ old('bio', $doctor->doctorProfile->bio ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end align-items-center gap-3 pt-3 border-top mt-4">
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-cancel">
                                <i class="bi bi-x-lg me-1"></i> Discard Changes
                            </a>
                            <button type="submit" class="btn btn-update">
                                <i class="bi bi-cloud-arrow-up-fill me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection