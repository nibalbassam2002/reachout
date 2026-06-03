@extends('dashboard.layouts.master')

@section('content')
<div class="pagetitle mb-4">
    <h1 style="color: #012970; font-weight: 700;">Bank Account Settings</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Bank Settings</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-4">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.bank.update') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- ── Primary Info ── -->
                            <div class="col-12 border-bottom pb-2">
                                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-info-circle me-2"></i>Primary Information</h6>
                            </div>

                            <div class="col-md-6">
                                <label class="small fw-bold text-muted mb-1">Account Name</label>
                                <input type="text" name="account_name" class="form-control bg-light" value="{{ old('account_name', $bank->account_name) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="small fw-bold text-muted mb-1">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control bg-light" value="{{ old('bank_name', $bank->bank_name) }}">
                            </div>

                            <!-- ── Wire Details ── -->
                            <div class="col-12 border-bottom pb-2 mt-5">
                                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-globe me-2"></i>Transfer Details</h6>
                            </div>

                            <div class="col-md-4">
                                <label class="small fw-bold text-muted mb-1">SWIFT / BIC</label>
                                <input type="text" name="swift_code" class="form-control" value="{{ old('swift_code', $bank->swift_code) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="small fw-bold text-muted mb-1">Branch</label>
                                <input type="text" name="branch" class="form-control" value="{{ old('branch', $bank->branch) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="small fw-bold text-muted mb-1">City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city', $bank->city) }}">
                            </div>

                            <div class="col-md-12">
                                <label class="small fw-bold text-muted mb-1">Country</label>
                                <input type="text" name="country" class="form-control" value="{{ old('country', $bank->country) }}">
                            </div>

                            <!-- ── IBAN Numbers ── -->
                            <div class="col-12 border-bottom pb-2 mt-5">
                                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-credit-card me-2"></i>IBAN Numbers</h6>
                            </div>

                            <div class="col-md-6">
                                <label class="small fw-bold text-muted mb-1">IBAN (USD $)</label>
                                <input type="text" name="iban_usd" class="form-control fw-bold border-primary-subtle" value="{{ old('iban_usd', $bank->iban_usd) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="small fw-bold text-muted mb-1">IBAN (ILS ₪)</label>
                                <input type="text" name="iban_ils" class="form-control fw-bold border-primary-subtle" value="{{ old('iban_ils', $bank->iban_ils) }}">
                            </div>

                            <!-- ── Contact ── -->
                            <div class="col-12 border-bottom pb-2 mt-5">
                                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-whatsapp me-2"></i>WhatsApp Integration</h6>
                            </div>

                            <div class="col-md-12">
                                <label class="small fw-bold text-muted mb-1">WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $bank->whatsapp_number) }}" placeholder="e.g. 970590000000">
                            </div>

                            <div class="col-12 text-end mt-5 pt-3">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm px-5" style="border-radius: 8px; font-weight: 600;">
                                    Update Settings
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .form-control { border-radius: 8px; padding: 12px; border: 1px solid #e0e5ed; }
    .form-control:focus { box-shadow: 0 0 0 4px rgba(65, 84, 241, 0.1); border-color: #4154f1; }
    .breadcrumb-item + .breadcrumb-item::before { content: "›"; color: #899bbd; font-size: 18px; line-height: 1; }
</style>
@endsection