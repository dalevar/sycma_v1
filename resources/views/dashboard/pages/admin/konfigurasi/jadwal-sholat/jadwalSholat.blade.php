@extends('dashboard.layouts.main')
@section('title', 'Jadwal Sholat - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0 card-header">Jadwal Sholat Wilayah Banjarmasin</h4>
        <div class="card mb-4">
            <h6 class="card-header fw-bold">Data Jadwal Sholat</h6>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="bx bx-plus"></i> Jadwal Sholat
                    </button> --}}
                </div>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th colspan="4" width='12%'>Jenis Sholat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="fw-bold fs-2">Dzuhur</td>
                            </tr>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col" width="10%">Waktu Sholat</th>

                            </tr>
                            @foreach ($jadwalSholat as $index => $js)
                                <tr>
                                    {{-- <td @if ($js->jenis_sholat == 'Dzuhur' && $index > 0) style="display: none;" @endif
                                        rowspan="{{ $js->jenis_sholat == 'Dzuhur' ? count($jadwalSholat) : 1 }}"
                                        class="fw-bold fs-2">
                                        {{ $js->jenis_sholat }}
                                    </td> --}}
                                    <td>{{ $js->tanggal }}</td>
                                    <td>{{ $js->waktu_sholat }}</td>
                                    {{-- <td>
                                        <button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal_{{ $index }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal_{{ $js->$index }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
