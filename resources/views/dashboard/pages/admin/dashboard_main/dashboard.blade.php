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
                                <h5 class="card-title text-primary">Selamat Datang, {{ $admin->name }}!</h5>
                                <p class="mb-4">
                                    Silakan pantau presensi siswa dengan menggunakan fitur yang tersedia.
                                </p>

                                <a href="{{ route('presensi.index') }}" class="btn btn-sm btn-outline-primary">Lihat
                                    Presensi</a>
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
                                        <div class="mt-sm-auto d-flex align-items-end">
                                            <h3 class="mb-0">{{ $totalDataSiswa }}</h3>
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
                        <div class="col-md-8">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Jumlah Seluruh Siswa Yang Melaksanakan Sholat</h5>
                                </div>
                                {{-- <div class="dropdown">
                                    <input class="form-control" type="date" value="{{ date('Y-m-d') }}"
                                        id="html5-date-input">
                                </div> --}}
                            </div>
                            {{-- <div id="totalPresensi" class="px-2"></div> --}}
                            @if ($presensi->isEmpty())
                                <h2 class="text-muted text-center px-2" style="margin-top: 4em; padding-bottom: 5.4em">Belum
                                    ada siswa yang
                                    melaksanakan
                                    Sholat</h2>
                            @else
                                {!! $chart->container() !!}
                            @endif

                        </div>
                        <div class="col-md-4">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Total Jumlah Siswa</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="d-flex align-items-center" style="padding-top: 2em;">
                                        <div class="avatar avatar-sm me-2">
                                            <img src="backoffice/assets/img/icons/unicons/laki-avatar.png" alt="Graduation"
                                                class="rounded" />
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Total Siswa Laki-Laki</h6>
                                            <small class="text-muted">{{ $totalSiswaLaki }} Siswa</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <img src="backoffice/assets/img/icons/unicons/cewe-avatar.png" alt="Graduation"
                                                class="rounded" />
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Total Siswa Perempuan</h6>
                                            <small class="text-muted">{{ $totalSiswaPerempuan }} Siswa</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Chart Presensi seluruh siswa -->

            <!-- List Data Gender, Jurusan, dan kelas -->
            <div class="col-lg-4 col-md-4  order-3 order-md-2">
                <div class="row">
                    <!-- Presensi Siswa Terbaru -->
                    <div class="col-md-12 col-lg-12 order-0 mb-4">
                        <div class="card h-100 align-content-lg-end">
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
                            <div class="card-body" style="padding-bottom: 9.4em">
                                <ul class="p-0 m-0">
                                    @if ($presensi->isEmpty())
                                        <h2 class="text-muted text-center" style="margin-top: 4em">Belum ada siswa yang
                                            melaksanakan Sholat
                                        </h2>
                                    @else
                                        @foreach ($presensi as $p)
                                            <li class="d-flex mb-4 pb-1">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <img src="backoffice/assets/img/icons/unicons/{{ $p->siswa->jenis_kelamin == 'L' ? 'laki-avatar.png' : 'cewe-avatar.png' }}"
                                                        alt="User" class="rounded" />
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small
                                                            class="text-muted d-block mb-1">{{ $p->siswa->jurusan->jurusan }}</small>
                                                        <h6 class="mb-0">{{ $p->siswa->nama_lengkap }}</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Waktu</span>
                                                        <h6 class="mb-0">{{ $p->jam_sholat }}</h6>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/ Presensi Siswa Terbaru -->
                </div>
            </div>
            <!-- /List Data Gender, Jurusan, dan kelas  -->
        </div>
    </div>

    <div class="modal fade show {{ $is_active == 1 ? 'hidden' : '' }}" id="modalCenter" tabindex="-1"
        style="display: {{ $displayStyle }}; background-color: rgba(105, 122, 141, 0.5);" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h5 class="modal-title text-center mt-3" id="modalCenterTitle">Selesaikan Pembayaran</h5>
                <div class="modal-body">
                    <form action="{{ route('checkout-process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $admin->id }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="price" value="{{ $product->harga }}">
                        <h2 class="text-center fw-bold">Lanjutkan Pembayaran</h2>
                        <div class="icon text-center mb-4 animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24"
                                style="fill: rgb(33, 148, 255);transform: ;msFilter:;">
                                <path
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                                </path>
                                <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                            </svg>
                        </div>
                        <p class="text-muted text-center">Selesaikan pembayaran untuk melanjutkan proses presensi</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Pembayaran</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#jurusan').change(function() {
                let selectedJurusan = $(this).val();

                // Disable the "Kelas" select if "Pilih Jurusan" is selected
                $('#kelas').prop('disabled', selectedJurusan == 0);

                if (selectedJurusan == 0) {
                    // Clear the selected value when disabling the "Kelas" select
                    $('#kelas').val(null);
                    return;
                }

                // Hide all options
                $('#kelas option').hide();

                // Show only options related to the selected jurusan
                $('.kelas-option[data-jurusan="' + selectedJurusan + '"]').show();
            });
        });
    </script>
@endsection
