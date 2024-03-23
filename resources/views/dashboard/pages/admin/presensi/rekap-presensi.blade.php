@extends('dashboard.layouts.main')
@section('title', 'Presensi Sholat - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0 card-header">Rekapitulasi Presensi Sholat</h4>
        <div class="card mb-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-header ">
                        <h6 class="fw-bold">Data Presensi Sholat</h6>
                        <small class="text-muted pb-3">Rekap Presensi : {{ date('M') }} - {{ date('Y') }}</small>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="d-flex justify-content-end align-items-center mt-4 mx-4">
                        {{-- <a href="{{ route('admin.presensi.export', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                            class="btn btn-success">Export Excel</a> --}}
                        <a href="#" class="btn btn-success">Export Excel</a>
                    </div>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <option value="1" {{ $bulan == 1 ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ $bulan == 2 ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ $bulan == 3 ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ $bulan == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ $bulan == 5 ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ $bulan == 6 ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ $bulan == 7 ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ $bulan == 8 ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ $bulan == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ $bulan == 10 ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ $bulan == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ $bulan == 12 ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun">Pilih Tahun</label>
                            <select class="form-select" id="tahun" name="tahun">
                                @for ($i = 2021; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive my-3">
                    <table class="table table-striped table-bordered table-hover"
                        id={{ $presensi->isEmpty() ? '' : 'rekapTables' }}>
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th>Nama</th>
                                <th width="5%">Kelas</th>
                                <th>Jurusan</th>
                                <th width="16%">Total Sholat Dzuhur</th>
                                <th width="14%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Buat array kosong untuk menyimpan data presensi per siswa
                                $presensiPerSiswa = [];

                                // Iterasi melalui data presensi
                                foreach ($presensi as $data) {
                                    // Ambil id siswa
                                    $siswaId = $data->siswa_id;

                                    // Jika siswa belum ada dalam array presensiPerSiswa, tambahkan dengan jumlah presensi 1
                                    if (!isset($presensiPerSiswa[$siswaId])) {
                                        $presensiPerSiswa[$siswaId] = 1;
                                    } else {
                                        // Jika siswa sudah ada dalam array, tambahkan jumlah presensinya
                                        $presensiPerSiswa[$siswaId]++;
                                    }
                                }
                            @endphp

                            @foreach ($presensiPerSiswa as $siswaId => $jumlahPresensi)
                                @php
                                    // Ambil data siswa berdasarkan id
                                    $siswa = $siswa->where('id', $siswaId)->first();
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama_lengkap }}</td>
                                    <td class="text-center">{{ $siswa->kelas->kelas }}</td>
                                    <td>{{ $siswa->jurusan->jurusan }}</td>
                                    <td>{{ $jumlahPresensi }}</td>
                                    <td>
                                        <a href="{{ url('rekap-presensi', $siswa->id) }}" class="btn btn-info btn-sm mb-2">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal_{{ $siswaId }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal_{{ $siswaId }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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
            $('#rekapTables').DataTable({
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
