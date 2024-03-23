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
        <li class="menu-item {{ Request::is('presensi-guru*') ? 'active' : '' }}">
            <a href="{{ url('presensi-guru') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-broadcast"></i>
                <div data-i18n="Basic">Presensi</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('rekap-presensi*') ? 'active' : '' }}">
            <a href="{{ url('rekap-presensi-guru') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div data-i18n="Basic">Rekapitulasi</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>
        <li class="menu-item {{ Request::is('siswa-guru*') ? 'active' : '' }}">
            <a href="{{ url('siswa-guru') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-face"></i>
                <div data-i18n="Basic">Siswa</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('guru-guru*') ? 'active' : '' }}">
            <a href="{{ url('guru-guru') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Basic">Guru</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <li class="menu-item {{ Request::is('profile-guru*') ? 'active' : '' }}">
            <a href="{{ url('profile-guru') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div data-i18n="Basic">Pengaturan Akun</div>
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
