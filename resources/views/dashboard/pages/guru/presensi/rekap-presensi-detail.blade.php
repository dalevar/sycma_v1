@extends('dashboard.layouts.guru')
@section('title', 'Presensi Sholat - Sycma Attendance')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a
                href="{{ route('rekap-presensi-guru.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                class="text-muted fw-light">Rekap Presensi
                /</a> {{ $siswa->nama_lengkap }}
        </h4>
        <ul class="nav nav-pills flex-column flex-md-row mb-3 gap-2">
            <li class="nav-item">
                <a class="btn btn-outline-primary"
                    href="{{ route('rekap-presensi-guru.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}"><i
                        class="bx bx-book-content"></i> Rekap Presensi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active"><i class="bx bx-face me-1"></i>
                    Detail Siswa</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row">
                            <h5 class="col-md-6">Detail Data Siswa</h5>
                        </div>
                    </div>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('backoffice/assets/img/avatars/admin.png') }}" alt="user-avatar"
                                class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="flex-grow-1">
                                <h5 class="mb-1">{{ $siswa->nama_lengkap }}</h5>
                                <input type="hidden" id="siswa" name="siswa_id" value={{ $siswa->id }}>
                                <p class="text-muted">{{ $siswa->nis }}</p>
                                <p class="text-muted">{{ $siswa->kelas->nama_kelas }}</p>
                                <p class="text-muted">{{ $siswa->kelas->kelas }} - {{ $siswa->jurusan->jurusan }}</p>
                                <p class="text-muted">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
                            </div>
                            <div class="d-flex justify-content-center ">
                                <div id="chart-persentase" class="pb-5"></div>
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
                                            <select class="form-select" id="bulan" name="bulan" onchange="getData()">
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $bulan == $i ? 'selected' : '' }}>
                                                        {{ $bulanIndonesia[$i] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="filter">Tahun</label>
                                            <select class="form-select" id="tahun" name="tahun" onchange="getData()">
                                                @for ($i = 2023; $i <= date('Y'); $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $tahun == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
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
                                    @if ($presensi->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data presensi</td>
                                        </tr>
                                    @else
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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script> --}}
    <script src="{{ asset('backoffice/libs/datatables/datatables.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Fungsi untuk mengambil data presensi dengan Ajax
        function getData() {
            var bulan = document.getElementById('bulan').value; // Ambil nilai bulan dari opsi yang dipilih
            var tahun = document.getElementById('tahun').value; // Ambil nilai tahun dari opsi yang dipilih
            var siswaId = document.getElementById('siswa').value;

            // Buat URL dengan bulan, tahun, dan id siswa yang dipilih
            var url = "/rekap-presensi/" + siswaId + "/" + bulan + "/" + tahun;

            // Kirim permintaan Ajax ke URL yang sesuai
            $.ajax({
                url: url, // URL ke controller untuk mengambil data
                method: "GET", // Metode HTTP yang digunakan
                success: function(response) { // Ketika permintaan berhasil
                    // Memperbarui URL
                    window.location.href = url;
                },
                error: function(xhr, status, error) { // Ketika terjadi kesalahan dalam permintaan
                    console.error(xhr.responseText); // Tampilkan pesan kesalahan di konsol
                }
            });
        }

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

    <script>
        var options = {
            series: [{{ $presensi->count() }}],
            chart: {
                height: 200,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    }
                },
            },
            labels: ['Presensi'],
        };

        var chart = new ApexCharts(document.querySelector("#chart-persentase"), options);
        chart.render();
    </script>
@endsection
