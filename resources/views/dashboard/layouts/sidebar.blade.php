<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="display: flex; flex-direction: column; min-height: 90vh;">

  <ul class="sidebar-nav" id="sidebar-nav" style="flex: 1;">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
  </ul>

  <ul class="sidebar-nav">
    <li class="nav-item">
      <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="nav-link collapsed" style="background: none; border: none; width: 100%; text-align: left; color: #d9534f;">
          <i class="bi bi-box-arrow-right" style="color: #d9534f;"></i>
          <span>Sign Out</span>
        </button>
      </form>
    </li>
  </ul>

</aside><!-- End Sidebar-->