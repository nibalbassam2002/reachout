<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="display: flex; flex-direction: column; min-height: 90vh;">

  <ul class="sidebar-nav" id="sidebar-nav" style="flex: 1;">

    {{-- ── MAIN ── --}}
    <li class="nav-heading">Main</li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? '' : 'collapsed' }}"
         href="{{ route('admin.dashboard') }}">
        <i class="bi bi-grid-1x2-fill"></i>
        <span>Dashboard</span>
      </a>
    </li>

    {{-- ── MANAGEMENT ── --}}
    <li class="nav-heading" style="margin-top:18px;">Management</li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.doctors.*') ? '' : 'collapsed' }}"
         href="{{ route('admin.doctors.index') }}">
        <i class="bi bi-person-vcard"></i>
        <span>Doctors Team</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.bank.edit') ? '' : 'collapsed' }}"
         href="{{ route('admin.bank.edit') }}">
        <i class="bi bi-bank"></i>
        <span>Bank Settings</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.complaints.*') ? '' : 'collapsed' }}"
         href="{{ route('admin.complaints.index') }}">
        <i class="bi bi-flag"></i>
        <span>Complaints
          @if(isset($unreadComplaints) && $unreadComplaints > 0)
            <span style="background:#e53935; color:#fff; font-size:11px; font-weight:700; padding:1px 7px; border-radius:20px; margin-left:6px;">
              {{ $unreadComplaints }}
            </span>
          @endif
        </span>
      </a>
    </li>

    {{-- ── Cases ── --}}
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.cases.*') ? '' : 'collapsed' }}"
         href="{{ route('admin.cases.index') }}">
        <i class="bi bi-folder2-open"></i>
        <span>Cases
          @if(isset($newCasesCount) && $newCasesCount > 0)
            <span style="background:#1565c0; color:#fff; font-size:11px; font-weight:700; padding:1px 7px; border-radius:20px; margin-left:6px;">
              {{ $newCasesCount }}
            </span>
          @endif
        </span>
      </a>
    </li>

    {{-- Coming soon placeholder --}}
    <li class="nav-item">
      <span class="nav-link collapsed" style="opacity:.45; cursor:default;">
        <i class="bi bi-hourglass-split"></i>
        <span>Sections coming soon…</span>
      </span>
    </li>

  </ul>

  {{-- ── Sign Out (pinned bottom) ── --}}
  <ul class="sidebar-nav" style="border-top:1px solid rgba(1,41,112,0.08); padding-top:10px;">
    <li class="nav-item">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="nav-link collapsed"
                style="background:none; border:none; width:100%;
                       text-align:left; color:#c94040;">
          <i class="bi bi-box-arrow-right" style="color:#c94040;"></i>
          <span>Sign Out</span>
        </button>
      </form>
    </li>
  </ul>

</aside>
<!-- End Sidebar -->