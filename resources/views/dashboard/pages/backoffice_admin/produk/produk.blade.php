@extends('dashboard.layouts.backoffice')
@section('title', 'Backoffice Admin - Produk')

@section('backoffice-content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                            <p class="mb-4">
                                You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                your profile.
                            </p>
                            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('backoffice/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <span class="fw-semibold d-block">Produk Hardware</span>
                                <i class='bx bxs-hdd'></i>
                            </div>
                            <div class="d-flex">
                                <h3 class="card-title mb-2 me-2">{{ $hardwareProductsCount }}</h3>
                                <small class="text-secondary fw-light text-middle mt-2">
                                    Total</small>
                            </div>
                            <a href="{{ route('produk.index', ['category' => 1]) }}"
                                class="btn btn-sm btn-outline-primary">Lihat Produk</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <span class="fw-semibold d-block">Produk Software</span>
                                <i class='bx bx-code-block'></i>
                            </div>
                            <div class="d-flex">
                                <h3 class="card-title mb-2 me-2">{{ $softwareProductsCount }}</h3>
                                <small class="text-secondary fw-light text-middle mt-2">
                                    Total</small>
                            </div>
                            <a href="{{ route('produk.index', ['category' => 2]) }}"
                                class="btn btn-sm btn-outline-primary">Lihat Produk</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-12 col-md-6 order-1">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses! Data berhasil ditambahkan</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        {{-- Table Produk --}}
        <div class="col-lg-12 col-md-12 order-1">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}"
                            class="nav-link {{ Request::is('backoffice-sycma/produk*') ? 'active' : '' }}" role="tab"
                            aria-controls="navs-top-home" aria-selected="false">
                            <i class="tf-icons bx bx-archive"></i>
                            Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}"
                            class="nav-link {{ Request::is('backoffice-sycma/category*') ? 'active' : '' }}" role="tab"
                            aria-controls="navs-top-profile" aria-selected="false">
                            <i class="tf-icons bx bx-layer"></i>
                            Categories
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ Request::is('backoffice-sycma/produk*') ? 'active show' : '' }} "
                        id="navs-top-home" role="tabpanel">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="">List Keseluruhan data produk</h5>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="card-header col-lg-6 col-md-3">
                                <div class="nav-item d-flex align-items-center form-control">
                                    <i class="bx bx-search fs-4 lh-0"></i>
                                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                                        aria-label="Nama Siswa">
                                </div>
                            </div>
                            <div class="card-header col-md-6 text-end">
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#tambahModalProduk">
                                    <i class="bx bx-plus"></i> Produk
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Category</th>
                                            <th width="20%">Deskripsi</th>
                                            <th>Gambar</th>
                                            <th>Harga</th>
                                            <th>Diskon</th>
                                            <th>Pajak</th>
                                            <th width="11%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->kode_product }}</td>
                                                <td>
                                                    <i class="fab fa-angular fa-lg text-danger"></i>
                                                    <strong>{{ $product->nama_product }}</strong>
                                                </td>
                                                <td>
                                                    {{ $product->category->nama_category }}
                                                </td>
                                                <td width="20%" class="text-break">
                                                    {{ substr($product->deskripsi, 0, 45) }}..
                                                </td>
                                                <td>
                                                    <img src="{{ asset('backoffice/assets/img/illustrations/produk.png') }}"
                                                        alt="Produk" width="50" height="50">
                                                </td>
                                                <td>
                                                    <strong>Rp. {{ number_format($product->harga, 0, ',', '.') }}</strong>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-label-danger me-1">{{ intval($product->diskon) }}%</span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge bg-label-warning me-1">{{ intval($product->diskon) }}%</span>
                                                </td>


                                                <td>
                                                    <div class="col-sm-3">
                                                        <button type="button" class="btn btn-info btn-sm mb-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showModal_{{ $loop->index + 1 }}">
                                                            <i class="bx bx-show"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-warning btn-sm mb-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal_{{ $loop->index + 1 }}">
                                                            <i class="bx bx-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm mb-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#hapusModal_{{ $loop->index + 1 }}">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ Request::is('backoffice-sycma/category*') ? 'active show' : '' }} "
                        id="navs-top-profile" role="tabpanel">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="">List Keseluruhan data produk</h5>

                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                data-bs-target="#tambahModalCategory">
                                <i class="bx bx-plus"></i> Category
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Kode Category</th>
                                            <th>Nama Category</th>
                                            <th width="11%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->kode_category }}</td>
                                                <td>{{ $category->nama_category }}</td>
                                                <td> <button type="button" class="btn btn-warning btn-sm mb-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModalCategory_{{ $loop->index + 1 }}">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm mb-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusModal_{{ $loop->index + 1 }}">
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
        </div>
    </div>

    {{-- Tambah Data Produk --}}
    <div class="modal fade" id="tambahModalProduk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="kodeBasic" class="form-label">Kode Product</label>
                                <input type="text" id="kodeBasic"
                                    class="form-control @error('kode_category') is-invalid @enderror" name="kode_product"
                                    placeholder="Masukkan kode product" value="SYC-" />
                                @error('kode_category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="categorySelect" class="form-label">Category</label>
                                <select id="categorySelect" class="form-select @error('category') is-invalid @enderror"
                                    name="category_id">
                                    <option value="" selected disabled>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="productNameBasic" class="form-label">Nama Product</label>
                                <input type="text" id="productNameBasic"
                                    class="form-control @error('nama_product') is-invalid @enderror" name="nama_product"
                                    placeholder="Masukkan nama product" value="{{ old('nama_product') }}" />
                                @error('nama_product')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descriptionBasic" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="2" class="form-control">
                                </textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="imageBasic" class="form-label">Gambar</label>
                                <input type="file" id="imageBasic" class="form-control" name="image" />
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="priceInput" class="form-label">Harga</label>
                                <input type="text" id="priceInput"
                                    class="form-control currency-input @error('harga') is-invalid @enderror"
                                    name="harga" placeholder="Masukkan harga product" value="{{ old('harga') }}" />
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="taxInput" class="form-label">Pajak (%)</label>
                                <input type="number" id="taxInput"
                                    class="form-control @error('pajak') is-invalid @enderror" name="pajak"
                                    placeholder="Masukkan pajak product" value="{{ old('pajak') }}" min="0" />
                                @error('pajak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="discountInput" class="form-label">Diskon (%)</label>
                                <input type="number" id="discountInput"
                                    class="form-control @error('diskon') is-invalid @enderror" name="diskon"
                                    placeholder="Masukkan diskon product" value="{{ old('diskon') }}" min="0" />
                                @error('diskon')
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

    {{-- SHOW DATA PRODUK --}}
    @foreach ($products as $product)
        <div class="modal fade" id="showModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Detail Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name"
                                        value="{{ $product->nama_product }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-category">Category</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-category"
                                        value="{{ $product->category->nama_category }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-description">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="basic-default-description" readonly>{{ $product->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-price">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control currency-input" id="basic-default-price"
                                        value="{{ $product->harga }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-tax">Pajak (%)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-tax"
                                        value="{{ intval($product->pajak) }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-discount">Diskon (%)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-discount"
                                        value="{{ intval($product->diskon) }}" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal_{{ $loop->index + 1 }}">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Edit Data Produk --}}
    @foreach ($products as $product)
        <div class="modal fade" id="editModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('produk.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- <input type="hidden" name="debug_info" value="{{ json_encode($product) }}"> --}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="kodeBasic" class="form-label">Kode Product</label>
                                    <input type="text" id="kodeBasic"
                                        class="form-control @error('kode_product') is-invalid @enderror"
                                        name="kode_product" placeholder="Masukkan kode product"
                                        value="{{ $product->kode_product }}" />
                                    @error('kode_product')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="categorySelect" class="form-label">Category</label>
                                    <select id="categorySelect"
                                        class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                        <option value="" selected disabled>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->nama_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="productNameBasic" class="form-label">Nama Product</label>
                                    <input type="text" id="productNameBasic"
                                        class="form-control @error('nama_product') is-invalid @enderror"
                                        name="nama_product" placeholder="Masukkan nama product"
                                        value="{{ $product->nama_product }}" />
                                    @error('nama_product')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="descriptionBasic" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="4" class="form-control">{{ $product->deskripsi }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="priceInput" class="form-label">Harga</label>
                                    <input type="text" id="priceInput"
                                        class="form-control currency-input @error('harga') is-invalid @enderror"
                                        name="harga" placeholder="Masukkan harga product"
                                        value="{{ $product->harga }}" />
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="taxInput" class="form-label">Pajak (%)</label>
                                    <input type="number" id="taxInput"
                                        class="form-control @error('pajak') is-invalid @enderror" name="pajak"
                                        placeholder="Masukkan pajak product" value="{{ intval($product->pajak) }}"
                                        min="0" />
                                    @error('pajak')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="discountInput" class="form-label">Diskon (%)</label>
                                    <input type="number" id="discountInput"
                                        class="form-control @error('diskon') is-invalid @enderror" name="diskon"
                                        placeholder="Masukkan diskon product" value="{{ intval($product->diskon) }}"
                                        min="0" />
                                    @error('diskon')
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

    <!-- Hapus PRODUCT -->
    @foreach ($products as $product)
        <div class="modal fade" id="hapusModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <div class="modal-body">
                            <div class="row">
                                <div class="align-items-center text-center">
                                    <i class="bx bx-trash text-danger mb-1"
                                        style="font-size: 2em; background-color: #ffcccc; padding: 10px; border-radius: 50%;"></i>
                                    <p class="text-center"><strong>Menghapus Data Product
                                            {{ $product->nama_product }}</strong><br>anda yakin ingin menghapus data ini?
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

    {{-- Tambah Data Category --}}
    <div class="modal fade" id="tambahModalCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Kode Category</label>
                                <input type="text" id="nameBasic" class="form-control" name="kode_category"
                                    placeholder="Masukkan nama jurusan" />
                                @error('kode_category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Nama Category</label>
                                <input type="text" id="nameBasic" class="form-control" name="nama_category"
                                    placeholder="Masukkan nama jurusan" />
                                @error('nama_category')
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

    {{-- Edit Data Category --}}
    @foreach ($categories as $category)
        <div class="modal fade" id="editModalCategory_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">List Seluruh Data Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Kode Category</label>
                                    <input type="text" id="nameBasic" class="form-control" name="kode_category"
                                        placeholder="Masukkan nama jurusan" value="{{ $category->kode_category }}" />
                                    @error('kode_category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Nama Category</label>
                                    <input type="text" id="nameBasic" class="form-control" name="nama_category"
                                        placeholder="Masukkan nama jurusan" value="{{ $category->nama_category }}" />
                                    @error('nama_category')
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
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Hapus Modal -->
    @foreach ($categories as $category)
        <div class="modal fade" id="hapusModal_{{ $loop->index + 1 }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="row">
                                <div class="align-items-center text-center">
                                    <i class="bx bx-trash text-danger mb-1"
                                        style="font-size: 2em; background-color: #ffcccc; padding: 10px; border-radius: 50%;"></i>
                                    <p class="text-center"><strong>Menghapus Data Category
                                            {{ $category->nama_category }}</strong><br>anda yakin ingin menghapus data ini?
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Remove currency format before form submission
            $('form').submit(function() {
                $('.currency-input').each(function() {
                    var numericValue = $(this).val().replace(/\D/g,
                        ''); // Remove non-numeric characters
                    $(this).val(numericValue);
                });
            });

            // Format currency on input change
            $('.currency-input').on('input', function() {
                var value = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                $(this).val(formatCurrency(value));
            });

            // Format currency on page load
            $('.currency-input').each(function() {
                var value = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                $(this).val(formatCurrency(value));
            });

            function formatCurrency(value) {
                return 'Rp' + Number(value).toLocaleString('id-ID');
            }
        });
    </script>

@endsection
