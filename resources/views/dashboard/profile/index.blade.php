@extends('dashboard.layouts.master')
@section('title', 'Profile — Mental Health Frontline')

@section('styles')
<style>
  :root {
    --navy:#0F3963; --blue:#1f5a8a; --mid:#4a85b5;
    --pale:#e8f4fd; --muted:#6b7f96; --green:#1d9e75;
    --red:#c94040; --r-md:12px; --sh:0 2px 14px rgba(15,57,99,.09);
  }
  .profile-avatar-wrap {
    display:flex; flex-direction:column; align-items:center;
    gap:14px; padding:28px 20px;
    background:#fff; border-radius:var(--r-md);
    box-shadow:var(--sh); border:1px solid rgba(15,57,99,.07);
  }
  .profile-avatar {
    width:110px; height:110px; border-radius:50%;
    object-fit:cover; border:3px solid var(--pale);
    box-shadow:0 4px 16px rgba(15,57,99,.15);
  }
  .avatar-placeholder {
    width:110px; height:110px; border-radius:50%;
    background:linear-gradient(135deg,var(--blue),var(--mid));
    display:flex; align-items:center; justify-content:center;
    font-family:"Nunito",sans-serif; font-size:36px; font-weight:800;
    color:#fff; border:3px solid var(--pale);
    box-shadow:0 4px 16px rgba(15,57,99,.15);
  }
  .profile-name { font-family:"Nunito",sans-serif; font-size:18px; font-weight:800; color:var(--navy); margin:0; }
  .profile-role { font-size:12px; color:var(--muted); margin:0; }
  .avatar-upload-btn {
    background:var(--pale); border:1px dashed var(--mid);
    border-radius:8px; padding:8px 16px; font-size:12px;
    font-weight:600; color:var(--navy); cursor:pointer;
    transition:all .2s; display:flex; align-items:center; gap:6px;
  }
  .avatar-upload-btn:hover { background:var(--navy); color:#fff; border-color:var(--navy); }
  .mhf-card { background:#fff; border-radius:var(--r-md); box-shadow:var(--sh); border:1px solid rgba(15,57,99,.07); padding:24px; }
  .mhf-card-header { margin-bottom:20px; padding-bottom:14px; border-bottom:1px solid var(--pale); }
  .mhf-card-header h5 { font-family:"Nunito",sans-serif; font-size:15px; font-weight:700; color:var(--navy); margin:0; }
  .mhf-card-header p  { font-size:12px; color:var(--muted); margin:4px 0 0; }
  .form-label-custom { font-size:12px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.4px; margin-bottom:5px; display:block; }
  .form-control-custom {
    width:100%; border:1px solid #dde6f0; border-radius:8px;
    padding:10px 14px; font-size:13px; color:var(--navy);
    outline:none; transition:border .2s; background:#fff; box-sizing:border-box;
  }
  .form-control-custom:focus { border-color:var(--mid); box-shadow:0 0 0 3px rgba(74,133,181,.12); }
  .btn-save {
    background:var(--navy); color:#fff; border:none; border-radius:8px;
    padding:10px 24px; font-size:13px; font-weight:700; cursor:pointer;
    transition:background .2s; display:inline-flex; align-items:center; gap:7px;
  }
  .btn-save:hover { background:var(--blue); }
  .alert-success-custom {
    background:#e6f9f4; border:1px solid #a8e6d1; color:#127a5a;
    border-radius:8px; padding:10px 16px; font-size:13px; font-weight:600;
    display:flex; align-items:center; gap:8px; margin-bottom:16px;
  }
  .alert-error-custom {
    background:#fde8e8; border:1px solid #f5b8b8; color:#c62828;
    border-radius:8px; padding:10px 16px; font-size:13px; font-weight:600;
    margin-bottom:16px;
  }
  .password-strength { height:4px; border-radius:99px; margin-top:6px; transition:all .3s; background:#eee; }
</style>
@endsection

@section('content')
<div class="pagetitle mb-3">
  <h1>User Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div>

<div class="row g-4">

  {{-- Left Column: Avatar & Quick Info --}}
  <div class="col-lg-3">
    <div class="profile-avatar-wrap">
      @if($user->avatar)
        <img src="{{ Storage::url($user->avatar) }}" class="profile-avatar" id="avatarPreview" alt="avatar">
      @else
        <div class="avatar-placeholder" id="avatarPlaceholder">
          {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <img src="" class="profile-avatar" id="avatarPreview" style="display:none" alt="avatar">
      @endif

      <div>
        <p class="profile-name text-center">{{ $user->name }}</p>
        <p class="profile-role text-center">Admin</p>
      </div>

      <form method="POST" action="{{ route('admin.profile.avatar') }}" enctype="multipart/form-data">
        @csrf
        @if(session('success_avatar'))
          <div class="alert-success-custom"><i class="bi bi-check-circle-fill"></i> {{ session('success_avatar') }}</div>
        @endif
        <label for="avatarInput" class="avatar-upload-btn">
          <i class="bi bi-camera-fill"></i> Change Photo
        </label>
        <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display:none" onchange="previewAvatar(this)">
        @error('avatar')
          <p style="font-size:11px; color:var(--red); margin:4px 0 0">{{ $message }}</p>
        @enderror
        <button type="submit" class="btn-save mt-2" id="avatarSaveBtn" style="display:none; width:100%; justify-content:center">
          <i class="bi bi-cloud-upload-fill"></i> Save Photo
        </button>
      </form>
    </div>

    <div class="mhf-card mt-3">
      <div style="display:flex; flex-direction:column; gap:12px">
        <div style="display:flex; align-items:center; gap:10px">
          <div style="width:34px;height:34px;border-radius:8px;background:var(--pale);display:flex;align-items:center;justify-content:center;color:var(--navy)">
            <i class="bi bi-envelope-fill" style="font-size:14px"></i>
          </div>
          <div>
            <p style="font-size:10px;color:var(--muted);margin:0;font-weight:600;text-transform:uppercase">Email</p>
            <p style="font-size:12px;color:var(--navy);margin:0;font-weight:600;word-break:break-all">{{ $user->email }}</p>
          </div>
        </div>
        <div style="display:flex; align-items:center; gap:10px">
          <div style="width:34px;height:34px;border-radius:8px;background:var(--pale);display:flex;align-items:center;justify-content:center;color:var(--navy)">
            <i class="bi bi-calendar3" style="font-size:14px"></i>
          </div>
          <div>
            <p style="font-size:10px;color:var(--muted);margin:0;font-weight:600;text-transform:uppercase">Member Since</p>
            <p style="font-size:12px;color:var(--navy);margin:0;font-weight:600">{{ $user->created_at->format('d M Y') }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Right Column: Forms --}}
  <div class="col-lg-9 d-flex flex-column gap-4">

    {{-- Update Profile Info --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5><i class="bi bi-person-fill me-2" style="color:var(--mid)"></i>Personal Information</h5>
        <p>Update your full name and email address</p>
      </div>
      @if(session('success_info'))
        <div class="alert-success-custom"><i class="bi bi-check-circle-fill"></i> {{ session('success_info') }}</div>
      @endif
      <form method="POST" action="{{ route('admin.profile.info') }}">
        @csrf
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label-custom">Full Name</label>
            <input type="text" name="name" class="form-control-custom" value="{{ old('name', $user->name) }}" required>
            @error('name')<p style="font-size:11px;color:var(--red);margin:4px 0 0">{{ $message }}</p>@enderror
          </div>
          <div class="col-md-6">
            <label class="form-label-custom">Email Address</label>
            <input type="email" name="email" class="form-control-custom" value="{{ old('email', $user->email) }}" required>
            @error('email')<p style="font-size:11px;color:var(--red);margin:4px 0 0">{{ $message }}</p>@enderror
          </div>
        </div>
        <div style="margin-top:18px">
          <button type="submit" class="btn-save">
            <i class="bi bi-floppy-fill"></i> Save Information
          </button>
        </div>
      </form>
    </div>

    {{-- Change Password --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5><i class="bi bi-shield-lock-fill me-2" style="color:var(--green)"></i>Change Password</h5>
        <p>It is recommended to use a strong password that you don't use elsewhere</p>
      </div>
      @if(session('success_password'))
        <div class="alert-success-custom"><i class="bi bi-check-circle-fill"></i> {{ session('success_password') }}</div>
      @endif
      <form method="POST" action="{{ route('admin.profile.password') }}">
        @csrf
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label-custom">Current Password</label>
            <div style="position:relative">
              <input type="password" name="current_password" id="curPass" class="form-control-custom" style="padding-left:14px; padding-right:42px" required>
              <i class="bi bi-eye-slash" id="toggleCur" onclick="togglePass('curPass','toggleCur')"
                 style="position:absolute;right:14px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--muted);font-size:15px"></i>
            </div>
            @error('current_password')<p style="font-size:11px;color:var(--red);margin:4px 0 0">{{ $message }}</p>@enderror
          </div>
          <div class="col-md-6">
            <label class="form-label-custom">New Password</label>
            <div style="position:relative">
              <input type="password" name="password" id="newPass" class="form-control-custom" style="padding-left:14px; padding-right:42px" oninput="checkStrength(this.value)" required>
              <i class="bi bi-eye-slash" id="toggleNew" onclick="togglePass('newPass','toggleNew')"
                 style="position:absolute;right:14px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--muted);font-size:15px"></i>
            </div>
            <div class="password-strength" id="strengthBar"></div>
            <p id="strengthText" style="font-size:11px;color:var(--muted);margin:3px 0 0"></p>
            @error('password')<p style="font-size:11px;color:var(--red);margin:4px 0 0">{{ $message }}</p>@enderror
          </div>
          <div class="col-md-6">
            <label class="form-label-custom">Confirm New Password</label>
            <div style="position:relative">
              <input type="password" name="password_confirmation" id="confPass" class="form-control-custom" style="padding-left:14px; padding-right:42px" required>
              <i class="bi bi-eye-slash" id="toggleConf" onclick="togglePass('confPass','toggleConf')"
                 style="position:absolute;right:14px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--muted);font-size:15px"></i>
            </div>
          </div>
        </div>
        <div style="margin-top:18px">
          <button type="submit" class="btn-save" style="background:var(--green)">
            <i class="bi bi-lock-fill"></i> Change Password
          </button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
function previewAvatar(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const preview = document.getElementById('avatarPreview');
      const placeholder = document.getElementById('avatarPlaceholder');
      preview.src = e.target.result;
      preview.style.display = 'block';
      if (placeholder) placeholder.style.display = 'none';
      document.getElementById('avatarSaveBtn').style.display = 'flex';
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function togglePass(inputId, iconId) {
  const input = document.getElementById(inputId);
  const icon  = document.getElementById(iconId);
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('bi-eye-slash', 'bi-eye');
  } else {
    input.type = 'password';
    icon.classList.replace('bi-eye', 'bi-eye-slash');
  }
}

function checkStrength(val) {
  const bar  = document.getElementById('strengthBar');
  const text = document.getElementById('strengthText');
  let score  = 0;
  if (val.length >= 8)           score++;
  if (/[A-Z]/.test(val))         score++;
  if (/[0-9]/.test(val))         score++;
  if (/[^A-Za-z0-9]/.test(val)) score++;
  const levels = [
    { color:'#c94040', label:'Very Weak', w:'20%' },
    { color:'#e08b2a', label:'Weak',      w:'40%' },
    { color:'#4a85b5', label:'Medium',    w:'65%' },
    { color:'#1d9e75', label:'Strong',    w:'100%'},
  ];
  const l = levels[Math.max(score - 1, 0)];
  bar.style.background = l.color;
  bar.style.width      = l.w;
  text.textContent     = l.label;
  text.style.color     = l.color;
}
</script>
@endsection