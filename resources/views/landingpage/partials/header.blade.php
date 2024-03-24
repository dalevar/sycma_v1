<header id="header" class="fixed-top {{ Request::is('tentang') ? ' header-inner-pages' : '' }} }}">
    <div class="container d-flex align-items-center">
        <a href="/" class="logo me-auto"><img src="{{ asset('import/assets/img/sycma_logo-alt.png') }}" alt=""
                class="img-fluid"></a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto {{ Request::is('tentang') ? ' active' : '' }}"
                        href="{{ url('/#about') }}">Tentang Kami</a></li>
                <li class="dropdown"><a href="#services"><span>Layanan</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#produk">Sycma ARFID</a></li>
                        <li class="dropdown"><a href="#"><span>Software as a Services</span> <i
                                    class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#produk">Ultra Attendance</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ url('/#produk') }}">Produk</a></li>
                <li>
                    <a class="nav-link{{ Request::is('harga') ? ' active' : '' }}" href="{{ url('harga') }}">Harga</a>
                </li>
                <li><a class="nav-link scrollto" href="{{ url('/#faq') }}">FAQ</a></li>
                <li><a class="nav-link scrollto" href="{{ url('/#contact') }}">Hubungi Kami</a></li>
                <li><a class="getstarted scrollto" href="{{ route('register') }}">Coba Demo</a></li>
                <li><a class="nav-link scrollto" href="{{ route('login') }}">Masuk</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
