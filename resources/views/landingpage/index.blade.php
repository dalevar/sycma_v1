@extends('landingpage.layouts.main')
<!-- ======= Hero Section ======= -->
@include('landingpage.partials.hero')
<!-- End Hero -->
@section('main')
    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
        <div class="container">
            <div class="row" data-aos="zoom-in">
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('import/assets/img/clients/isfi-favicon.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('import/assets/img/clients/isfi-favicon.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('import/assets/img/clients/isfi-logo.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('import/assets/img/clients/isfi-logo.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('import/assets/img/clients/isfi-favicon.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('import/assets/img/clients/isfi-favicon.png') }}" class="img-fluid" alt="">
                </div>

            </div>
        </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Tentang Kami</h2>
            </div>

            <div class="row content">
                <div class="col-lg-6">
                    <p>
                        Menjadi perusahaan teknologi pendidikan terdepan di Indonesia yang memberikan solusi yang inovatif
                        dan efektif untuk meningkatkan kualitas pendidikan.
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> Membantu siswa belajar dan berkembang dengan lebih efektif.
                        </li>
                        <li><i class="ri-check-double-line"></i> Mempermudah kerja guru dan staf sekolah.
                        </li>
                        <li><i class="ri-check-double-line"></i> Meningkatkan transparansi dan akuntabilitas dalam
                            pendidikan.
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <p>SYCMA Attendance adalah perusahaan teknologi yang berfokus pada pengembangan sistem manajemen
                        kehadiran sekolah. Kami percaya bahwa kehadiran siswa merupakan salah satu aspek penting dalam
                        pendidikan. Dengan kehadiran yang baik, siswa dapat mengikuti pembelajaran dengan optimal dan
                        mencapai hasil belajar yang maksimal.</p>
                    <a href="{{ url('tentang') }}" class="btn-learn-more">Pelajari</a>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                    <div class="content">
                        <h3>berbagai fitur yang dapat memudahkan<strong> Sistem Kehadiran Manajemen
                                Sekolah</strong></h3>
                        <p>
                            solusi yang tepat untuk sekolah yang ingin mengelola kehadiran siswa dengan mudah dan efisien.
                        </p>
                    </div>

                    <div class="accordion-list">
                        <ul>
                            <li>
                                <a data-bs-toggle="collapse" class="collapse"
                                    data-bs-target="#accordion-list-1"><span>01</span> Fitur Lengkap <i
                                        class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                    <p>
                                        dilengkapi dengan berbagai fitur yang dapat memudahkan sekolah dalam mengelola
                                        kehadiran siswa. Fitur-fitur tersebut meliputi absensi online, rekap kehadiran,
                                        laporan kehadiran, dan data keamanan.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2"
                                    class="collapsed"><span>02</span> Mudah digunakan
                                    <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        dirancang agar mudah digunakan oleh sekolah. Aplikasi ini memiliki antarmuka yang
                                        sederhana dan intuitif, sehingga mudah dipahami oleh pengguna.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3"
                                    class="collapsed"><span>03</span> Murah dan terjangkau
                                    <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        SYCMA Attendance menawarkan harga yang terjangkau untuk semua sekolah. Sekolah dapat
                                        berlangganan SYCMA Attendance sesuai dengan kebutuhannya.
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>

                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                    style='background-image: url("{{ asset('import/assets/img/why-us.png') }}");' data-aos="zoom-in"
                    data-aos-delay="150">&nbsp;
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>LAYANAN</h2>
                <p>menawarkan berbagai layanan untuk membantu sekolah dalam mengelola kehadiran siswa. </p>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class='bx bx-cloud-download'></i></div>
                        <h4><a href="">Instalasi dan Konfigurasi</a></h4>
                        <p>menawarkan layanan instalasi dan konfigurasi untuk membantu sekolah dalam menginstal dan
                            mengkonfigurasi aplikasi SYCMA dengan benar.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                    data-aos-delay="200">
                    <div class="icon-box">
                        <div class="icon"><i class='bx bx-support'></i></div>
                        <h4><a href="">Dukungan Teknis</a></h4>
                        <p>layanan dukungan teknis 24/7 untuk membantu sekolah dalam mengatasi masalah teknis
                            yang terjadi pada aplikasi SYCMA.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-tachometer"></i></div>
                        <h4><a href=""> Pemeliharaan dan Perbaikan</a></h4>
                        <p>layanan pemeliharaan dan perbaikan untuk membantu sekolah dalam menjaga aplikasi SYCMA
                            tetap berjalan dengan lancar. </p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                    data-aos-delay="400">
                    <div class="icon-box">
                        <div class="icon"><i class='bx bx-terminal'></i></div>
                        <h4><a href="">Integrasi dengan Sistem Lain</a></h4>
                        <p>untuk membantu sekolah dalam mengintegrasikan aplikasi SYCMA
                            dengan sistem lain yang digunakan oleh sekolah.</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">
            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                    <h3> Dapatkan akses ke semua fiturnya!</h3>
                    <p> Hubungi kami sekarang dan dapatkan informasi lebih lanjut untuk mendapatkan harga dan promo yang
                        menarik, serta konsultasi gratis dengan tim ahli kami!</p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" href="https://www.whatsapp.com/">Jadwalkan Sekarang!</a>
                </div>
            </div>

        </div>
    </section><!-- End Cta Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="produk" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>PRODUK</h2>
                <p>Selain aplikasi manajemen kehadiran siswa, kami juga memiliki produk menarik lainnya yang dapat membantu
                    sekolah dalam mengelola kegiatan belajar mengajar secara lebih efektif.</p>
            </div>

            <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-app">Hardware</li>
                <li data-filter=".filter-card">Software</li>
            </ul>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-img"><img src="{{ asset('import/assets/img/product/ARFID-2-min.png') }}"
                            class="img-fluid" alt=""></div>
                    <div class="portfolio-info">
                        <h4>Sycma ARFID</h4>
                        <p>Attendance teknologi RFID</p>
                        <a href="#" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"
                            title="Sycma ARFID: Solusi Inovatif untuk Mengelola Data Absensi dan Manajemen Sekolah
                            Sycma ARFID adalah solusi terdepan untuk absensi dan manajemen sekolah yang mudah, akurat, dan terjangkau. Platform ini dirancang untuk membantu sekolah mengotomatisasi proses absensi, mengelola data siswa, dan meningkatkan komunikasi antara sekolah, orang tua, dan siswa."><i
                                class="bx bx-info-circle"></i></a>
                        <a href="https://www.tokopedia.com/" class="details-link" title="Shop Now"><i
                                class="bx bx-shopping-bag"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-img"><img src="{{ asset('import/assets/img/product/SaaS-1-min.png') }}"
                            class="img-fluid" alt=""></div>
                    <div class="portfolio-info">
                        <h4>Ultra Attendance</h4>
                        <p>Software as a Services Integrated</p>
                        <a href="#" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"
                            title="Ultra Attendance: Solusi Absensi Modern untuk Sekolah dengan Model Software as a Service (SaaS)
                            Ultra Attendance adalah solusi absensi siswa yang modern dan efisien menggunakan model Software as a Service (SaaS). Tidak perlu instalasi software rumit, Ultra Attendance beroperasi sepenuhnya melalui internet, sehingga Anda dapat mengakses dan mengelolanya dari mana saja dan kapan saja."><i
                                class="bx bx-info-circle"></i></a>
                        <a href="https://www.whatsapp.com/" class="details-link" title="Pesan Sekarang"><i
                                class="bx bx-navigation"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-img-coming-soon"><img
                            src="{{ asset('import/assets/img/product/Fragtion-1-min.png') }}" class="img-fluid"
                            alt="">
                    </div>
                    <div class="portfolio-coming-soon">
                        <h4 clas="text-center text-light">Coming Soon</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-img-coming-soon"><img
                            src="{{ asset('import/assets/img/product/ARFID-3-min.png') }}" class="img-fluid"
                            alt="">
                    </div>
                    <div class="portfolio-coming-soon">
                        <h4 clas="text-center text-light">Coming Soon</h4>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-img-coming-soon"><img
                            src="{{ asset('import/assets/img/product/ARFID-4-min.png') }}" class="img-fluid"
                            alt="">
                    </div>
                    <div class="portfolio-coming-soon">
                        <h4 clas="text-center text-light">Coming Soon</h4>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-img-coming-soon"><img
                            src="{{ asset('import/assets/img/product/Barac-1-min.png') }}" class="img-fluid"
                            alt="">
                    </div>
                    <div class="portfolio-coming-soon">
                        <h4 clas="text-center text-light">Coming Soon</h4>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-img-coming-soon"><img
                            src="{{ asset('import/assets/img/product/Fragtion-3-min.png') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-coming-soon">
                        <h4 clas="text-center text-light">Coming Soon</h4>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-img-coming-soon"><img
                            src="{{ asset('import/assets/img/product/SaaS-7-min.png') }}" class="img-fluid"
                            alt=""></div>
                    <div class="portfolio-coming-soon">
                        <h4 clas="text-center text-light">Coming Soon</h4>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>FAQ</h2>
                <p>Frequently Asked Questions</p>
            </div>

            <div class="faq-list">
                <ul>
                    <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                            data-bs-target="#faq-list-1">Apa itu SYCMA Attendance?<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                            <p>
                                SYCMA Attendance adalah solusi yang tepat untuk sekolah yang ingin mengelola kehadiran siswa
                                dengan mudah dan efisien. Aplikasi ini dilengkapi dengan berbagai fitur yang dapat
                                memudahkan sekolah dalam mengelola kehadiran siswa, seperti absensi online, rekap kehadiran,
                                laporan kehadiran, dan data keamanan.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-2" class="collapsed">Berapa biaya berlangganan SYCMA Attendance?<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Biaya berlangganan SYCMA Attendance bervariasi tergantung pada jumlah siswa dan fitur yang
                                dibutuhkan. Sekolah dapat memilih paket yang sesuai dengan kebutuhannya.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-3" class="collapsed">Apakah SYCMA Attendance aman?<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Data kehadiran siswa dilindungi oleh sistem keamanan yang kuat. Sistem keamanan ini
                                menggunakan teknologi enkripsi untuk menjaga keamanan data siswa.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-4" class="collapsed">Bagaimana cara mendaftar untuk uji coba gratis
                            SYCMA Attendance?<i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Sekolah dapat mendaftar untuk uji coba gratis SYCMA Attendance dengan mengunjungi website
                                SYCMA Attendance.
                            <p>1. Daftar akun sekolah melalui <a href="" class="inline">halaman ini</a></p>
                            <p>2. Kami bisa bantu jawab semua kebutuhan sekolah dan pertanyaan anda dengan
                            </p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>KONTAK KAMI</h2>
                <p>Punya pertanyaan atau ingin berdiskusi lebih lanjut tentang SYCMA? Silahkan hubungi kami melalui berbagai
                    saluran yang tersedia:<br>
                    <strong>Kami berharap dapat membantu Anda mengelola sekolah dengan lebih mudah dan efisien.</strong>
                </p>
            </div>

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Lokasi:</h4>
                            <p>Flamboyan Street B73, Banjarmasin, BJM 70123</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>support@sycma.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Telpon:</h4>
                            <p>+62 9885 5585 8558</p>
                        </div>

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d995.806868259285!2d114.59243929536943!3d-3.293756565348954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de4230a0b2b4147%3A0xf77d2d78f8af24d7!2sSMK%20ISFI%20Banjarmasin!5e0!3m2!1sid!2sid!4v1705163611648!5m2!1sid!2sid"
                            frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>

                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Pesan</label>
                            <textarea class="form-control" name="message" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Kirim Pesan</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
@endsection
