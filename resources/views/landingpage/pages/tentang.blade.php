@extends('landingpage.layouts.main')

@section('title', 'Harga Aplikasi Sycma Attendance')
@section('main')
    <section id="why-us" class="why-us section-bg" style="background: #FFFFFF; padding-top: 12em">
        <div class="container-fluid" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                    <div class="content">
                        <h3>Tentang SYCMA: <strong>Solusi Absensi dan Manajemen Sekolah yang Modern</strong></h3>
                        <p>SYCMA membantu sekolah menghemat waktu dan meningkatkan akurasi data absensi. Platform kami mudah
                            digunakan oleh orang tua dan guru, dan kami menawarkan solusi yang terjangkau untuk semua
                            sekolah.</p>
                    </div>

                    <div class="accordion-list">
                        <ul>
                            <li>
                                <a data-bs-toggle="collapse" class="collapse"
                                    data-bs-target="#accordion-list-1"><span>01</span> Hemat waktu dan tenaga <i
                                        class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                    <p>
                                        membantu sekolah menghemat waktu dan tenaga dalam mengelola absensi dan data siswa.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2"
                                    class="collapsed"><span>02</span> Data absensi yang akurat
                                    <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        membantu sekolah mendapatkan data absensi yang akurat dengan mencegah human error,
                                        memverifikasi identitas siswa, dan memberikan data real-time. Data absensi yang
                                        akurat dapat membantu sekolah meningkatkan disiplin siswa, membuat keputusan yang
                                        tepat, dan meningkatkan kualitas pendidikan.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3"
                                    class="collapsed"><span>03</span> Mudah digunakan dan Terjangkau
                                    <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        mudah digunakan dan terjangkau untuk semua sekolah. SYCMA menawarkan platform yang
                                        intuitif, aplikasi mobile, dukungan pelanggan, dan harga yang kompetitif.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                    style='background-image: url("{{ asset('import/assets/img/tentang-kami.jpg') }}");' data-aos="zoom-in"
                    data-aos-delay="150">&nbsp;
                </div>
            </div>

        </div>
    </section>
@endsection
