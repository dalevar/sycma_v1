@extends('dashboard.layouts.main')
@section('title', 'Kelas - Sycma Attendance')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0 card-header">Kelas {{ $sekolah->nama_sekolah }}</h4>
        <div class="card mb-4">
            <h6 class="card-header fw-bold">Data Kelas</h6>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="bx bx-plus"></i> Kelas
                    </button>
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
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th width='5%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->jurusan->jurusan }}</td>
                                    <td>
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
                    {{-- {{ $jurusan->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Kelas {{ $sekolah->nama_sekolah ?? '' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="sekolah_id" value="{{ $sekolah->id ?? '' }}" />
                    @error('sekolah_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Kelas</label>
                                <input type="text" id="nameBasic" class="form-control" name="kelas"
                                    placeholder="Masukkan kelas" />
                                @error('kelas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Jurusan</label>
                                <select class="form-select" name="jurusan_id">
                                    <option selected>Pilih Jurusan</option>
                                    @foreach ($jurusan as $item)
                                        <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @foreach ($kelas as $item)
        <div class="modal fade" id="editModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kelas.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Kelas</label>
                                    <input type="text" id="nameBasic" class="form-control" name="kelas"
                                        value="{{ $item->kelas }}" />
                                    @error('kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Jurusan</label>
                                    <select class="form-select" name="jurusan_id">
                                        <option selected>Pilih Jurusan</option>
                                        @foreach ($jurusan as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($data->id == $item->jurusan_id) selected @endif>
                                                {{ $data->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jurusan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
    @endforeach

    <!-- Hapus Modal -->
    @foreach ($kelas as $item)
        <div class="modal fade" id="hapusModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kelas.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="row">
                                <div class="align-items-center text-center">
                                    <i class="bx bx-trash text-danger mb-1"
                                        style="font-size: 2em; background-color: #ffcccc; padding: 10px; border-radius: 50%;"></i>
                                    <p class="text-center"><strong>Menghapus data jurusan
                                            {{ $item->kelas }}</strong><br>anda yakin ingin menghapus data ini?
                                    </p>
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
@endsection
