@extends('dashboard.layouts.main')
@section('title', 'Presensi Sholat - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0 card-header">Rekapitulasi Presensi Sholat</h4>
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
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Sholat Dzuhur</th>
                                <th>Total</th>
                                <th width="14%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensi as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->kelas }}</td>
                                    <td>{{ $data->jurusan }}</td>
                                    <td>{{ $data->sholat_dzuhur }}</td>
                                    <td>{{ $data->total }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#detailModal_{{ $loop->index + 1 }}">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal_{{ $loop->index + 1 }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal_{{ $loop->index + 1 }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{-- <a href="{{ route('admin.presensi.export', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                        class="btn btn-success">Export Excel</a> --}}
                    <a href="#" class="btn btn-success">Export Excel</a>
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

    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backoffice/js/chartPresensi.js') }}"></script>
@endsection
