<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('backoffice/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('import/assets/img/sycma_favicon.png') }}" />

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
    <link rel="stylesheet" href="{{ asset('backoffice/assets/css/wizard.css') }}">
    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('backoffice/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('backoffice/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('backoffice/assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('backoffice/assets/js/config.js') }}"></script>
    {{-- <script src="{{ asset('backoffice/assets/vendor/libs/jquery/jquery.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Content -->
    @yield('content')
    <!-- / Content -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('backoffice/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backoffice/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backoffice/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('backoffice/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('backoffice/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        // JavaScript
        document.getElementById('formFile').addEventListener('change', function(event) {
            const fileInput = event.target;
            const imagePreview = document.getElementById('imagePreview');

            if (fileInput.files.length > 0) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Create an image element and set its source to the data URL
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-preview');
                    img.classList.add('mt-2');
                    img.width = 200;

                    // Clear previous preview and append the new image preview
                    imagePreview.innerHTML = '';
                    imagePreview.appendChild(img);
                };

                // Baca file yang sudah dipilih dari inputan
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                // kosongkan ketika tidak ada file yang dipilih
                imagePreview.innerHTML = '';
            }
        });
    </script>
</body>

</html>
