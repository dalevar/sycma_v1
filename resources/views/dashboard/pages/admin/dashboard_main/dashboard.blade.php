@extends('dashboard.layouts.main')
@section('title', 'Presensi Sholat - Sycma Attendance')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Info!</strong> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang, Admin!</h5>
                                <p class="mb-4">
                                    Silakan pantau presensi siswa dengan menggunakan fitur yang tersedia.
                                </p>

                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">Lihat Presensi</a>
                            </div>

                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ 'backoffice/assets/img/illustrations/man-with-laptop-light.png' }}"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-12">
                        <div class="card pb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <div class="card-title">
                                            <h5 class="text-nowrap mb-2">Total Data Siswa</h5>
                                            <span class="badge bg-label-warning rounded-pill">Tahun
                                                {{ date('Y') }}</span>
                                        </div>
                                        <small class="text-success text-nowrap fw-semibold"><i
                                                class="bx bx-up-arrow-alt"></i>
                                            20 Siswa</small>
                                        <div class="mt-sm-auto d-flex align-items-end">
                                            <h3 class="mb-0">700</h3>
                                            <small>Siswa</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <img src="{{ 'backoffice/assets/img/illustrations/student_muslim2.png' }}"
                                            class="rounded" height="120" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Chart Presensi seluruh siswa -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Jumlah Seluruh Siswa Yang Melaksanakan Sholat</h5>
                                    <small class="text-muted">Tanggal : {{ date('Y-m-d') }}</small>
                                </div>
                                <div class="dropdown">
                                    <input class="form-control" type="date" value="{{ date('Y-m-d') }}"
                                        id="html5-date-input">
                                </div>
                            </div>
                            <div id="totalPresensi" class="px-2"></div>
                            {{-- <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <h5 class="m-0">Total Laki-Laki</h5>
                                        <h3 class="card-title">700</h3>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--/Chart Presensi seluruh siswa -->

            <!-- List Data Gender, Jurusan, dan kelas -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ 'backoffice/assets/img/icons/unicons/laki-avatar.png' }}"
                                            alt="Credit Card" class="rounded">
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-2">Siswa Laki-Laki</span>
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title text-nowrap">240</h3>
                                    <small>siswa</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ 'backoffice/assets/img/icons/unicons/cewe-avatar.png' }}"
                                            alt="Credit Card" class="rounded">
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Siswa Perempuan</span>
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title mb-2">240</h3>
                                    <small>siswa</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ 'backoffice/assets/img/icons/unicons/jurusan-primary.png' }}"
                                            alt="Credit Card" class="rounded">
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Jurusan</span>
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title text-nowrap mb-2">6</h3>
                                    <small>Jurusan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 pb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ 'backoffice/assets/img/icons/unicons/kelas-primary.png' }}"
                                            alt="Credit Card" class="rounded">
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Kelas</span>
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title mb-2">18</h3>
                                    <small>Kelas</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /List Data Gender, Jurusan, dan kelas  -->
        </div>

        <div class="row">
            <!-- Presensi Siswa Terbaru -->
            <div class="col-md-6 col-lg-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Riwayat Presensi Siswa Terbaru</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <ul class="dropdown-menu" style="">
                                <li>
                                    <h6 class="dropdown-header text-uppercase">Riwayat Presensi</h6>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Terbaru</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Terlama</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="backoffice/assets/img/icons/unicons/laki-avatar.png" alt="User"
                                        class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">RPL</small>
                                        <h6 class="mb-0">Saidil Mifdal</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <span class="text-muted">Waktu</span>
                                        <h6 class="mb-0">12:30</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="backoffice/assets/img/icons/unicons/laki-avatar.png" alt="User"
                                        class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">RPL</small>
                                        <h6 class="mb-0">Saidil Mifdal</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <span class="text-muted">Waktu</span>
                                        <h6 class="mb-0">12:30</h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Presensi Siswa Terbaru -->

            <!-- Chart Presensi Siswa berdasarkan Jurusan Kelas -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12">
                            <div class="card-header d-flex align-items-center pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2 mb-2">Jumlah Presensi Siswa Berdasarkan Jurusan
                                        dan Kelas</h5>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-select" id="kelasDropdown">
                                                    <option value="0" selected disabled>Kelas
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-select" id="jurusanDropdown">
                                                    <option value="0" selected disabled>Jurusan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="presensiJurusanKelas" class="px-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Chart Presensi Siswa berdasarkan Jurusan Kelas -->

        </div>
    </div>
    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script>

@endsection
