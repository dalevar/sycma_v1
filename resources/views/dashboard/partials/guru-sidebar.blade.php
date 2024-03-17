<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-icon demo">
                <img src="{{ asset('storage/' . $sekolah->logo_sekolah) }}" alt="Brand Logo" class="img-fluid">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard*') ? 'active' : '' }}">
            <a href="{{ url('dashboard-guru') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Presensi -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Presensi</span></li>
        <li class="menu-item {{ Request::is('presensi*') ? 'active' : '' }}">
            <a href="{{ url('presensi') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-broadcast"></i>
                <div data-i18n="Basic">Presensi</div>
            </a>
        </li>
        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div data-i18n="User interface">Rekapitulasi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="ui-tabs-pills.html" class="menu-link">
                        <div data-i18n="Tabs &amp; Pills">Tabs &amp; Pills</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-toasts.html" class="menu-link">
                        <div data-i18n="Toasts">Toasts</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-typography.html" class="menu-link">
                        <div data-i18n="Typography">Typography</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Siswa &amp; Guru</span>
        </li>
        <li class="menu-item {{ Request::is('siswa*') ? 'active' : '' }}">
            <a href="{{ url('siswa') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-face"></i>
                <div data-i18n="Basic">Siswa</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('guru*') ? 'active' : '' }}">
            <a href="{{ route('guru.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Basic">Guru</div>
            </a>
        </li>


        <div class="menu-footer mt-4 mx-auto">
            <div class="menu-item">
                <a href="{{ route('logout') }}" class="menu-link bg-danger text-white">
                    <i class="menu-icon tf-icons bx bx-log-out-circle"></i>
                    <div data-i18n="Basic">Logout</div>
                </a>
            </div>
    </ul>
</aside>
