@extends('dashboard.layouts.master')
@section('title', 'Add New Doctor')

@section('styles')
<style>
    .form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(15, 57, 99, 0.05);
        padding: 20px;
    }
    .form-label {
        font-weight: 600;
        color: #0f3963;
        font-size: 14px;
        margin-bottom: 8px;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #e0e6ed;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s;
    }
    .form-control:focus {
        border-color: #1f5a8a;
        box-shadow: 0 0 0 0.2rem rgba(31, 90, 138, 0.1);
    }
    .btn-save {
        background-color: #0f3963;
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-save:hover {
        background-color: #1f5a8a;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="pagetitle mb-4">
    <h1 style="color: #0f3963; font-weight: 700;">Add New Specialist</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">Team</a></li>
            <li class="breadcrumb-item active">New Doctor</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card form-card">
                <div class="card-body">
                    <h5 class="card-title mb-4" style="color: #0f3963;">Doctor Information</h5>

                    {{-- عرض الأخطاء إذا وجدت --}}
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 mb-4" style="border-radius: 10px;">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.doctors.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            {{-- الاسم --}}
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Dr. John Doe" required value="{{ old('name') }}">
                            </div>

                            {{-- الإيميل --}}
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="doctor@mhf.com" required value="{{ old('email') }}">
                            </div>

                            {{-- التخصص --}}
                            <div class="col-md-6">
                                <label class="form-label">Specialization</label>
                                <input type="text" name="specialization" class="form-control" placeholder="e.g. Clinical Psychologist" required value="{{ old('specialization') }}">
                            </div>

                            {{-- كلمة المرور --}}
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>

                            {{-- السيرة الذاتية (Bio) --}}
                            <div class="col-12">
                                <label class="form-label">Brief Bio (Optional)</label>
                                <textarea name="bio" class="form-control" rows="3" placeholder="Tell us about the doctor's experience...">{{ old('bio') }}</textarea>
                            </div>

                            <div class="col-12 mt-4 text-end">
                                <a href="{{ route('admin.doctors.index') }}" class="btn btn-light me-2" style="border-radius: 10px; padding: 12px 25px;">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-save text-white">
                                    <i class="bi bi-check-circle me-1"></i> Create Doctor Account
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection