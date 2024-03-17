@extends('dashboard.layouts.main')
@section('title', 'Guru - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card mb-2" style="background: #fbfbfb">
                <h4 class="font-weight-bold py-3 mb-0 card-header text-dark">Guru {{ $sekolah->nama_sekolah }}</h4>
                <div class="col-lg-12 mb-2 order-0">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <span class="fw-semibold d-block">Total Data Guru</span>
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                                alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <h3 class="card-title mb-2 me-2">{{ $totalGuru }}</h3>
                                        <small class="text-secondary fw-light text-middle mt-2">
                                            Guru</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <span class="fw-semibold d-block">Total Guru Laki-Laki</span>
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                                alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <h3 class="card-title mb-2 me-2">{{ $totalGuruLaki }}</h3>
                                        <small class="text-secondary fw-light text-middle mt-2">
                                            Guru</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <span class="fw-semibold d-block">Total Guru Perempuan</span>
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('backoffice/assets/img/icons/unicons/chart-success.png') }}"
                                                alt="chart success" class="rounded">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <h3 class="card-title mb-2 me-2">{{ $totalGuruPerempuan }}</h3>
                                        <small class="text-secondary fw-light text-middle mt-2">
                                            Guru</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <h6 class="card-header fw-bold">Data Guru</h6>
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-3 align-items-center">
                        {{-- <div class="col-md-6">
                            <form action="{{ route('cari-guru') }}" method="GET"
                                class="d-flex align-items-center form-control" id="searchForm">
                                @csrf
                                <i class="bx bx-search fs-4 lh-0 "></i>
                                <input type="search" class="form-control border-0 shadow-none me-2" name="search"
                                    placeholder="Search..." aria-label="Search" value="{{ request('search') }}">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <button type="button" class="btn btn-icon btn-outline-secondary" id="clearSearch">
                                        <span style="cursor: pointer; color: #007bff;">&times;</span>
                                    </button>
                                </div>
                            </form>
                        </div> --}}
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                data-bs-target="#tambahModal">
                                <i class="bx bx-plus"></i> Guru
                            </button>
                        </div>
                    </div>

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
                    <table class="table table-bordered table-hover mb-4" id="guruTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Handphone</th>
                                <th>Jenis Kelamin</th>
                                <th>NIP</th>
                                <th width='11%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $g)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $g->nama_lengkap }}</td>
                                    <td>{{ $g->email }}</td>
                                    <td>{{ $g->no_hp }}</td>
                                    <td>{{ $g->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    <td>{{ $g->nip }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal_{{ $g->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal_{{ $g->id }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Tambah Modal -->
    <div class="modal
        fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nameBasic" class="form-label">Sekolah</label>
                            <input type="text" id="nameBasic" class="form-control" name="sekolah"
                                value="{{ $sekolah->nama_sekolah ?? '' }}" readonly />
                            <!-- Tambahkan input tersembunyi untuk menyimpan 'sekolah_id' -->
                            <input type="hidden" name="sekolah_id" value="{{ $sekolah->id ?? '' }}" />
                            @error('sekolah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nameBasic" class="form-label">Nama</label>
                                    <input type="text" id="nameBasic" class="form-control" name="nama_lengkap" />
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailBasic" class="form-label">Email</label>
                                    <input type="email" id="emailBasic" class="form-control" name="email" />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="noHp" class="form-label">No. Handphone</label>
                            <input type="text" id="noHp" class="form-control" name="no_hp" />
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jenisKelamin" class="form-label">Jenis
                                        Kelamin</label>
                                    <select class="form-select" id="jenisKelamin" name="jenis_kelamin">
                                        <option selected disabled>Pilih Jenis Kelamin
                                        </option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" id="nip" class="form-control" name="nip" />
                                    @error('nip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @foreach ($guru as $item)
        <div class="modal fade" id="editModal_{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data Guru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('guru.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="sekolah" class="form-label">Sekolah</label>
                                <input type="text" id="sekolah" class="form-control" name="sekolah"
                                    value="{{ $sekolah->nama_sekolah ?? '' }}" readonly />
                                <input type="hidden" name="sekolah_id" value="{{ $sekolah->id ?? '' }}" />
                                @error('sekolah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama</label>
                                        <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap"
                                            value="{{ $item->nama_lengkap }}" />
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" class="form-control" name="email"
                                            value="{{ $item->email }}" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. Handphone</label>
                                <input type="text" id="no_hp" class="form-control" name="no_hp"
                                    value="{{ $item->no_hp }}" />
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option disabled>Pilih Jenis Kelamin</option>
                                            <option value="L" {{ $item->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P" {{ $item->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" id="nip" class="form-control" name="nip"
                                            value="{{ $item->nip }}" />
                                        @error('nip')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Hapus Modal -->
    @foreach ($guru as $item)
        <div class="modal fade" id="hapusModal_{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('guru.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="row">
                                <div class="align-items-center text-center">
                                    <i class="bx bx-trash text-danger mb-1"
                                        style="font-size: 2em; background-color: #ffcccc; padding: 10px; border-radius: 50%;"></i>
                                    <p class="text-center"><strong>Menghapus data jurusan
                                            {{ $item->jurusan }}</strong><br>anda yakin ingin menghapus data ini?
                                    </p>
                                </div>
                                <div class="align-items-center text-left">
                                    <label for="nama_lengkap" class="form-label">Ketik :
                                        {{ $item->nama_lengkap }}</label>
                                    <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" />
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with your table ID
            $('#guruTable').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search/filtering
            });
        });
    </script>


@endsection
