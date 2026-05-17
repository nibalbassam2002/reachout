@extends('dashboard.layouts.master')
@section('title', 'Dashboard — Mental Health Frontline')

@section('styles')
<style>
  :root {
    --mhf-navy:  #0F3963;
    --mhf-blue:  #1f5a8a;
    --mhf-mid:   #4a85b5;
    --mhf-light: #c5dff2;
    --mhf-pale:  #e8f4fd;
    --mhf-muted: #6b7f96;
    --mhf-green: #1d9e75;
    --mhf-amber: #e08b2a;
    --mhf-red:   #c94040;
    --r-md: 12px;
    --r-lg: 18px;
    --sh:   0 2px 14px rgba(15,57,99,.09);
    --sh2:  0 6px 28px rgba(15,57,99,.14);
  }

  /* ── welcome banner ── */
  .mhf-welcome {
    background: linear-gradient(130deg, var(--mhf-navy) 0%, var(--mhf-blue) 55%, var(--mhf-mid) 100%);
    border-radius: var(--r-lg);
    padding: 30px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 26px;
    position: relative;
    overflow: hidden;
  }
  .mhf-welcome::before {
    content:''; position:absolute; right:-50px; top:-50px;
    width:220px; height:220px; border-radius:50%;
    background:rgba(255,255,255,.06);
  }
  .mhf-welcome::after {
    content:''; position:absolute; right:80px; bottom:-70px;
    width:160px; height:160px; border-radius:50%;
    background:rgba(255,255,255,.04);
  }
  .mhf-welcome h2 {
    font-family:"Nunito",sans-serif;
    font-size:20px; font-weight:700;
    color:#fff; margin:0 0 5px;
  }
  .mhf-welcome p {
    font-size:13px; color:rgba(255,255,255,.72); margin:0;
  }
  .mhf-welcome-date {
    background:rgba(255,255,255,.14);
    border:1px solid rgba(255,255,255,.22);
    border-radius:var(--r-md);
    padding:10px 20px;
    color:#fff; font-size:13px; font-weight:600;
    white-space:nowrap; position:relative; z-index:1;
    text-align:center;
  }
  .mhf-welcome-date small {
    display:block; font-size:11px;
    font-weight:400; opacity:.72; margin-top:2px;
  }

  /* ── stat cards ── */
  .mhf-stats {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(175px,1fr));
    gap:15px;
    margin-bottom:24px;
  }
  .mhf-stat {
    background:#fff;
    border-radius:var(--r-md);
    padding:18px 20px;
    box-shadow:var(--sh);
    border:1px solid rgba(15,57,99,.07);
    display:flex; align-items:center; gap:14px;
    transition:transform .2s, box-shadow .2s;
  }
  .mhf-stat:hover { transform:translateY(-3px); box-shadow:var(--sh2); }
  .mhf-stat-icon {
    width:48px; height:48px; border-radius:var(--r-md);
    display:flex; align-items:center; justify-content:center;
    font-size:20px; flex-shrink:0;
  }
  .ic-blue  { background:var(--mhf-pale);           color:var(--mhf-navy); }
  .ic-green { background:rgba(29,158,117,.11);       color:var(--mhf-green); }
  .ic-amber { background:rgba(224,139,42,.11);       color:var(--mhf-amber); }
  .ic-red   { background:rgba(201,64,64,.11);        color:var(--mhf-red); }
  .mhf-stat-info p {
    font-size:11px; color:var(--mhf-muted);
    margin:0 0 2px; font-weight:600;
    text-transform:uppercase; letter-spacing:.5px;
  }
  .mhf-stat-info h3 {
    font-family:"Nunito",sans-serif;
    font-size:24px; font-weight:700;
    color:var(--mhf-navy); margin:0; line-height:1;
  }
  .mhf-stat-info small { font-size:11px; color:var(--mhf-muted); }

  /* ── generic card ── */
  .mhf-card {
    background:#fff;
    border-radius:var(--r-md);
    box-shadow:var(--sh);
    border:1px solid rgba(15,57,99,.07);
    padding:20px 22px;
  }
  .mhf-card-header {
    display:flex; align-items:center;
    justify-content:space-between;
    margin-bottom:14px;
  }
  .mhf-card-header h5 {
    font-family:"Nunito",sans-serif;
    font-size:15px; font-weight:700;
    color:var(--mhf-navy); margin:0;
  }
  .mhf-card-header a {
    font-size:12px; color:var(--mhf-mid);
    font-weight:600; text-decoration:none;
  }
  .mhf-card-header a:hover { color:var(--mhf-navy); }

  /* ── chart placeholder ── */
  .mhf-chart-ph {
    width:100%; height:190px;
    background:var(--mhf-pale);
    border-radius:var(--r-md);
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    color:var(--mhf-mid); font-size:12px; gap:8px;
  }
  .mhf-chart-ph i { font-size:30px; opacity:.45; }

  /* ── quick actions ── */
  .mhf-actions {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(100px,1fr));
    gap:10px; margin-top:4px;
  }
  .mhf-action-btn {
    background:var(--mhf-pale);
    border:1px solid var(--mhf-light);
    border-radius:var(--r-md);
    padding:16px 8px;
    text-align:center; cursor:pointer;
    transition:all .2s; text-decoration:none; display:block;
  }
  .mhf-action-btn:hover {
    background:var(--mhf-navy);
    border-color:var(--mhf-navy);
    transform:translateY(-2px);
    box-shadow:var(--sh);
  }
  .mhf-action-btn:hover i,
  .mhf-action-btn:hover span { color:#fff !important; }
  .mhf-action-btn i {
    font-size:22px; color:var(--mhf-navy);
    display:block; margin-bottom:7px; transition:color .2s;
  }
  .mhf-action-btn span {
    font-size:11px; font-weight:600;
    color:var(--mhf-navy); transition:color .2s;
  }

  /* ── activity list ── */
  .mhf-act-item {
    display:flex; align-items:flex-start;
    gap:11px; padding:10px 0;
    border-bottom:1px solid rgba(15,57,99,.06);
  }
  .mhf-act-item:last-child { border-bottom:none; }
  .mhf-dot {
    width:8px; height:8px; border-radius:50%;
    margin-top:5px; flex-shrink:0;
  }
  .dot-g { background:var(--mhf-green); }
  .dot-a { background:var(--mhf-amber); }
  .dot-b { background:var(--mhf-mid); }
  .dot-r { background:var(--mhf-red); }
  .mhf-act-item p {
    font-size:13px; color:#444; margin:0 0 2px; line-height:1.4;
  }
  .mhf-act-item small { font-size:11px; color:var(--mhf-muted); }

  /* ── tip card ── */
  .mhf-tip {
    background:linear-gradient(135deg,var(--mhf-pale) 0%,#fff 100%);
    border:1px solid var(--mhf-light);
    border-radius:var(--r-md);
    padding:18px 20px;
    margin-top:16px;
  }
  .mhf-tip p {
    font-size:13px; color:var(--mhf-blue);
    margin:0; line-height:1.6;
  }
  .mhf-tip strong { color:var(--mhf-navy); }

  @media(max-width:768px) {
    .mhf-welcome { flex-direction:column; align-items:flex-start; }
  }
</style>
@endsection

@section('content')
<div class="pagetitle mb-3">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Home</a>
      </li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div>

{{-- ══ Welcome Banner ══ --}}
<div class="mhf-welcome">
  <div>
    <h2>Welcome back, {{ auth()->user()->name }} 👋</h2>
    <p>Mental Health Frontline — Admin Panel</p>
  </div>
  <div class="mhf-welcome-date">
    {{ now()->format('l, d M Y') }}
    <small>{{ now()->format('H:i') }} · Gaza Time</small>
  </div>
</div>

{{-- ══ Stat Cards ══ --}}
<div class="mhf-stats">
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-blue">
      <i class="bi bi-people-fill"></i>
    </div>
    <div class="mhf-stat-info">
      <p>Total Cases</p>
      <h3>—</h3>
      <small>Families supported</small>
    </div>
  </div>
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-green">
      <i class="bi bi-chat-heart-fill"></i>
    </div>
    <div class="mhf-stat-info">
      <p>Sessions</p>
      <h3>—</h3>
      <small>This month</small>
    </div>
  </div>
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-amber">
      <i class="bi bi-clock-history"></i>
    </div>
    <div class="mhf-stat-info">
      <p>Pending</p>
      <h3>—</h3>
      <small>Awaiting response</small>
    </div>
  </div>
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-red">
      <i class="bi bi-heart-pulse-fill"></i>
    </div>
    <div class="mhf-stat-info">
      <p>High Priority</p>
      <h3>—</h3>
      <small>Urgent cases</small>
    </div>
  </div>
</div>

{{-- ══ Main Grid ══ --}}
<div class="row g-4">

  {{-- Left col --}}
  <div class="col-lg-8 d-flex flex-column gap-4">

    {{-- Chart --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5>
          <i class="bi bi-bar-chart-line-fill me-2"
             style="color:var(--mhf-mid)"></i>Cases Overview
        </h5>
        <a href="#">View Report →</a>
      </div>
      <div class="mhf-chart-ph">
        <i class="bi bi-bar-chart"></i>
        <span>Chart will appear once data is connected</span>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5>
          <i class="bi bi-lightning-charge-fill me-2"
             style="color:var(--mhf-amber)"></i>Quick Actions
        </h5>
      </div>
      <div class="mhf-actions">
        <a href="#" class="mhf-action-btn">
          <i class="bi bi-person-plus-fill"></i>
          <span>New Case</span>
        </a>
        <a href="#" class="mhf-action-btn">
          <i class="bi bi-calendar-plus"></i>
          <span>Schedule</span>
        </a>
        <a href="#" class="mhf-action-btn">
          <i class="bi bi-file-earmark-medical"></i>
          <span>Report</span>
        </a>
        <a href="#" class="mhf-action-btn">
          <i class="bi bi-envelope-heart"></i>
          <span>Messages</span>
        </a>
        <a href="#" class="mhf-action-btn">
          <i class="bi bi-gear-fill"></i>
          <span>Settings</span>
        </a>
      </div>
    </div>

  </div>

  {{-- Right col --}}
  <div class="col-lg-4 d-flex flex-column gap-4">

    {{-- Recent Activity --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5>
          <i class="bi bi-activity me-2"
             style="color:var(--mhf-green)"></i>Recent Activity
        </h5>
        <a href="#">See all →</a>
      </div>

      <div class="mhf-act-item">
        <div class="mhf-dot dot-g"></div>
        <div>
          <p>New family registered via WhatsApp</p>
          <small>Just now</small>
        </div>
      </div>
      <div class="mhf-act-item">
        <div class="mhf-dot dot-a"></div>
        <div>
          <p>Follow-up pending — Case #041</p>
          <small>2 hours ago</small>
        </div>
      </div>
      <div class="mhf-act-item">
        <div class="mhf-dot dot-b"></div>
        <div>
          <p>Weekly report submitted</p>
          <small>Yesterday</small>
        </div>
      </div>
      <div class="mhf-act-item">
        <div class="mhf-dot dot-g"></div>
        <div>
          <p>Session completed — Case #038</p>
          <small>Yesterday</small>
        </div>
      </div>
      <div class="mhf-act-item">
        <div class="mhf-dot dot-r"></div>
        <div>
          <p>Urgent case flagged — Case #040</p>
          <small>2 days ago</small>
        </div>
      </div>
    </div>

    {{-- Distribution chart --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5>
          <i class="bi bi-pie-chart-fill me-2"
             style="color:var(--mhf-mid)"></i>Case Distribution
        </h5>
      </div>
      <div class="mhf-chart-ph" style="height:140px">
        <i class="bi bi-pie-chart"></i>
        <span>Coming soon</span>
      </div>
    </div>

    {{-- Tip --}}
    <div class="mhf-tip">
      <p>
        <strong>💡 Tip:</strong>
        Sections will be added gradually —
        use Quick Actions above to navigate faster.
      </p>
    </div>

  </div>
</div>
@endsection