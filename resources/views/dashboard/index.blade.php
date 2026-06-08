@extends('dashboard.layouts.master')
@section('title', 'Dashboard — Mental Health Frontline')

@section('styles')
<style>
  :root {
    --navy:   #0F3963;
    --blue:   #1f5a8a;
    --mid:    #4a85b5;
    --light:  #c5dff2;
    --pale:   #e8f4fd;
    --muted:  #6b7f96;
    --green:  #1d9e75;
    --amber:  #e08b2a;
    --red:    #c94040;
    --purple: #7c5cbf;
    --r-md: 12px;
    --r-lg: 18px;
    --sh:   0 2px 14px rgba(15,57,99,.09);
    --sh2:  0 6px 28px rgba(15,57,99,.16);
  }
  .mhf-welcome {
    background: linear-gradient(130deg, var(--navy) 0%, var(--blue) 55%, var(--mid) 100%);
    border-radius: var(--r-lg); padding: 28px 34px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 16px; margin-bottom: 24px; position: relative; overflow: hidden;
  }
  .mhf-welcome::before {
    content:''; position:absolute; right:-50px; top:-50px;
    width:220px; height:220px; border-radius:50%; background:rgba(255,255,255,.06);
  }
  .mhf-welcome::after {
    content:''; position:absolute; right:80px; bottom:-70px;
    width:160px; height:160px; border-radius:50%; background:rgba(255,255,255,.04);
  }
  .mhf-welcome h2 { font-family:"Nunito",sans-serif; font-size:20px; font-weight:700; color:#fff; margin:0 0 5px; }
  .mhf-welcome p  { font-size:13px; color:rgba(255,255,255,.72); margin:0; }
  .mhf-welcome-date {
    background:rgba(255,255,255,.14); border:1px solid rgba(255,255,255,.22);
    border-radius:var(--r-md); padding:10px 20px;
    color:#fff; font-size:13px; font-weight:600; white-space:nowrap; position:relative; z-index:1; text-align:center;
  }
  .mhf-welcome-date small { display:block; font-size:11px; font-weight:400; opacity:.72; margin-top:2px; }
  .complaint-badge {
    display:inline-flex; align-items:center; gap:5px; background:rgba(201,64,64,.85);
    padding:3px 10px; border-radius:99px; font-size:12px; font-weight:700; color:#fff;
  }

  /* stat cards */
  .mhf-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(170px,1fr)); gap:14px; margin-bottom:22px; }
  .mhf-stat {
    background:#fff; border-radius:var(--r-md); padding:18px 20px; box-shadow:var(--sh);
    border:1px solid rgba(15,57,99,.07); display:flex; align-items:center; gap:14px;
    transition:transform .2s, box-shadow .2s; text-decoration:none;
  }
  .mhf-stat:hover { transform:translateY(-3px); box-shadow:var(--sh2); }
  .mhf-stat-icon { width:48px; height:48px; border-radius:var(--r-md); display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; }
  .ic-blue   { background:var(--pale);               color:var(--navy);   }
  .ic-green  { background:rgba(29,158,117,.11);       color:var(--green);  }
  .ic-amber  { background:rgba(224,139,42,.11);       color:var(--amber);  }
  .ic-red    { background:rgba(201,64,64,.11);        color:var(--red);    }
  .ic-teal   { background:rgba(15,130,150,.11);       color:#0f8296;       }
  .mhf-stat-info p { font-size:11px; color:var(--muted); margin:0 0 2px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
  .mhf-stat-info h3 { font-family:"Nunito",sans-serif; font-size:26px; font-weight:800; color:var(--navy); margin:0; line-height:1; }
  .mhf-stat-info small { font-size:11px; color:var(--muted); }

  /* card */
  .mhf-card { background:#fff; border-radius:var(--r-md); box-shadow:var(--sh); border:1px solid rgba(15,57,99,.07); padding:20px 22px; }
  .mhf-card-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
  .mhf-card-header h5 { font-family:"Nunito",sans-serif; font-size:15px; font-weight:700; color:var(--navy); margin:0; }
  .mhf-card-header a { font-size:12px; color:var(--mid); font-weight:600; text-decoration:none; }
  .mhf-card-header a:hover { color:var(--navy); }

  /* bar chart */
  .chart-bar-wrap { display:flex; flex-direction:column; gap:10px; }
  .chart-bar-row  { display:flex; align-items:center; gap:10px; }
  .chart-bar-label { font-size:12px; color:var(--muted); font-weight:600; width:80px; flex-shrink:0; text-align:right; }
  .chart-bar-track { flex:1; height:10px; background:var(--pale); border-radius:99px; overflow:hidden; }
  .chart-bar-fill  { height:100%; border-radius:99px; }
  .chart-bar-val   { font-size:12px; font-weight:700; color:var(--navy); width:28px; flex-shrink:0; }

  /* donut */
  .donut-wrap { position:relative; display:flex; justify-content:center; margin:8px 0 14px; }
  .donut-center { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; pointer-events:none; }
  .donut-center span { font-family:"Nunito",sans-serif; font-size:22px; font-weight:800; color:var(--navy); display:block; line-height:1; }
  .donut-center small { font-size:10px; color:var(--muted); }

  /* legend */
  .legend { display:flex; flex-wrap:wrap; gap:8px 14px; }
  .legend-item { display:flex; align-items:center; gap:5px; }
  .legend-dot  { width:9px; height:9px; border-radius:50%; flex-shrink:0; }
  .legend-item span   { font-size:11px; color:var(--muted); font-weight:600; }
  .legend-item strong { font-size:11px; color:var(--navy); }

  /* table */
  .cases-table { width:100%; border-collapse:collapse; }
  .cases-table th { font-size:11px; color:var(--muted); font-weight:700; text-transform:uppercase; letter-spacing:.5px; padding:0 10px 10px; text-align:left; border-bottom:2px solid var(--pale); }
  .cases-table td { padding:10px; font-size:13px; color:#333; border-bottom:1px solid rgba(15,57,99,.05); vertical-align:middle; }
  .cases-table tr:last-child td { border-bottom:none; }
  .cases-table tr:hover td { background:var(--pale); }

  /* badges */
  .badge-status, .badge-priority, .badge-channel { display:inline-block; padding:3px 10px; border-radius:99px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.4px; }
  .s-new         { background:#e8f4fd; color:#1f5a8a; }
  .s-assigned    { background:#fff4e0; color:#b06a00; }
  .s-in_progress { background:#e6f9f4; color:#127a5a; }
  .s-pending     { background:#f9f0ff; color:#6a35c2; }
  .s-resolved    { background:#e6f4ea; color:#2e7d32; }
  .s-closed      { background:#f5f5f5; color:#777;    }
  .s-escalated   { background:#fde8e8; color:#c62828; }
  .p-low    { background:#f0f9f0; color:#2d7a3d; }
  .p-medium { background:#fff8e0; color:#a07000; }
  .p-high   { background:#fff0e0; color:#b05000; }
  .p-crisis { background:#fde8e8; color:#c62828; }
  .ch-whatsapp { background:#e6f9ee; color:#1a7a3c; }
  .ch-email    { background:#e8eeff; color:#2040a0; }

  /* quick actions */
  .mhf-actions { display:grid; grid-template-columns:repeat(auto-fit,minmax(90px,1fr)); gap:10px; }
  .mhf-action-btn { background:var(--pale); border:1px solid var(--light); border-radius:var(--r-md); padding:16px 8px; text-align:center; transition:all .2s; text-decoration:none; display:block; }
  .mhf-action-btn:hover { background:var(--navy); border-color:var(--navy); transform:translateY(-2px); box-shadow:var(--sh); }
  .mhf-action-btn:hover i, .mhf-action-btn:hover span { color:#fff !important; }
  .mhf-action-btn i    { font-size:22px; color:var(--navy); display:block; margin-bottom:7px; transition:color .2s; }
  .mhf-action-btn span { font-size:11px; font-weight:600; color:var(--navy); transition:color .2s; }

  /* activity */
  .mhf-act-item { display:flex; align-items:flex-start; gap:11px; padding:9px 0; border-bottom:1px solid rgba(15,57,99,.06); }
  .mhf-act-item:last-child { border-bottom:none; }
  .mhf-dot { width:8px; height:8px; border-radius:50%; margin-top:5px; flex-shrink:0; }
  .dot-g { background:var(--green);  }
  .dot-a { background:var(--amber);  }
  .dot-b { background:var(--mid);    }
  .dot-r { background:var(--red);    }
  .mhf-act-item p     { font-size:13px; color:#444; margin:0 0 2px; line-height:1.4; }
  .mhf-act-item small { font-size:11px; color:var(--muted); }

  @media(max-width:768px) {
    .mhf-welcome { flex-direction:column; align-items:flex-start; }
    .mhf-stats   { grid-template-columns:repeat(2,1fr); }
  }
</style>
@endsection

@section('content')
<div class="pagetitle mb-3">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div>

{{-- Welcome Banner --}}
<div class="mhf-welcome">
  <div style="position:relative;z-index:1">
    <h2>Welcome back, {{ auth()->user()->name }} 👋</h2>
    <p>
      Mental Health Frontline — Admin Panel
      @if($unreadComplaints > 0)
        &nbsp;·&nbsp;
        <span class="complaint-badge">
          <i class="bi bi-bell-fill" style="font-size:11px"></i>
          {{ $unreadComplaints }} unread complaint{{ $unreadComplaints > 1 ? 's' : '' }}
        </span>
      @endif
    </p>
  </div>
  <div class="mhf-welcome-date" style="position:relative;z-index:1">
    {{ now()->format('l, d M Y') }}
    <small>{{ now()->format('H:i') }} · Gaza Time</small>
  </div>
</div>

{{-- Stat Cards --}}
<div class="mhf-stats">
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-blue"><i class="bi bi-people-fill"></i></div>
    <div class="mhf-stat-info">
      <p>Total Cases</p>
      <h3>{{ $totalCases }}</h3>
      <small>Child cases</small>
    </div>
  </div>
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-green"><i class="bi bi-chat-heart-fill"></i></div>
    <div class="mhf-stat-info">
      <p>Follow-ups</p>
      <h3>{{ $totalFollowups }}</h3>
      <small>Total sessions</small>
    </div>
  </div>
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-amber"><i class="bi bi-clock-history"></i></div>
    <div class="mhf-stat-info">
      <p>Pending</p>
      <h3>{{ $pendingCases }}</h3>
      <small>New + assigned</small>
    </div>
  </div>
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-red"><i class="bi bi-heart-pulse-fill"></i></div>
    <div class="mhf-stat-info">
      <p>High Priority</p>
      <h3>{{ $highPriority }}</h3>
      <small>High + crisis</small>
    </div>
  </div>
  <div class="mhf-stat">
    <div class="mhf-stat-icon ic-teal"><i class="bi bi-person-lines-fill"></i></div>
    <div class="mhf-stat-info">
      <p>Contacts</p>
      <h3>{{ $totalContacts }}</h3>
      <small>Registered families</small>
    </div>
  </div>
  @if($unreadComplaints > 0)
  <a href="{{ route('admin.complaints.index') }}" class="mhf-stat" style="border-color:rgba(201,64,64,.25)">
    <div class="mhf-stat-icon ic-red"><i class="bi bi-exclamation-triangle-fill"></i></div>
    <div class="mhf-stat-info">
      <p>Complaints</p>
      <h3 style="color:var(--red)">{{ $unreadComplaints }}</h3>
      <small>Unread</small>
    </div>
  </a>
  @endif
</div>

{{-- Main Grid --}}
<div class="row g-4">

  {{-- Left Column --}}
  <div class="col-lg-8 d-flex flex-column gap-4">

    {{-- Last 7 Days Bar Chart --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5><i class="bi bi-graph-up me-2" style="color:var(--mid)"></i>Cases — Last 7 Days</h5>
      </div>
      @php
        $max7 = collect($last7Days)->max('count');
        $max7 = $max7 > 0 ? $max7 : 1;
      @endphp
      <div style="display:flex; align-items:flex-end; gap:8px; height:120px; padding:0 4px">
        @foreach($last7Days as $day)
          @php
            $barPct = $max7 > 0 ? round(($day['count'] / $max7) * 100) : 0;
            $barPct = max($barPct, 4);
          @endphp
          <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:4px; height:100%; justify-content:flex-end">
            @if($day['count'] > 0)
              <span style="font-size:11px; font-weight:700; color:var(--navy)">{{ $day['count'] }}</span>
            @endif
            <div style="width:100%; height:{{ $barPct }}%; background:linear-gradient(180deg,var(--mid),var(--navy)); border-radius:6px 6px 3px 3px; min-height:4px"></div>
            <span style="font-size:10px; color:var(--muted); white-space:nowrap">{{ $day['label'] }}</span>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Status & Priority Bars --}}
    <div class="row g-3">
      <div class="col-md-6">
        <div class="mhf-card h-100">
          <div class="mhf-card-header">
            <h5><i class="bi bi-ui-checks me-2" style="color:var(--green)"></i>By Status</h5>
          </div>
          @php
            $statusColors = [
              'new'         => '#1f5a8a',
              'assigned'    => '#e08b2a',
              'in_progress' => '#1d9e75',
              'pending'     => '#7c5cbf',
              'resolved'    => '#2e7d32',
              'closed'      => '#9e9e9e',
              'escalated'   => '#c94040',
            ];
            $statusLabels = [
              'new'         => 'New',
              'assigned'    => 'Assigned',
              'in_progress' => 'In Progress',
              'pending'     => 'Pending',
              'resolved'    => 'Resolved',
              'closed'      => 'Closed',
              'escalated'   => 'Escalated',
            ];
            $maxStatus = $casesByStatus->max();
            $maxStatus = $maxStatus > 0 ? $maxStatus : 1;
          @endphp
          <div class="chart-bar-wrap">
            @foreach($statusColors as $sKey => $sColor)
              @php $sVal = $casesByStatus[$sKey] ?? 0; @endphp
              @if($sVal > 0)
              <div class="chart-bar-row">
                <span class="chart-bar-label">{{ $statusLabels[$sKey] }}</span>
                <div class="chart-bar-track">
                  <div class="chart-bar-fill" style="width:{{ round(($sVal/$maxStatus)*100) }}%; background:{{ $sColor }}"></div>
                </div>
                <span class="chart-bar-val">{{ $sVal }}</span>
              </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="mhf-card h-100">
          <div class="mhf-card-header">
            <h5><i class="bi bi-flag-fill me-2" style="color:var(--red)"></i>By Priority</h5>
          </div>
          @php
            $priorityColors = [
              'crisis' => '#c94040',
              'high'   => '#e08b2a',
              'medium' => '#4a85b5',
              'low'    => '#1d9e75',
            ];
            $maxPriority = $casesByPriority->max();
            $maxPriority = $maxPriority > 0 ? $maxPriority : 1;
          @endphp
          <div class="chart-bar-wrap">
            @foreach($priorityColors as $pKey => $pColor)
              @php $pVal = $casesByPriority[$pKey] ?? 0; @endphp
              <div class="chart-bar-row">
                <span class="chart-bar-label" style="text-transform:capitalize">{{ ucfirst($pKey) }}</span>
                <div class="chart-bar-track">
                  <div class="chart-bar-fill" style="width:{{ round(($pVal/$maxPriority)*100) }}%; background:{{ $pColor }}"></div>
                </div>
                <span class="chart-bar-val">{{ $pVal }}</span>
              </div>
            @endforeach
          </div>

          <hr style="margin:14px 0; border-color:var(--pale)">
          <p style="font-size:12px; font-weight:700; color:var(--navy); margin:0 0 8px">
            <i class="bi bi-broadcast me-1" style="color:var(--mid)"></i>Channel Split
          </p>
          @php
            $wa    = $casesByChannel['whatsapp'] ?? 0;
            $email = $casesByChannel['email']    ?? 0;
            $chTotal = $wa + $email;
            $chTotal = $chTotal > 0 ? $chTotal : 1;
          @endphp
          <div style="display:flex; gap:0; height:12px; border-radius:99px; overflow:hidden; margin-bottom:8px">
            @if($wa > 0)
              <div style="flex:{{ $wa }}; background:#1d9e75"></div>
            @endif
            @if($email > 0)
              <div style="flex:{{ $email }}; background:#4a85b5"></div>
            @endif
          </div>
          <div class="legend">
            <div class="legend-item">
              <div class="legend-dot" style="background:#1d9e75"></div>
              <span>WhatsApp</span>
              <strong>{{ $wa }}</strong>
            </div>
            <div class="legend-item">
              <div class="legend-dot" style="background:#4a85b5"></div>
              <span>Email</span>
              <strong>{{ $email }}</strong>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Symptoms Distribution --}}
    @if(!empty($symptomsCount))
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5><i class="bi bi-activity me-2" style="color:#7c5cbf"></i>Symptoms Distribution</h5>
      </div>
      @php
        $symColors = ['#c94040','#e08b2a','#7c5cbf','#1d9e75','#4a85b5','#0f8296'];
        $symVals   = array_values($symptomsCount);
        $maxSym    = !empty($symVals) ? max($symVals) : 1;
        $maxSym    = $maxSym > 0 ? $maxSym : 1;
        $symIdx    = 0;
      @endphp
      <div class="chart-bar-wrap">
        @foreach($symptomsCount as $sym => $cnt)
          <div class="chart-bar-row">
            <span class="chart-bar-label" style="text-transform:capitalize">{{ ucfirst(str_replace('_',' ',$sym)) }}</span>
            <div class="chart-bar-track">
              <div class="chart-bar-fill" style="width:{{ round(($cnt/$maxSym)*100) }}%; background:{{ $symColors[$symIdx % 6] }}"></div>
            </div>
            <span class="chart-bar-val">{{ $cnt }}</span>
          </div>
          @php $symIdx++ @endphp
        @endforeach
      </div>
    </div>
    @endif

    {{-- Recent Cases Table --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5><i class="bi bi-table me-2" style="color:var(--navy)"></i>Recent Cases</h5>
        <a href="{{ route('admin.cases.index') }}">View all →</a>
      </div>
      @if($recentCases->isEmpty())
        <p style="color:var(--muted); font-size:13px; text-align:center; padding:20px 0">No cases yet.</p>
      @else
        <div style="overflow-x:auto">
          <table class="cases-table">
            <thead>
              <tr>
                <th>Ref</th>
                <th>Child</th>
                <th>Guardian</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Channel</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentCases as $c)
              <tr>
                <td>
                  <a href="{{ route('admin.cases.show', $c->id) }}" style="font-weight:700; color:var(--navy); text-decoration:none; font-size:12px">
                    {{ $c->case_number }}
                  </a>
                </td>
                <td>
                  <span style="font-weight:600">{{ $c->child_name }}</span>
                  <br><small style="color:var(--muted)">Age {{ $c->child_age }}</small>
                </td>
                <td style="color:var(--muted)">{{ $c->guardian_name }}</td>
                <td><span class="badge-status s-{{ $c->status }}">{{ str_replace('_',' ',$c->status) }}</span></td>
                <td><span class="badge-priority p-{{ $c->priority }}">{{ $c->priority }}</span></td>
                <td><span class="badge-channel ch-{{ $c->channel }}">{{ $c->channel }}</span></td>
                <td style="color:var(--muted); font-size:12px">{{ \Carbon\Carbon::parse($c->created_at)->format('d M Y') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>

  </div>{{-- end left col --}}

  {{-- Right Column --}}
  <div class="col-lg-4 d-flex flex-column gap-4">

    {{-- Quick Actions --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5><i class="bi bi-lightning-charge-fill me-2" style="color:var(--amber)"></i>Quick Actions</h5>
      </div>
      <div class="mhf-actions">
        <a href="{{ route('admin.cases.index') }}" class="mhf-action-btn">
          <i class="bi bi-folder2-open"></i><span>All Cases</span>
        </a>
        <a href="{{ route('admin.complaints.index') }}" class="mhf-action-btn">
          <i class="bi bi-exclamation-circle"></i><span>Complaints</span>
        </a>
        <a href="{{ route('admin.bank.edit') }}" class="mhf-action-btn">
          <i class="bi bi-bank"></i><span>Bank</span>
        </a>
        <a href="{{ route('admin.doctors.index') }}" class="mhf-action-btn">
          <i class="bi bi-person-badge"></i><span>Doctors</span>
        </a>
      </div>
    </div>

    {{-- Priority Donut --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5><i class="bi bi-pie-chart-fill me-2" style="color:var(--mid)"></i>Priority Overview</h5>
      </div>
      @php
        $dCrisis = (int)($casesByPriority['crisis'] ?? 0);
        $dHigh   = (int)($casesByPriority['high']   ?? 0);
        $dMed    = (int)($casesByPriority['medium']  ?? 0);
        $dLow    = (int)($casesByPriority['low']     ?? 0);
        $dTotal  = $dCrisis + $dHigh + $dMed + $dLow;

        $donutR   = 45;
        $donutC   = 2 * 3.14159 * $donutR;

        $donutSegs = [
          ['val' => $dCrisis, 'color' => '#c94040', 'label' => 'Crisis'],
          ['val' => $dHigh,   'color' => '#e08b2a', 'label' => 'High'],
          ['val' => $dMed,    'color' => '#4a85b5', 'label' => 'Medium'],
          ['val' => $dLow,    'color' => '#1d9e75', 'label' => 'Low'],
        ];

        $donutOffset = 0;
      @endphp
      <div class="donut-wrap">
        <svg width="120" height="120" viewBox="0 0 120 120">
          @if($dTotal == 0)
            <circle cx="60" cy="60" r="45" fill="none" stroke="#e8f4fd" stroke-width="14"/>
          @else
            @foreach($donutSegs as $seg)
              @php
                $segPct  = $seg['val'] / $dTotal;
                $segDash = round($segPct * $donutC, 2);
                $segGap  = round($donutC - $segDash, 2);
                $segOff  = round(-$donutOffset * $donutC, 2);
                $donutOffset += $segPct;
              @endphp
              @if($seg['val'] > 0)
              <circle
                cx="60" cy="60" r="45"
                fill="none"
                stroke="{{ $seg['color'] }}"
                stroke-width="14"
                stroke-dasharray="{{ $segDash }} {{ $segGap }}"
                stroke-dashoffset="{{ $segOff }}"
                transform="rotate(-90 60 60)"
              />
              @endif
            @endforeach
          @endif
        </svg>
        <div class="donut-center">
          <span>{{ $dTotal > 0 ? $dTotal : '—' }}</span>
          <small>cases</small>
        </div>
      </div>
      <div class="legend">
        @foreach($donutSegs as $seg)
        <div class="legend-item">
          <div class="legend-dot" style="background:{{ $seg['color'] }}"></div>
          <span>{{ $seg['label'] }}</span>
          <strong>{{ $seg['val'] }}</strong>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Recent Activity --}}
    <div class="mhf-card">
      <div class="mhf-card-header">
        <h5><i class="bi bi-clock-history me-2" style="color:var(--green)"></i>Recent Activity</h5>
      </div>
      @if($recentActivity->isNotEmpty())
        @foreach($recentActivity as $act)
          <div class="mhf-act-item">
            <div class="mhf-dot dot-b"></div>
            <div>
              <p>{{ $act->action }}</p>
              <small>{{ \Carbon\Carbon::parse($act->created_at)->diffForHumans() }}</small>
            </div>
          </div>
        @endforeach
      @elseif($recentCases->isNotEmpty())
        @foreach($recentCases->take(5) as $rc)
          @php
            $dotClass = $rc->priority === 'crisis' ? 'dot-r' : ($rc->priority === 'high' ? 'dot-a' : 'dot-b');
          @endphp
          <div class="mhf-act-item">
            <div class="mhf-dot {{ $dotClass }}"></div>
            <div>
              <p>New case: {{ $rc->child_name }} ({{ $rc->case_number }})</p>
              <small>{{ \Carbon\Carbon::parse($rc->created_at)->diffForHumans() }}</small>
            </div>
          </div>
        @endforeach
      @else
        <p style="color:var(--muted); font-size:13px">No recent activity.</p>
      @endif
    </div>

    {{-- Complaints Alert --}}
    @if($unreadComplaints > 0)
    <div class="mhf-card" style="border-color:rgba(201,64,64,.3)">
      <div class="mhf-card-header">
        <h5 style="color:var(--red)"><i class="bi bi-bell-fill me-2"></i>Unread Complaints</h5>
        <a href="{{ route('admin.complaints.index') }}" style="color:var(--red)">Review →</a>
      </div>
      <div style="display:flex; align-items:center; gap:14px; padding:6px 0">
        <div style="width:54px; height:54px; border-radius:50%; background:rgba(201,64,64,.1); display:flex; align-items:center; justify-content:center; flex-shrink:0">
          <span style="font-family:'Nunito',sans-serif; font-size:22px; font-weight:800; color:var(--red)">{{ $unreadComplaints }}</span>
        </div>
        <p style="font-size:13px; color:#555; margin:0; line-height:1.5">
          You have <strong>{{ $unreadComplaints }}</strong> unread complaint{{ $unreadComplaints > 1 ? 's' : '' }} waiting for your review.
        </p>
      </div>
    </div>
    @endif

  </div>{{-- end right col --}}
</div>
@endsection