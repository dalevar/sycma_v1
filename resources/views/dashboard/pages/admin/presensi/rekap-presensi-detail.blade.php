@extends('dashboard.layouts.main')
@section('title', 'Presensi Sholat - Sycma Attendance')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="{{ route('rekap-presensi.index') }}" class="text-muted fw-light">Rekap Presensi
                /</a> {{ $siswa->nama_lengkap }}
        </h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil di Update!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal di Update!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            <h5 class="col-md-6">Detail Data Siswa</h5>
                            {{-- <div class="col-md-6">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="#" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('backoffice/assets/img/avatars/admin.png') }}" alt="user-avatar"
                                class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">{{ $siswa->nama_lengkap }}</h5>
                                <p class="text-muted">{{ $siswa->nis }}</p>
                                <p class="text-muted">{{ $siswa->kelas->nama_kelas }}</p>
                                <p class="text-muted">{{ $siswa->kelas->kelas }} - {{ $siswa->jurusan->jurusan }}</p>
                                <p class="text-muted">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
                            </div>

                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h5 class="col-md-6 fw-bold">Rekap Presensi</h5>
                                <div class="col-md-6">
                                    <div class="row d-flex justify-content-end">
                                        <div class="form-group col-md-3">
                                            <label for="filter">Bulan</label>
                                            <select class="form-select" id="filter">
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="filter">Tahun</label>
                                            <select class="form-select" id="filter">
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive px-4">
                            <table class="table table-hover table-bordered"
                                id={{ $presensi->isEmpty() ? '' : 'detailTables' }}>
                                <thead>
                                    <tr>
                                        <th width='2%'>No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Sholat</th>
                                        <th>Waktu Sholat</th>
                                        <th>Jam Sholat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($presensi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->jenis_sholat }}</td>
                                            <td>{{ $item->waktu_sholat }}</td>
                                            <td>{{ $item->jam_sholat }}</td>
                                            <td>
                                                @if ($item->status == 'Sholat Tepat Waktu')
                                                    <span class="badge bg-label-success">Sholat Tepat Waktu</span>
                                                @elseif ($item->status == 'Sholat')
                                                    <span class="badge bg-label-warning">Sholat</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Grafik Presensi Sholat</h6>
                            </div>
                            <div class="card-body">
                                <div id="chart-presensi"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Grafik Persentase Presensi Sholat</h6>
                            </div>
                            <div class="card-body">
                                <div id="chart-persentase"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }} --}}
    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables/datatables.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with your table ID
            $('#detailTables').DataTable({
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
