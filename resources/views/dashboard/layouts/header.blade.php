<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
      <img src="{{ asset('reachout/img/logo5.png') }}" alt="">
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="GET" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          {{-- صورة البروفايل أو أيقونة افتراضية --}}
          @if(auth()->user()->avatar)
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Profile" class="rounded-circle">
          @else
            <img src="{{ asset('reachout/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
          @endif
          <span class="d-none d-md-block dropdown-toggle ps-2">
            {{ auth()->user()->name }}
          </span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ auth()->user()->name }}</h6>
            <span>{{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Doctor' }}</span>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>

          {{-- ✅ تسجيل الخروج --}}
          <li>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
              @csrf
              <button type="submit" class="dropdown-item d-flex align-items-center">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </form>
          </li>

        </ul>
      </li>

    </ul>
  </nav>

</header>