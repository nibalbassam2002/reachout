@extends('dashboard.layouts.master')

@section('title', 'Case — ' . $case->case_number)

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

/* ── Layout ── */
.case-layout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 20px;
    align-items: start;
}
@media (max-width: 1024px) {
    .case-layout {
        grid-template-columns: 1fr;
    }
    .sidebar-sticky {
        position: static !important;
    }
}
@media (max-width: 640px) {
    .info-grid.triple {
        grid-template-columns: 1fr 1fr !important;
    }
    .info-grid {
        grid-template-columns: 1fr !important;
    }
    .case-hero {
        padding: 16px !important;
    }
    .hero-name {
        font-size: 15px !important;
    }
    .hero-badges {
        gap: 6px !important;
    }
    .hero-badge {
        font-size: 11px !important;
        padding: 4px 10px !important;
    }
    .card-body {
        padding: 14px !important;
    }
    .guardian-row {
        flex-wrap: wrap;
        gap: 10px !important;
    }
    .btn-wa-contact {
        margin-left: 0 !important;
        width: 100%;
        justify-content: center;
    }
}

/* ── Cards ── */
.card-section {
    background: #fff;
    border: 1.5px solid var(--gray-200);
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 18px;
}
.card-section:last-child { margin-bottom: 0; }
.card-header {
    padding: 14px 20px;
    border-bottom: 1.5px solid var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
}
.card-header h3 {
    font-size: 14px;
    font-weight: 700;
    color: var(--navy);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.card-header h3 i { font-size: 13px; color: var(--gray-400); }
.card-body { padding: 20px; }

/* ── Case Hero ── */
.case-hero {
    background: linear-gradient(135deg, var(--navy) 0%, #1a3f72 100%);
    border-radius: 16px;
    padding: 24px;
    color: #fff;
    margin-bottom: 18px;
    position: relative;
    overflow: hidden;
}
.case-hero::after {
    content: '';
    position: absolute;
    right: -20px; top: -20px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    pointer-events: none;
}
.case-hero-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}
.case-hero-child {
    display: flex;
    align-items: center;
    gap: 14px;
}
.hero-avatar {
    width: 52px; height: 52px;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; font-weight: 800; color: #fff;
    border: 2px solid rgba(255,255,255,0.2);
    flex-shrink: 0;
}
.hero-name { font-size: 18px; font-weight: 800; margin-bottom: 4px; }
.hero-meta { font-size: 12px; opacity: 0.7; }
.hero-ref {
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.5px;
    white-space: nowrap;
}
.hero-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    border: 1.5px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.1);
    color: #fff;
}
.hero-badge.impact-severe   { background: rgba(239,68,68,0.3);  border-color: rgba(239,68,68,0.5); }
.hero-badge.impact-noticeable { background: rgba(245,158,11,0.3); border-color: rgba(245,158,11,0.5); }
.hero-badge.impact-mild     { background: rgba(34,197,94,0.3);  border-color: rgba(34,197,94,0.5); }

/* ── Info Grid ── */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}
.info-grid.triple { grid-template-columns: 1fr 1fr 1fr; }
@media (max-width: 768px) {
    .info-grid.triple { grid-template-columns: 1fr 1fr; }
}
.info-item { display: flex; flex-direction: column; gap: 3px; }
.info-item .info-lbl {
    font-size: 10.5px;
    font-weight: 700;
    color: var(--gray-400);
    text-transform: uppercase;
    letter-spacing: 0.4px;
}
.info-item .info-val {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--gray-800);
}

/* ── Symptoms tags ── */
.symptom-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}
.symptom-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #eef2ff;
    color: var(--navy);
    padding: 5px 11px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
}
.symptom-tag i { font-size: 12px; }

/* ── Notes block — FIXED ── */
.notes-block {
    background: var(--gray-50);
    border: 1.5px solid var(--gray-200);
    border-radius: 12px;
    padding: 14px 16px;
    font-size: 13px;
    color: var(--gray-800);
    line-height: 1.8;
    /* FIX: remove pre-wrap, use normal white-space with preserved line breaks */
    white-space: normal;
    word-break: break-word;
    overflow-wrap: break-word;
    overflow-x: hidden;
    max-width: 100%;
    direction: auto;
}

/* ── Guardian contact ── */
.guardian-row {
    display: flex;
    align-items: center;
    gap: 12px;
}
.guardian-avatar {
    width: 42px; height: 42px;
    border-radius: 50%;
    background: #f0fdf4;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 800; color: #16a34a;
    border: 2px solid #dcfce7;
    flex-shrink: 0;
}
.guardian-info .g-name { font-size: 14px; font-weight: 700; color: var(--gray-800); }
.guardian-info .g-meta { font-size: 12px; color: var(--gray-400); }
.btn-wa-contact {
    margin-left: auto;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #25d366;
    color: #fff;
    padding: 7px 14px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: 0.2s;
    white-space: nowrap;
}
.btn-wa-contact:hover { background: #1ebe5d; color: #fff; }

/* ── Right Sidebar ── */
.sidebar-sticky { position: sticky; top: 20px; }

/* ── Status Update ── */
.status-form .form-group { margin-bottom: 14px; }
.status-form label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: var(--gray-400);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-bottom: 6px;
}
.status-form select,
.status-form textarea,
.status-form input[type="number"] {
    width: 100%;
    border: 1.5px solid var(--gray-200);
    border-radius: 10px;
    padding: 9px 12px;
    font-size: 13px;
    color: var(--gray-800);
    background: var(--gray-50);
    outline: none;
    font-family: inherit;
    transition: border-color 0.2s;
    box-sizing: border-box;
}
.status-form select:focus,
.status-form textarea:focus { border-color: var(--navy); background: #fff; }
.status-form textarea {
    resize: vertical;
    min-height: 90px;
    word-break: break-word;
    overflow-wrap: break-word;
}

/* ── Star rating ── */
.star-group {
    display: flex;
    gap: 4px;
}
.star-btn {
    font-size: 22px;
    color: var(--gray-200);
    cursor: pointer;
    transition: color 0.1s, transform 0.1s;
    background: none;
    border: none;
    padding: 0;
    line-height: 1;
}
.star-btn.active { color: #fbbf24; }
.star-btn:hover  { transform: scale(1.15); color: #fbbf24; }

/* ── Save button ── */
.btn-save {
    width: 100%;
    background: var(--navy);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: inherit;
}
.btn-save:hover { background: var(--navy-light); }
.btn-save:disabled { background: var(--gray-400); cursor: not-allowed; }

/* ── Follow-ups timeline ── */
.followup-item {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--gray-100);
}
.followup-item:last-child { border-bottom: none; }
.followup-dot {
    width: 32px; height: 32px;
    background: #eef2ff;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    font-size: 12px;
    color: var(--navy);
}
.followup-content {
    flex: 1;
    min-width: 0; /* FIX: prevents flex child overflow */
}
.followup-content .fu-note {
    font-size: 12.5px;
    color: var(--gray-800);
    line-height: 1.6;
    word-break: break-word;
    overflow-wrap: break-word;
}
.followup-content .fu-date {
    font-size: 11px;
    color: var(--gray-400);
    margin-top: 3px;
}
.empty-followups {
    text-align: center;
    padding: 24px;
    color: var(--gray-400);
    font-size: 13px;
}
.empty-followups i { display: block; font-size: 24px; margin-bottom: 8px; }

/* ── Badges ── */
.badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 11px; border-radius: 50px; font-size: 11px; font-weight: 700; }
.badge-new      { background: #eff6ff; color: var(--blue); }
.badge-assigned { background: #faf5ff; color: #7c3aed; }
.badge-progress { background: #fffbeb; color: var(--amber); }
.badge-resolved { background: #f0fdf4; color: var(--green); }
.badge-closed   { background: var(--gray-100); color: var(--gray-600); }

.priority-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 11px; border-radius: 50px; font-size: 11px; font-weight: 700;
}
.prio-crisis { background: #f5f3ff; color: var(--crisis); }
.prio-high   { background: #fef2f2; color: var(--red); }
.prio-medium { background: #fffbeb; color: var(--amber); }
.prio-low    { background: #f0fdf4; color: var(--green); }

/* ── Alert toast ── */
.save-toast {
    position: fixed;
    bottom: 24px; right: 24px;
    background: #111827;
    color: #fff;
    padding: 12px 20px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    display: flex; align-items: center; gap: 8px;
    z-index: 9999;
    transform: translateY(80px);
    opacity: 0;
    transition: 0.3s cubic-bezier(0.16,1,0.3,1);
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    max-width: calc(100vw - 48px);
}
.save-toast.show { transform: translateY(0); opacity: 1; }
.save-toast.success i { color: var(--green); }
.save-toast.error   i { color: var(--red); }

/* ── Back link ── */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--gray-600);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 18px;
    transition: color 0.2s;
}
.back-link:hover { color: var(--navy); }

.channel-badge {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11px; font-weight: 600;
    padding: 3px 8px; border-radius: 6px;
}
.channel-wa    { background: #dcfce7; color: #16a34a; }
.channel-email { background: #eff6ff; color: var(--blue); }

/* ── Global overflow protection ── */
* { box-sizing: border-box; }
.case-layout > * { min-width: 0; }
</style>

<!-- Breadcrumb -->
<div class="pagetitle">
    <h1>Case Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.cases.index') }}">Cases</a></li>
            <li class="breadcrumb-item active">{{ $case->case_number }}</li>
        </ol>
    </nav>
</div>


<div style="display:flex; align-items:center; gap:12px; margin-bottom:18px">
    <a href="{{ route('admin.cases.index') }}" class="back-link" style="margin-bottom:0">
        <i class="fas fa-arrow-left" style="font-size:12px"></i> Back to Cases
    </a>

    <form action="{{ route('admin.cases.destroy', $case->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to delete this case? This action cannot be undone.')">
        @csrf
        @method('DELETE')
        <button type="submit" style="
            display:inline-flex; align-items:center; gap:6px;
            background:#fef2f2; color:#ef4444;
            border:1.5px solid #fecaca; border-radius:10px;
            padding:7px 14px; font-size:13px; font-weight:600;
            cursor:pointer; transition:0.2s; font-family:inherit;
        "
        onmouseover="this.style.background='#ef4444';this.style.color='#fff'"
        onmouseout="this.style.background='#fef2f2';this.style.color='#ef4444'">
            <i class="fas fa-trash" style="font-size:11px"></i> Delete Case
        </button>
    </form>
</div>
@php
    $symptomsArr = is_string($case->symptoms) ? json_decode($case->symptoms, true) : (array)$case->symptoms;
    $symptomsArr = $symptomsArr ?: [];
    $symptomMeta = [
        'sleep'         => ['label'=>'Sleep Issues',   'icon'=>'fa-bed'],
        'anxiety'       => ['label'=>'Anxiety',        'icon'=>'fa-brain'],
        'sadness'       => ['label'=>'Sadness',        'icon'=>'fa-face-sad-tear'],
        'aggression'    => ['label'=>'Aggression',     'icon'=>'fa-fire'],
        'withdrawal'    => ['label'=>'Withdrawal',     'icon'=>'fa-person-shelter'],
        'school'        => ['label'=>'School Issues',  'icon'=>'fa-graduation-cap'],
        'appetite'      => ['label'=>'Appetite Change','icon'=>'fa-utensils'],
        'concentration' => ['label'=>'Poor Focus',     'icon'=>'fa-magnifying-glass'],
    ];
    $impactLabel = ['1'=>'Mild','2'=>'Noticeable','3'=>'Severe'][$case->impact_level] ?? '—';
    $impactClass = ['1'=>'impact-mild','2'=>'impact-noticeable','3'=>'impact-severe'][$case->impact_level] ?? '';
    $statusClass = ['new'=>'badge-new','assigned'=>'badge-assigned','in_progress'=>'badge-progress','resolved'=>'badge-resolved','closed'=>'badge-closed'][$case->status] ?? 'badge-new';
    $prioClass   = ['crisis'=>'prio-crisis','high'=>'prio-high','medium'=>'prio-medium','low'=>'prio-low'][$case->priority] ?? 'prio-low';
    $initials = collect(explode(' ', $case->child_name))->map(fn($w) => strtoupper($w[0] ?? ''))->take(2)->join('');
    $guardianInitials = collect(explode(' ', $case->guardian_name))->map(fn($w) => strtoupper($w[0] ?? ''))->take(2)->join('');
@endphp

<!-- Hero -->
<div class="case-hero">
    <div class="case-hero-top">
        <div class="case-hero-child">
            <div>
                <div class="hero-name">{{ $case->child_name }}</div>
                <div class="hero-meta">
                    Age {{ $case->child_age }}
                    @if($case->child_grade) · {{ $case->child_grade }} @endif
                    · {{ ucfirst($case->child_gender) }}
                </div>
            </div>
        </div>
        <div class="hero-ref">{{ $case->case_number }}</div>
    </div>
    <div class="hero-badges">
        <span class="hero-badge {{ $impactClass }}">
            <i class="fas fa-chart-bar" style="font-size:10px"></i>
            {{ $impactLabel }} Impact
        </span>
        @if($case->channel === 'whatsapp')
            <span class="hero-badge"><i class="fab fa-whatsapp"></i> WhatsApp</span>
        @else
            <span class="hero-badge"><i class="far fa-envelope"></i> Email</span>
        @endif
        <span class="hero-badge">
            <i class="fas fa-calendar" style="font-size:10px"></i>
            {{ \Carbon\Carbon::parse($case->created_at)->format('M d, Y') }}
        </span>
    </div>
</div>

<div class="case-layout">

    <!-- ═══ LEFT COLUMN ═══ -->
    <div>

        <!-- Child Info -->
        <div class="card-section">
            <div class="card-header">
                <h3><i class="fas fa-child"></i> Child Information</h3>
            </div>
            <div class="card-body">
                <div class="info-grid triple">
                    <div class="info-item">
                        <span class="info-lbl">Full Name</span>
                        <span class="info-val">{{ $case->child_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-lbl">Age</span>
                        <span class="info-val">{{ $case->child_age }} years old</span>
                    </div>
                    <div class="info-item">
                        <span class="info-lbl">Gender</span>
                        <span class="info-val">{{ ucfirst($case->child_gender) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-lbl">School Grade</span>
                        <span class="info-val">{{ $case->child_grade ?: '—' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-lbl">Impact Level</span>
                        <span class="info-val">{{ $impactLabel }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-lbl">Channel</span>
                        <span class="info-val">
                            @if($case->channel === 'whatsapp')
                                <span class="channel-badge channel-wa"><i class="fab fa-whatsapp"></i> WhatsApp</span>
                            @else
                                <span class="channel-badge channel-email"><i class="far fa-envelope"></i> Email</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guardian Info -->
        <div class="card-section">
            <div class="card-header">
                <h3><i class="fas fa-user-shield"></i> Guardian / Parent</h3>
            </div>
            <div class="card-body">
                <div class="guardian-row" style="margin-bottom:16px">
                    <div class="guardian-avatar">{{ $guardianInitials }}</div>
                    <div class="guardian-info">
                        <div class="g-name">{{ $case->guardian_name }}</div>
                        <div class="g-meta">{{ ucfirst($case->guardian_relation ?? '—') }}</div>
                    </div>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-lbl">Phone Number</span>
                        <span class="info-val">{{ $case->guardian_phone }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-lbl">Relationship</span>
                        <span class="info-val">{{ ucfirst($case->guardian_relation ?? '—') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Symptoms -->
        <div class="card-section">
            <div class="card-header">
                <h3><i class="fas fa-stethoscope"></i> Observed Symptoms</h3>
            </div>
            <div class="card-body">
                <div class="symptom-tags" style="margin-bottom: {{ $case->extra_symptom ? '12px' : '0' }}">
                    @forelse($symptomsArr as $sym)
                        @php $meta = $symptomMeta[$sym] ?? ['label'=>ucfirst($sym),'icon'=>'fa-circle']; @endphp
                        <span class="symptom-tag">
                            <i class="fas {{ $meta['icon'] }}"></i> {{ $meta['label'] }}
                        </span>
                    @empty
                        <span style="color:var(--gray-400);font-size:13px">No symptoms recorded</span>
                    @endforelse
                </div>
                @if($case->extra_symptom)
                    <div style="margin-top:10px;background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:10px;padding:10px 14px;font-size:13px;color:var(--gray-600);word-break:break-word;overflow-wrap:break-word;">
                        <span style="font-weight:700;color:var(--navy);font-size:11px;text-transform:uppercase;letter-spacing:0.4px;display:block;margin-bottom:4px">Additional Symptom</span>
                        {{ $case->extra_symptom }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Guardian Notes -->
        <div class="card-section">
            <div class="card-header">
                <h3><i class="fas fa-file-lines"></i> Guardian's Description</h3>
            </div>
            <div class="card-body">
                <div class="notes-block">{{ $case->notes }}</div>
            </div>
        </div>

        <!-- Doctor's Note (read only display) -->
        @if($case->doctor_note)
        <div class="card-section">
            <div class="card-header">
                <h3><i class="fas fa-user-doctor"></i> Doctor's Assessment</h3>
                @if($case->doctor_rating)
                <div style="display:flex;gap:3px">
                    @for($i=1;$i<=5;$i++)
                        <i class="fas fa-star" style="font-size:13px;color:{{ $i<=$case->doctor_rating ? '#fbbf24' : 'var(--gray-200)' }}"></i>
                    @endfor
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="notes-block" style="background:#fffbeb;border-color:#fde68a">{{ $case->doctor_note }}</div>
            </div>
        </div>
        @endif

        <!-- Follow-ups -->
        <div class="card-section">
            <div class="card-header">
                <h3><i class="fas fa-clock-rotate-left"></i> Follow-up Messages</h3>
                <span style="font-size:12px;color:var(--gray-400)">{{ count($followups) }} total</span>
            </div>
            <div class="card-body" style="padding: 0 20px">
                @forelse($followups as $fu)
                    <div class="followup-item">
                        <div class="followup-dot"><i class="fas fa-message" style="font-size:11px"></i></div>
                        <div class="followup-content">
                            <div class="fu-note">{{ $fu['note'] }}</div>
                            <div class="fu-date"><i class="fas fa-clock" style="font-size:10px"></i> {{ $fu['created_at'] }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-followups">
                        <i class="fas fa-inbox"></i>
                        <p>No follow-up messages yet</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- ═══ RIGHT SIDEBAR ═══ -->
    <div class="sidebar-sticky">

        <!-- Case Status Card -->
        <div class="card-section">
            <div class="card-header">
                <h3><i class="fas fa-sliders"></i> Case Management</h3>
            </div>
            <div class="card-body">

                <!-- Current badges -->
                <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px">
                    <span class="badge {{ $statusClass }}">
                        {{ ucwords(str_replace('_',' ',$case->status)) }}
                    </span>
                    <span class="priority-pill {{ $prioClass }}">
                        <i class="fas fa-circle" style="font-size:7px"></i>
                        {{ ucfirst($case->priority) }}
                    </span>
                </div>

                <form class="status-form" id="caseUpdateForm">
                    @csrf

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="statusSelect">
                            <option value="new"         {{ $case->status=='new'         ? 'selected':'' }}>🔵 New</option>
                            <option value="assigned"    {{ $case->status=='assigned'    ? 'selected':'' }}>🟣 Assigned</option>
                            <option value="in_progress" {{ $case->status=='in_progress' ? 'selected':'' }}>🟡 In Progress</option>
                            <option value="resolved"    {{ $case->status=='resolved'    ? 'selected':'' }}>🟢 Resolved</option>
                        </select>
                    </div>

                    <!-- Priority -->
                    <div class="form-group">
                        <label>Priority</label>
                        <select name="priority" id="prioritySelect">
                            <option value="low"    {{ $case->priority=='low'    ? 'selected':'' }}>🟢 Low</option>
                            <option value="medium" {{ $case->priority=='medium' ? 'selected':'' }}>🟡 Medium</option>
                            <option value="high"   {{ $case->priority=='high'   ? 'selected':'' }}>🔴 High</option>
                            <option value="crisis" {{ $case->priority=='crisis' ? 'selected':'' }}>🟣 Crisis</option>
                        </select>
                    </div>

                    <!-- Doctor Rating -->
                    <div class="form-group">
                        <label>Case Rating</label>
                        <div class="star-group" id="starGroup">
                            @for($i=1;$i<=5;$i++)
                                <button type="button" class="star-btn {{ $i <= ($case->doctor_rating ?? 0) ? 'active' : '' }}"
                                        data-val="{{ $i }}" onclick="setRating({{ $i }})">★</button>
                            @endfor
                        </div>
                        <input type="hidden" name="doctor_rating" id="ratingInput" value="{{ $case->doctor_rating ?? '' }}">
                    </div>

                    <!-- Doctor Note -->
                    <div class="form-group">
                        <label>Doctor's Note</label>
                        <textarea name="doctor_note" id="doctorNote" placeholder="Write your clinical assessment, observations, and recommendations here...">{{ $case->doctor_note }}</textarea>
                    </div>

                    <button type="button" class="btn-save" id="saveBtn" onclick="saveCase()">
                        <i class="fas fa-floppy-disk"></i> Save Changes
                    </button>
                </form>

            </div>
        </div>

        <!-- Quick Info Card -->
        <div class="card-section">
            <div class="card-header">
                <h3><i class="fas fa-circle-info"></i> Case Info</h3>
            </div>
            <div class="card-body" style="padding:14px 20px">
                <div style="display:flex;flex-direction:column;gap:10px">
                    <div class="info-item">
                        <span class="info-lbl">Case Number</span>
                        <span class="info-val" style="font-family:monospace;word-break:break-all">{{ $case->case_number }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-lbl">Submitted</span>
                        <span class="info-val">{{ \Carbon\Carbon::parse($case->created_at)->format('M d, Y · h:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-lbl">Last Updated</span>
                        <span class="info-val">{{ \Carbon\Carbon::parse($case->updated_at)->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Toast -->
<div class="save-toast" id="saveToast">
    <i class="fas fa-circle-check"></i>
    <span id="toastMsg">Changes saved successfully</span>
</div>

<script>
// ── Star Rating ──
function setRating(val) {
    document.getElementById('ratingInput').value = val;
    document.querySelectorAll('.star-btn').forEach(btn => {
        btn.classList.toggle('active', parseInt(btn.dataset.val) <= val);
    });
}

// ── Save Case ──
async function saveCase() {
    const btn = document.getElementById('saveBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

    const payload = {
        status:        document.getElementById('statusSelect').value,
        priority:      document.getElementById('prioritySelect').value,
        doctor_note:   document.getElementById('doctorNote').value,
        doctor_rating: document.getElementById('ratingInput').value || null,
        _token:        document.querySelector('[name="_token"]')?.value || '{{ csrf_token() }}',
    };

    try {
        const res  = await fetch('{{ route("admin.cases.update", $case->id) }}', {
            method: 'POST',
            headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN':'{{ csrf_token() }}', 'Accept':'application/json' },
            body: JSON.stringify(payload),
        });
        const data = await res.json();
        if (data.success) {
            showToast('Changes saved successfully', 'success');
            updateBadgeDisplay(payload.status, payload.priority);
        } else {
            showToast('Failed to save. Please try again.', 'error');
        }
    } catch(e) {
        showToast('Network error. Please try again.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-floppy-disk"></i> Save Changes';
    }
}

function updateBadgeDisplay(status, priority) {
    const statusLabels  = { new:'New', assigned:'Assigned', in_progress:'In Progress', resolved:'Resolved', closed:'Closed' };
    const statusClasses = { new:'badge-new', assigned:'badge-assigned', in_progress:'badge-progress', resolved:'badge-resolved', closed:'badge-closed' };
    const prioLabels    = { crisis:'Crisis', high:'High', medium:'Medium', low:'Low' };
    const prioClasses   = { crisis:'prio-crisis', high:'prio-high', medium:'prio-medium', low:'prio-low' };

    document.querySelectorAll('[class*="badge-new"],[class*="badge-assigned"],[class*="badge-progress"],[class*="badge-resolved"],[class*="badge-closed"]').forEach(el => {
        el.className = 'badge ' + (statusClasses[status] || 'badge-new');
        el.textContent = statusLabels[status] || status;
    });

    document.querySelectorAll('[class*="prio-"]').forEach(el => {
        el.className = 'priority-pill ' + (prioClasses[priority] || 'prio-low');
        el.innerHTML = `<i class="fas fa-circle" style="font-size:7px"></i> ${prioLabels[priority] || priority}`;
    });
}

function showToast(msg, type = 'success') {
    const t = document.getElementById('saveToast');
    const icon = t.querySelector('i');
    document.getElementById('toastMsg').textContent = msg;
    t.className = 'save-toast ' + type;
    icon.className = type === 'success' ? 'fas fa-circle-check' : 'fas fa-circle-xmark';
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3500);
}
</script>

@endsection