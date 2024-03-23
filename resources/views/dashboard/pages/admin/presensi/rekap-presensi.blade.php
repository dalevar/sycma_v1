@extends('dashboard.layouts.main')
@section('title', 'Presensi Sholat - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Rekap Presensi
        </h4>
        <ul class="nav nav-pills flex-column flex-md-row mb-3 gap-2">
            <li class="nav-item">
                <a class="nav-link active"><i class="bx bx-book-content"></i> Rekap Presensi</a>
            </li>
            <li class="nav-item">
                <button disabled class="btn btn-outline-primary"><i class="bx bx-face me-1"></i>
                    Detail Siswa</button>
            </li>
        </ul>
        <div class="card mb-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-header ">
                        <h6 class="fw-bold">Data Presensi Sholat</h6>
                        <small class="text-muted pb-3">Rekap Presensi : {{ $namaBulan }} - {{ $tahun }}</small>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="bulan">Pilih Bulan</label>
                            <select class="form-select" id="bulan" name="bulan" onchange="getData()">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                        {{ $bulanIndonesia[$i] }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="tahun">Pilih Tahun</label>
                            <select class="form-select" id="tahun" name="tahun" onchange="getData()">
                                @for ($i = 2023; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 text-end">
                        <div class="d-flex justify-content-end align-items-end mt-4">
                            {{-- <a href="{{ route('admin.presensi.export', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                                class="btn btn-success">Export Excel</a> --}}
                            <form action="{{ route('presensi.export') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Export Excel</button>
                            </form>
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
                                <th>Jenis Kelamin</th>
                                <th width="5%">Kelas</th>
                                <th>Jurusan</th>
                                <th width="16%">Total Sholat Dzuhur</th>
                                <th width="4%">Aksi</th>
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

                            @if (count($presensiPerSiswa) == 0)
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data presensi</td>
                                </tr>
                            @else
                                @foreach ($presensiPerSiswa as $siswaId => $jumlahPresensi)
                                    @php
                                        // Ambil data siswa berdasarkan id
                                        $siswa = \App\Models\Siswa::find($siswaId);
                                    @endphp
                                    @if ($siswa)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $siswa->nama_lengkap }}</td>
                                            <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td class="text-center">{{ $siswa->kelas->kelas }}</td>
                                            <td>{{ $siswa->jurusan->jurusan }}</td>
                                            <td>{{ $jumlahPresensi }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('rekap-presensi-detail.index', ['siswa' => $siswa->id, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                                    class="btn btn-info btn-sm mb-2">
                                                    <i class="bx bx-show"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Grafik Presensi Sholat</h6>
                        <p class="text-muted">Presensi : Senin - Kamis</p>
                    </div>
                    <div class="card-body">
                        <div id="chart-presensi"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }} --}}
    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script> --}}
    <script src="{{ asset('backoffice/libs/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Fungsi untuk mengambil data presensi dengan Ajax
        function getData() {
            var bulan = document.getElementById('bulan').value; // Ambil nilai bulan dari opsi yang dipilih
            var tahun = document.getElementById('tahun').value; // Ambil nilai tahun dari opsi yang dipilih

            // Buat URL dengan bulan dan tahun yang dipilih
            var url = "/rekap-presensi/" + bulan + "/" + tahun;

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

    {{-- GRAFIK PRESENSI SHOLAT --}}
    <script>
        var options = {
            series: [{
                name: "Presensi Sholat",
                data: <?php echo json_encode($dataGrafik); ?>
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                type: 'datetime',
                categories: <?php echo json_encode($tanggalBulanFormat); ?>,
            },
            yaxis: {
                title: {
                    text: 'Jumlah Presensi'
                },
                // labels: {
                //     formatter: function(val) {
                //         return parseInt(val).toFixed(0);
                //     }
                // }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-presensi"), options);
        chart.render();
    </script>
@endsection
