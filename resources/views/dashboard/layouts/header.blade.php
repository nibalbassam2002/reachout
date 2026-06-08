<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
      <img src="{{ asset('reachout/img/logo5.png') }}" alt="">
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

<div class="search-bar" style="position:relative">
  <form class="search-form d-flex align-items-center" method="GET" action="#" autocomplete="off">
    <input 
      type="text" 
      id="globalSearch"
      name="query" 
      placeholder="Search cases, doctors..." 
      title="Search"
      autocomplete="off"
    >
    <button type="button" title="Search"><i class="bi bi-search"></i></button>
  </form>

  {{-- نتائج البحث --}}
  <div id="searchDropdown" style="
    display:none;
    position:absolute;
    top:calc(100% + 8px);
    left:0; right:0;
    background:#fff;
    border-radius:12px;
    box-shadow:0 8px 32px rgba(15,57,99,.18);
    border:1px solid rgba(15,57,99,.1);
    z-index:9999;
    overflow:hidden;
    min-width:360px;
  ">
    <div id="searchResults"></div>
    <div id="searchEmpty" style="display:none; padding:18px; text-align:center; color:#6b7f96; font-size:13px">
      <i class="bi bi-search" style="font-size:20px; display:block; margin-bottom:6px; opacity:.4"></i>
      No results found
    </div>
    <div id="searchLoading" style="display:none; padding:18px; text-align:center; color:#6b7f96; font-size:13px">
      <i class="bi bi-arrow-repeat" style="font-size:18px; display:block; margin-bottom:4px; opacity:.5"></i>
      Searching...
    </div>
  </div>
</div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          {{-- صورة البروفايل أو أيقونة افتراضية --}}
          @if(auth()->user()->avatar)
          <img src="{{ asset('storage/' . auth()->user()->avatar) }}?v={{ time() }}" alt="Profile" class="rounded-circle" style="width:36px; height:36px; object-fit:cover;">
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
           {{-- جديد --}}
          <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}">
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
<script>
(function () {
    const input    = document.getElementById('globalSearch');
    if (!input) return;

    const dropdown = document.getElementById('searchDropdown');
    const results  = document.getElementById('searchResults');
    const empty    = document.getElementById('searchEmpty');
    const loading  = document.getElementById('searchLoading');

    input.closest('form')?.addEventListener('submit', e => e.preventDefault());

    let timer = null;

    input.addEventListener('input', function () {
        const q = this.value.trim();
        clearTimeout(timer);

        if (q.length < 2) {
            dropdown.style.display = 'none';
            return;
        }

        dropdown.style.display = 'block';
        loading.style.display  = 'block';
        results.innerHTML      = '';
        empty.style.display    = 'none';

        timer = setTimeout(() => {
            fetch(`/admin/search?q=${encodeURIComponent(q)}`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                loading.style.display = 'none';

                if (!data.results?.length) {
                    empty.style.display = 'block';
                    return;
                }

                const groups = { case: [], doctor: [], complaint: [] };
                const labels = { case: 'Cases', doctor: 'Doctors', complaint: 'Complaints' };
                data.results.forEach(r => groups[r.type]?.push(r));

                let html = '';
                for (const [type, items] of Object.entries(groups)) {
                    if (!items.length) continue;
                    html += `<div style="padding:6px 14px 3px;font-size:10px;font-weight:700;color:#6b7f96;text-transform:uppercase;letter-spacing:.5px;border-top:1px solid #f0f4f8">${labels[type]}</div>`;
                    items.forEach(item => {
                        html += `
                        <a href="${item.url}" style="display:flex;align-items:center;gap:12px;padding:9px 14px;text-decoration:none;color:inherit;transition:background .15s"
                           onmouseover="this.style.background='#eef5fb'"
                           onmouseout="this.style.background=''">
                          <div style="width:32px;height:32px;border-radius:8px;background:${item.color}18;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="bi ${item.icon}" style="color:${item.color};font-size:14px"></i>
                          </div>
                          <div style="min-width:0">
                            <div style="font-size:13px;font-weight:600;color:#0F3963;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${item.title}</div>
                            <div style="font-size:11px;color:#6b7f96;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${item.subtitle}</div>
                          </div>
                        </a>`;
                    });
                }
                results.innerHTML = html;
            })
            .catch(() => { loading.style.display = 'none'; });
        }, 300);
    });

    document.addEventListener('click', e => {
        if (!input.contains(e.target) && !dropdown.contains(e.target))
            dropdown.style.display = 'none';
    });

    input.addEventListener('keydown', e => {
        if (e.key === 'Escape') dropdown.style.display = 'none';
    });
})();
</script>
</header>