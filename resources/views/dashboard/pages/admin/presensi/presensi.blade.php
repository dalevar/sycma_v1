@extends('dashboard.layouts.main')
@section('title', 'Presensi Sholat - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0 card-header">Presensi Sholat</h4>
        <div class="card mb-4">
            <h6 class="card-header fw-bold">Data Presensi Sholat</h6>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses! Data berhasil ditambahkan</strong> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('update'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses! Data berhasil diupdate</strong> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('delete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses! Data berhasil dihapus</strong> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th>Waktu Sholat</th>
                                <th>Jenis Sholat</th>
                                <th>Jam Sholat</th>
                                <th>Status</th>
                                <th width='11%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensi as $p)
                                <tr>
                                    <td>{{ $p->siswa->nama_lengkap }}</td>
                                    <td>{{ $p->tanggal }}</td>
                                    <td>{{ $p->waktu_sholat }}</td>
                                    <td>{{ $p->jenis_sholat }}</td>
                                    <td>{{ $p->jam_sholat }}</td>
                                    <td>{{ $p->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#detailModal_{{ $loop->index + 1 }}">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal_">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <!-- Presensi Siswa Terbaru -->
                    <div class="col-md-6 col-lg-4 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Riwayat Presensi Siswa</h5>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li>
                                            <h6 class="dropdown-header text-uppercase">Riwayat Presensi</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Masuk</a>
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Keluar</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    @foreach ($presensi as $p)
                                        <li class="d-flex mb-4 pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <img src="backoffice/assets/img/icons/unicons/laki-avatar.png"
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
                                    {{-- <li class="d-flex pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <img src="backoffice/assets/img/icons/unicons/laki-avatar.png" alt="User"
                                                class="rounded" />
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <small class="text-muted d-block mb-1">RPL</small>
                                                <h6 class="mb-0">Saidil Mifdal</h6>
                                            </div>
                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <span class="text-muted">Waktu</span>
                                                <h6 class="mb-0">12:30</h6>
                                            </div>
                                        </div>
                                    </li> --}}
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
                                            <h5 class="m-0 me-2 mb-2">Jumlah Presensi Sholat Siswa Berdasarkan Jurusan
                                                dan Kelas</h5>
                                            <div class="row g-2 mb-2">
                                                <div class="col-md-4">
                                                    <div class="dropdown">
                                                        <select class="form-select" id="kelasDropdown">
                                                            <option value="0" selected disabled>Kelas
                                                            </option>
                                                            @foreach ($kelas as $k)
                                                                <option value="{{ $k->id }}">{{ $k->kelas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="dropdown">
                                                        <select class="form-select" id="jurusanDropdown">
                                                            <option value="0" selected disabled>Jurusan
                                                            </option>
                                                            @foreach ($jurusan as $j)
                                                                <option value="{{ $j->id }}">{{ $j->jurusan }}
                                                                </option>
                                                            @endforeach
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
        </div>
    </div>

    <!-- Edit Modal -->
    @foreach ($presensi as $item)
        <div class="modal fade" id="detailModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Detail Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td>{{ $item->siswa->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td>Jam Sholat</td>
                                <td>:</td>
                                <td>{{ $item->jam_sholat }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script>
@endsection
