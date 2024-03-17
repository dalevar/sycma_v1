@extends('landingpage.layouts.main')

@section('title', 'Harga Aplikasi Sycma Attendance')

@section('main')
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1 class="text-center">Harga Aplikasi Sycma</h1>
                    <h2 class="text-center">
                        Dapatkan harga terbaik untuk aplikasi Sycma dengan menghubungi kami sekarang!
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row mx-auto" data-aos="fade-up" data-aos-delay="600">
            <!-- Basic Package -->
            <div class="card card-melayang" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Basic</h5>
                    <p class="card-text">
                        Sesuai untuk: Sekolah kecil dengan kebutuhan sederhana dan anggaran terbatas.<br>
                        Fitur: Absensi siswa manual, Rekap kehadiran sederhana, Data siswa dasar, Pengumuman sekolah.<br>
                        Harga: Rp 500.000/tahun untuk 100 siswa.
                    </p>
                    <a href="#" class="btn btn-primary">Pilih Basic</a>
                </div>
            </div>

            <!-- Pro Package -->
            <div class="card card-melayang" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Pro</h5>
                    <p class="card-text">
                        Sesuai untuk: Sekolah menengah dengan kebutuhan moderat dan anggaran lebih baik.<br>
                        Fitur: Absensi manual dan RFID, Rekap kehadiran terperinci, Data siswa lengkap, Pesan pribadi dengan
                        orang tua, Laporan nilai.<br>
                        Harga: Rp 1.500.000/tahun untuk 100 siswa.
                    </p>
                    <a href="#" class="btn btn-primary">Pilih Pro</a>
                </div>
            </div>

            <!-- Exclusive Package -->
            <div class="card card-melayang" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Exclusive</h5>
                    <p class="card-text">
                        Sesuai untuk: Sekolah besar dengan fokus pada komunikasi dan analisis data.<br>
                        Fitur: Semua fitur Pro + Pengumuman dengan segmentasi penerima, Laporan kehadiran visual, Analisis
                        data siswa, Integrasi dengan sistem lain.<br>
                        Harga: Rp 3.000.000/tahun untuk 100 siswa.
                    </p>
                    <a href="#" class="btn btn-primary">Pilih Exclusive</a>
                </div>
            </div>

            <!-- Enterprise Package -->
            <div class="card card-melayang" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Enterprise</h5>
                    <p class="card-text">
                        Sesuai untuk: Institusi besar dengan kebutuhan kompleks dan keamanan tingkat tinggi.<br>
                        Fitur: Semua fitur Exclusive + Kustomisasi fitur dan laporan, Dukungan teknis prioritas, Keamanan
                        data tingkat lanjut.<br>
                        Harga: Penawaran khusus berdasarkan kebutuhan.
                    </p>
                    <a href="#" class="btn btn-primary">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>


    <section class="inner-page" data-aos="fade-up" data-aos-delay="600">
        <div class="container">
            <h1 class="text-center">
                Benefit Langganan
            </h1>
            <p class="text-center text-secondary">
                Pilih fitur sesuai dengan kebutuhan sekolah Anda dengan melihat perbandingan fitur di bawah ini.
            </p>


            <div class="row">
                <div class="card mt-3 mx-auto" style="width: 75%;">
                    <div class="card-body text-center">
                        <div class="row p-4">
                            <h5 class="card-title mt-4">Dapatkan Promo khusus dan informasi menarik lainnya
                            </h5>
                            <a href="#" class="whatsapp-link">
                                <i class='bx bxl-whatsapp text-success fs-1'></i>
                                WhatsApp kami disini
                            </a>
                        </div>
                    </div>

                    <div class="p-1">
                        <div class="row text-left">
                            <div class="col-lg-4 px-3 py-3">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" style="fill: #209dd8; transform: ;msFilter:;">
                                            <path
                                                d="M18.948 11.112C18.511 7.67 15.563 5 12.004 5c-2.756 0-5.15 1.611-6.243 4.15-2.148.642-3.757 2.67-3.757 4.85 0 2.757 2.243 5 5 5h1v-2h-1c-1.654 0-3-1.346-3-3 0-1.404 1.199-2.757 2.673-3.016l.581-.102.192-.558C8.153 8.273 9.898 7 12.004 7c2.757 0 5 2.243 5 5v1h1c1.103 0 2 .897 2 2s-.897 2-2 2h-2v2h2c2.206 0 4-1.794 4-4a4.008 4.008 0 0 0-3.056-3.888z">
                                            </path>
                                            <path d="M13.004 14v-4h-2v4h-3l4 5 4-5z"></path>
                                        </svg>
                                    </div>
                                    <div class="mx-2">
                                        <div class="fw-semibold pt-1">Instalasi & Konfigurasi</div>
                                        <div class="pt-2 mt-1 text-sm"> membantu sekolah dalam menginstal dan
                                            mengkonfigurasi aplikasi SYCMA dengan benar.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 px-3 py-3">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" style="fill: #209dd8; transform: ;msFilter:;">
                                            <path
                                                d="M12 2C6.486 2 2 6.486 2 12v4.143C2 17.167 2.897 18 4 18h1a1 1 0 0 0 1-1v-5.143a1 1 0 0 0-1-1h-.908C4.648 6.987 7.978 4 12 4s7.352 2.987 7.908 6.857H19a1 1 0 0 0-1 1V18c0 1.103-.897 2-2 2h-2v-1h-4v3h6c2.206 0 4-1.794 4-4 1.103 0 2-.833 2-1.857V12c0-5.514-4.486-10-10-10z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="mx-2">
                                        <div class="fw-semibold pt-1">Dukungan Teknis</div>
                                        <div class="pt-2 mt-1 text-sm">dukungan teknis 24/7 untuk
                                            mengatasi masalah teknis yang terjadi pada aplikasi SYCMA.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 px-3 py-3">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" style="fill: #209dd8; transform: ;msFilter:;">
                                            <path
                                                d="M12 4C6.486 4 2 8.486 2 14a9.89 9.89 0 0 0 1.051 4.445c.17.34.516.555.895.555h16.107c.379 0 .726-.215.896-.555A9.89 9.89 0 0 0 22 14c0-5.514-4.486-10-10-10zm7.41 13H4.59A7.875 7.875 0 0 1 4 14c0-4.411 3.589-8 8-8s8 3.589 8 8a7.875 7.875 0 0 1-.59 3z">
                                            </path>
                                            <path
                                                d="M10.939 12.939a1.53 1.53 0 0 0 0 2.561 1.53 1.53 0 0 0 2.121-.44l3.962-6.038a.034.034 0 0 0 0-.035.033.033 0 0 0-.045-.01l-6.038 3.962z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="mx-2">
                                        <div class="fw-semibold pt-1">Pemiliharaan & Perbaikan</div>
                                        <div class="pt-2 mt-1 text-sm">menjaga aplikasi SYCMA tetap berjalan dengan lancar.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="text-center shortened-text">
                        Masih belum yakin untuk berlangganan aplikasi SYCMA? Dapatkan akses ke semua fitur aplikasi SYCMA
                        dengan coba demo secara gratis.
                    </p>
                    <div class="btn-container">
                        <a href="#" class="btn-whatsapp-sekarang scrollto btn btn-primary">Jadwalkan Demo</a>
                        <button class="mt-3 bg-transparent border-0 fw-semibold mb-4">Benefit
                            Demo</button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="border-top text-center" style="background: #fafafa">
        <div id="clients" class="clients" data-aos="fade-up" data-aos-delay="600">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12 mx-auto text-center">
                        <h5 class="fw-medium">Telah dipercaya oleh</h5>
                    </div>
                </div>
                <div class="row justify-content-center d-lg-flex">
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="sycma-clients logo-wrapper">
                            <img src="{{ asset('import/assets/img/clients/isfi-logo.png') }}" alt="ISFI"
                                class="img-fluid" height="50" width="118" style="display: inline">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="sycma-clients logo-wrapper">
                            <img src="{{ asset('import/assets/img/clients/isfi-logo.png') }}" alt="ISFI"
                                class="img-fluid" height="50" width="118" style="display: inline">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="sycma-clients logo-wrapper">
                            <img src="{{ asset('import/assets/img/clients/isfi-logo.png') }}" alt="ISFI"
                                class="img-fluid" height="50" width="118" style="display: inline">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="sycma-clients logo-wrapper">
                            <img src="{{ asset('import/assets/img/clients/isfi-logo.png') }}" alt="ISFI"
                                class="img-fluid" height="50" width="118" style="display: inline">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="sycma-clients logo-wrapper">
                            <img src="{{ asset('import/assets/img/clients/isfi-logo.png') }}" alt="ISFI"
                                class="img-fluid" height="50" width="118" style="display: inline">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section id="clients">

    </section> --}}

    <hr class="divider">
@endsection
