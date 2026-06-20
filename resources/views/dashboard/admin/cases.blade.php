@extends('dashboard.layouts.master')

@section('title', 'Cases Management')

@section('content')

<style>
:root {
    --navy: #0d2849;
    --navy-light: #163a66;
    --green: #22c55e;
    --amber: #f59e0b;
    --red: #ef4444;
    --crisis: #7c3aed;
    --blue: #3b82f6;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-400: #9ca3af;
    --gray-600: #4b5563;
    --gray-800: #1f2937;
}

.filters-bar {
    background: #fff;
    border: 1.5px solid var(--gray-200);
    border-radius: 14px;
    padding: 14px 18px;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}
.filter-search {
    flex: 1;
    min-width: 200px;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1.5px solid var(--gray-200);
    border-radius: 10px;
    padding: 8px 12px;
    background: var(--gray-50);
    transition: border-color 0.2s;
}
.filter-search:focus-within { border-color: var(--navy); }
.filter-search input {
    border: none; outline: none; background: transparent;
    font-size: 13px; color: var(--gray-800); width: 100%; min-width: 0;
}
.filter-search i { color: var(--gray-400); font-size: 13px; }
.filter-select {
    border: 1.5px solid var(--gray-200); border-radius: 10px;
    padding: 8px 12px; font-size: 12.5px; color: var(--gray-800);
    background: var(--gray-50); outline: none; cursor: pointer;
    transition: border-color 0.2s; font-family: inherit;
}
.filter-select:focus { border-color: var(--navy); }
.btn-filter-reset {
    background: none; border: 1.5px solid var(--gray-200);
    border-radius: 10px; padding: 8px 14px; font-size: 12px;
    color: var(--gray-600); cursor: pointer; transition: 0.2s;
    font-family: inherit; white-space: nowrap;
}
.btn-filter-reset:hover { border-color: var(--red); color: var(--red); }

.badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px; border-radius: 50px;
    font-size: 11px; font-weight: 700; white-space: nowrap;
}
.badge-new      { background: #eff6ff; color: var(--blue); }
.badge-assigned { background: #faf5ff; color: #7c3aed; }
.badge-progress { background: #fffbeb; color: var(--amber); }
.badge-resolved { background: #f0fdf4; color: var(--green); }
.badge-closed   { background: var(--gray-100); color: var(--gray-600); }

.priority-dot { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; }
.priority-dot::before { content: ''; width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
.priority-dot.low    { color: var(--green); } .priority-dot.low::before    { background: var(--green); }
.priority-dot.medium { color: var(--amber); } .priority-dot.medium::before { background: var(--amber); }
.priority-dot.high   { color: var(--red);   } .priority-dot.high::before   { background: var(--red); }
.priority-dot.crisis { color: var(--crisis);} .priority-dot.crisis::before { background: var(--crisis); }

.channel-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 6px; }
.channel-wa    { background: #dcfce7; color: #16a34a; }
.channel-email { background: #eff6ff; color: var(--blue); }

.impact-pill { display: inline-block; width: 8px; height: 8px; border-radius: 50%; }
.impact-1 { background: var(--green); }
.impact-2 { background: var(--amber); }
.impact-3 { background: var(--red); }

.child-cell-name { font-weight: 700; font-size: 13px; color: var(--navy); }
.child-cell-meta { font-size: 11px; color: var(--gray-400); }

.ref-num {
    font-size: 11px; font-weight: 700; color: var(--navy);
    background: #eef2ff; padding: 3px 8px; border-radius: 6px; letter-spacing: 0.3px;
}

.btn-view-case {
    display: inline-flex; align-items: center; gap: 5px;
    background: var(--navy); color: #fff; padding: 6px 12px;
    border-radius: 8px; font-size: 11.5px; font-weight: 600;
    text-decoration: none; transition: 0.2s; white-space: nowrap;
}
.btn-view-case:hover { background: var(--navy-light); color: #fff; }

/* ── Table wrapper with horizontal scroll ── */
.cases-table-wrap {
    background: #fff;
    border: 1.5px solid var(--gray-200);
    border-radius: 16px;
    overflow: hidden;
}
.table-scroll {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.cases-table {
    width: 100%;
    min-width: 700px; /* يكفي يظهر كل الأعمدة */
    border-collapse: collapse;
    font-size: 13px;
}
.cases-table thead th {
    background: var(--gray-50); padding: 11px 14px; text-align: left;
    font-size: 11px; font-weight: 700; color: var(--gray-400);
    text-transform: uppercase; letter-spacing: 0.4px;
    border-bottom: 1.5px solid var(--gray-200); white-space: nowrap;
}
.cases-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.15s; cursor: pointer; }
.cases-table tbody tr:last-child { border-bottom: none; }
.cases-table tbody tr:hover { background: #f0f4ff; }
.cases-table tbody td { padding: 12px 14px; color: var(--gray-800); vertical-align: middle; }

.empty-state { text-align: center; padding: 60px 20px; color: var(--gray-400); }
.empty-state i { font-size: 40px; margin-bottom: 12px; display: block; }
.empty-state p { font-size: 14px; }

.pagination-wrap {
    padding: 14px 18px; border-top: 1.5px solid var(--gray-200);
    display: flex; align-items: center; justify-content: space-between;
    font-size: 12.5px; color: var(--gray-600); flex-wrap: wrap; gap: 8px;
}
.pagination-wrap .pagination { display: flex; gap: 4px; list-style: none; margin: 0; padding: 0; }
.pagination-wrap .page-item .page-link {
    padding: 6px 11px; border: 1.5px solid var(--gray-200); border-radius: 8px;
    font-size: 12px; font-weight: 600; color: var(--navy); text-decoration: none; transition: 0.15s; display: block;
}
.pagination-wrap .page-item.active .page-link  { background: var(--navy); border-color: var(--navy); color: #fff; }
.pagination-wrap .page-item.disabled .page-link { color: var(--gray-400); cursor: not-allowed; }
.pagination-wrap .page-item .page-link:hover:not(.active) { border-color: var(--navy); }

/* ── Mobile tweaks ── */
@media (max-width: 576px) {
    .filters-bar { flex-direction: column; padding: 12px; gap: 8px; }
    .filter-search { min-width: unset; width: 100%; }
    .filter-select { width: 100%; }
    .btn-filter-reset { width: 100%; text-align: center; }
    .pagination-wrap { flex-direction: column; align-items: flex-start; }
}
</style>

<div class="pagetitle">
    <h1>Cases</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Cases</li>
        </ol>
    </nav>
</div>

<div class="filters-bar">
    <div class="filter-search">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Search by child name, ref, or guardian..." value="{{ request('search') }}">
        <button onclick="applyFilters()" style="background:none;border:none;cursor:pointer;color:var(--navy);font-size:13px;font-weight:600;white-space:nowrap;padding:0 4px;">
            Search
        </button>
    </div>
    <select class="filter-select" id="filterStatus">
        <option value="">All Statuses</option>
        <option value="new"         {{ request('status')=='new'         ? 'selected':'' }}>New</option>
        <option value="assigned"    {{ request('status')=='assigned'    ? 'selected':'' }}>Assigned</option>
        <option value="in_progress" {{ request('status')=='in_progress' ? 'selected':'' }}>In Progress</option>
    </select>
    <select class="filter-select" id="filterPriority">
        <option value="">All Priorities</option>
        <option value="crisis" {{ request('priority')=='crisis' ? 'selected':'' }}>Crisis</option>
        <option value="high"   {{ request('priority')=='high'   ? 'selected':'' }}>High</option>
        <option value="medium" {{ request('priority')=='medium' ? 'selected':'' }}>Medium</option>
        <option value="low"    {{ request('priority')=='low'    ? 'selected':'' }}>Low</option>
    </select>
    <select class="filter-select" id="filterChannel">
        <option value="">All Channels</option>
        <option value="whatsapp" {{ request('channel')=='whatsapp' ? 'selected':'' }}>WhatsApp</option>
        <option value="email"    {{ request('channel')=='email'    ? 'selected':'' }}>Email</option>
    </select>
    <button class="btn-filter-reset" onclick="resetFilters()">
        <i class="fas fa-rotate-left"></i> Reset
    </button>
</div>

<div class="cases-table-wrap">
    <div class="table-scroll">
        <table class="cases-table" id="casesTable">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Child</th>
                    <th>Guardian</th>
                    <th>Channel</th>
                    <th>Symptoms / Impact</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($cases as $case)
                @php
                    $symptomsArr = is_string($case->symptoms) ? json_decode($case->symptoms, true) : (array)$case->symptoms;
                    $symptomsArr = $symptomsArr ?: [];
                    $symptomLabels = [
                        'sleep'=>'Sleep Issues','anxiety'=>'Anxiety','sadness'=>'Sadness',
                        'aggression'=>'Aggression','withdrawal'=>'Withdrawal',
                        'school'=>'School Issues','appetite'=>'Appetite','concentration'=>'Poor Focus',
                    ];
                    $symptomText = collect($symptomsArr)->map(fn($s)=>$symptomLabels[$s]??$s)->take(2)->join(', ');
                    if(count($symptomsArr)>2) $symptomText .= ' +' . (count($symptomsArr)-2);
                    $statusClass = ['new'=>'badge-new','assigned'=>'badge-assigned','in_progress'=>'badge-progress','resolved'=>'badge-resolved','closed'=>'badge-closed'][$case->status] ?? 'badge-new';
                    $statusIcon  = ['new'=>'fa-circle','assigned'=>'fa-user-check','in_progress'=>'fa-spinner','resolved'=>'fa-circle-check','closed'=>'fa-lock'][$case->status] ?? 'fa-circle';
                @endphp
                <tr onclick="window.location='{{ route('admin.cases.show', $case->id) }}'">
                    <td><span class="ref-num">{{ $case->case_number }}</span></td>
                    <td>
                        <div class="child-cell-name">{{ $case->child_name }}</div>
                        <div class="child-cell-meta">Age {{ $case->child_age }}@if($case->child_grade) · {{ $case->child_grade }}@endif · {{ ucfirst($case->child_gender) }}</div>
                    </td>
                    <td>
                        <div style="font-weight:600;font-size:13px">{{ $case->guardian_name }}</div>
                        <div style="font-size:11px;color:var(--gray-400)">{{ $case->guardian_phone }}</div>
                    </td>
                    <td>
                        @if($case->channel==='whatsapp')
                            <span class="channel-badge channel-wa"><i class="fab fa-whatsapp"></i> WhatsApp</span>
                        @else
                            <span class="channel-badge channel-email"><i class="far fa-envelope"></i> Email</span>
                        @endif
                    </td>
                    <td>
                        <div style="font-size:12px;color:var(--gray-600);max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $symptomText ?: '—' }}</div>
                        <div style="margin-top:4px;display:flex;align-items:center;gap:5px;font-size:11px;color:var(--gray-400)">
                            <span class="impact-pill impact-{{ $case->impact_level }}"></span>
                            {{ ['1'=>'Mild','2'=>'Noticeable','3'=>'Severe'][$case->impact_level] ?? '—' }}
                        </div>
                    </td>
                    <td><span class="priority-dot {{ $case->priority }}">{{ ucfirst($case->priority) }}</span></td>
                    <td>
                        <span class="badge {{ $statusClass }}">
                            <i class="fas {{ $statusIcon }}" style="font-size:9px"></i>
                            {{ ucwords(str_replace('_',' ',$case->status)) }}
                        </span>
                    </td>
                    <td style="font-size:12px;color:var(--gray-400);white-space:nowrap">
                        {{ \Carbon\Carbon::parse($case->created_at)->format('M d, Y') }}
                    </td>
                    <td onclick="event.stopPropagation()">
                        <a href="{{ route('admin.cases.show', $case->id) }}" class="btn-view-case">
                            <i class="fas fa-eye" style="font-size:11px"></i> View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <i class="fas fa-folder-open"></i>
                            <p>No cases found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($cases->hasPages())
    <div class="pagination-wrap">
        <span>Showing {{ $cases->firstItem() }}–{{ $cases->lastItem() }} of {{ $cases->total() }} cases</span>
        {{ $cases->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<script>
const searchInput    = document.getElementById('searchInput');
const filterStatus   = document.getElementById('filterStatus');
const filterPriority = document.getElementById('filterPriority');
const filterChannel  = document.getElementById('filterChannel');

function applyFilters() {
    const params = new URLSearchParams();
    if (searchInput.value.trim())  params.set('search',   searchInput.value.trim());
    if (filterStatus.value)        params.set('status',   filterStatus.value);
    if (filterPriority.value)      params.set('priority', filterPriority.value);
    if (filterChannel.value)       params.set('channel',  filterChannel.value);
    window.location.href = '{{ route("admin.cases.index") }}?' + params.toString();
}

searchInput.addEventListener('keydown', e => { if (e.key === 'Enter') applyFilters(); });
filterStatus.addEventListener('change',   applyFilters);
filterPriority.addEventListener('change', applyFilters);
filterChannel.addEventListener('change',  applyFilters);

function resetFilters() {
    window.location.href = '{{ route("admin.cases.index") }}';
}
</script>

@endsection