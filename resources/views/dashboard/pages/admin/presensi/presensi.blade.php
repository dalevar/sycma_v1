@extends('dashboard.layouts.main')
@section('title', 'Presensi Sholat - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0 card-header">Presensi Sholat</h4>
        <div class="card mb-4">
            <div class="card-header align-content-end align-items-end">
                <h6 class="fw-bold">Data Presensi Sholat</h6>
                <div class="d-flex justify-content-between">
                    {{-- <div class="col-md-4">
                        <div class="nav-item d-flex align-items-center form-control">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                                aria-label="Nama Siswa">
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-2">
                        <input class="form-control" type="date" value="2021-06-18" id="html5-date-input">
                    </div> --}}
                </div>
            </div>

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
                    <table class="table table-bordered table-hover mb-0"
                        id={{ $presensi->isEmpty() ? '' : 'presensiTables' }}>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Tanggal</th>
                                <th>Waktu Sholat</th>
                                <th>Jenis Sholat</th>
                                <th>Jam Sholat</th>
                                <th>Status</th>
                                <th width='11%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($presensi->isEmpty())
                                <tr>
                                    <td colspan="9" class="h3 text-muted text-center">Belum ada data presensi siswa</td>
                                </tr>
                            @else
                                @foreach ($presensi as $p)
                                    <tr>
                                        <td>{{ $p->siswa->nama_lengkap }}</td>
                                        <td>{{ $p->siswa->kelas->kelas }}</td>
                                        <td>{{ $p->siswa->jurusan->jurusan }}</td>
                                        <td>{{ $p->tanggal }}</td>
                                        <td>{{ $p->waktu_sholat }}</td>
                                        <td>{{ $p->jenis_sholat }}</td>
                                        <td>{{ $p->jam_sholat }}</td>
                                        <td>
                                            @if ($p->status == 'Sholat Tepat Waktu')
                                                <span class="badge bg-label-success">Sholat Tepat Waktu</span>
                                            @elseif ($p->status == 'Sholat')
                                                <span class="badge bg-label-warning">Sholat</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm mb-2" data-bs-toggle="modal"
                                                data-bs-target="#detailModal_{{ $loop->index + 1 }}">
                                                <i class="bx bx-show"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                                data-bs-target="#hapusModal_{{ $loop->index + 1 }}">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
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
                                <li><a class="dropdown-item" href="javascript:void(0);">Terbaru</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Terlama</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
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

            <!-- Chart Presensi seluruh siswa -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Jumlah Seluruh Siswa Yang Melaksanakan Sholat</h5>
                                </div>
                            </div>
                            @if ($presensi->isEmpty())
                                <h2 class="text-muted text-center px-2" style="margin-top: 4em; padding-bottom: 5.4em">
                                    Belum
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
                                            <img src="backoffice/assets/img/icons/unicons/laki-avatar.png"
                                                alt="Graduation" class="rounded" />
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
                                            <img src="backoffice/assets/img/icons/unicons/cewe-avatar.png"
                                                alt="Graduation" class="rounded" />
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
        </div>
    </div>

    <!-- Detail Modal -->
    @foreach ($presensi as $item)
        <div class="modal fade" id="detailModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Detail Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" value="{{ $item->siswa->nama_lengkap }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">ID Kartu</label>
                                    <input type="text" class="form-control" value="{{ $item->no_kartu }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Kelas</label>
                                    <input type="text" class="form-control" value="{{ $item->siswa->kelas->kelas }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label class="form-label">Jurusan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->siswa->jurusan->jurusan }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" value="{{ $item->tanggal }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Waktu Sholat</label>
                                    <input type="text" class="form-control" value="{{ $item->waktu_sholat }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Sholat</label>
                                    <input type="text" class="form-control" value="{{ $item->jenis_sholat }}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-content-end align-items-end">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Sholat Siswa</label>
                                    <input type="text" class="form-control" value="{{ $item->jam_sholat }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <input type="text"
                                        class="form-control @if ($item->status == 'Tepat Waktu') alert-success @elseif ($item->status == 'Sholat') alert-warning @endif"
                                        value="{{ $item->status }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Kembali
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Hapus Modal -->
    @foreach ($presensi as $item)
        <div class="modal fade" id="hapusModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('presensi.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="row">
                                <div class="align-items-center text-center">
                                    <i class="bx bx-trash text-danger mb-1"
                                        style="font-size: 2em; background-color: #ffcccc; padding: 10px; border-radius: 50%;"></i>
                                    <p class="text-center"><b>Menghapus data presensi siswa<br>
                                            {{ $item->siswa->nama_lengkap }}</b><br>anda yakin ingin menghapus data
                                        ini?
                                    </p>
                                </div>
                                <div class="align-items-center text-left">
                                    <label for="nama_lengkap" class="form-label">Ketik :
                                        {{ $item->no_kartu }}</label>
                                    <input type="text" id="no_kartu" class="form-control" name="no_kartu" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-danger">Hapus!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables/datatables.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with your table ID
            $('#presensiTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.0.3/i18n/id.json',
                    paginate: {
                        previous: "‹", // Arrow left symbol
                        next: "›", // Arrow right symbol
                        first: "«", // Double arrow left symbol
                        last: "»" // Double arrow right symbol
                    }
                },
                "paging": true, // Enable pagination
                "searching": true, // Enable search/filtering
            });
        });
    </script>
@endsection
