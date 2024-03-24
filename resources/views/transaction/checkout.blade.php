<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('backoffice/../assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', 'Checkout - Sycma Attendance')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('backoffice/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backoffice/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backoffice/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backoffice/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('backoffice/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('backoffice/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ asset('backoffice/DataTables/datatables.min.css') }}" />
    <script src="DataTables/datatables.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('backoffice/libs/datatables/datatables.min.css') }}">
    <script src="{{ asset('backoffice/libs/datatables/datatables.min.js') }}"></script>

    <!-- Apex Chart -->
    <link rel="stylesheet" href="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Helpers -->
    <script src="{{ asset('backoffice/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('backoffice/assets/js/config.js') }}"></script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="card">
                <div class="card-body">
                    <div class="misc-wrapper " style="padding-top: 3em">
                        <h1 class="mb-2 mx-2  font-weight-bold" style="font-size:3em">Informasi Checkout
                        </h1>
                        <p class="mb-4 mx-2 ">Silahkan cek kembali informasi paket anda</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="form-group">
                                    <label for="phone">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama_product"
                                        value="{{ $product->nama_product }}" disabled>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="form-group">
                                    <label for="package">Harga Produk</label>
                                    <input type="text" class="form-control" id="harga"
                                        value="Rp. {{ number_format($product->harga, 0, ',', '.') }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="button-group">
                            <button type="submit" id="pay-button" class="btn btn-success">Bayar</button>
                            <a href="{{ route('dashboard-admin.index') }}" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('backoffice/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('backoffice/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backoffice/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backoffice/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('backoffice/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('backoffice/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('backoffice/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('backoffice/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- JQUERY --}}
    <script src="{{ asset('backoffice/assets/js/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    {{-- DataTables --}}
    {{-- <script src="{{ asset('backoffice/DataTables/datatables.min.js') }}"></script>
     --}}
    <script src="{{ asset('backoffice/libs/datatables/datatables.min.js') }}"></script>

    {{-- Apex Chart --}}
    <script src="{{ asset('backoffice/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script> --}}
    <script>
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $payment->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href = '{{ route('checkout-success', $payment->id) }}';
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
    @stack('scripts')
</body>

</html>
