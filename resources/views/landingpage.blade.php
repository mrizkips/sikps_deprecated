<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.2.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.2.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="{{ asset('assets/vendor/landingpage/images/stmik-logo.png') }}" type="image/x-icon">
  <meta name="description" content="">


  <title>Home</title>
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/web/assets/mobirise-icons2/mobirise2.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/web/assets/mobirise-icons-bold/mobirise-icons-bold.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/tether/tether.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/bootstrap/css/bootstrap-grid.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/bootstrap/css/bootstrap-reboot.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/dropdown/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/socicon/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/theme/css/style.css') }}">
  <link rel="preload" as="style" href="{{ asset('assets/vendor/landingpage/mobirise/css/mbr-additional.css') }}"><link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/mobirise/css/mbr-additional.css') }}" type="text/css">




</head>
<body>

  <section class="menu menu1 cid-st0TnjZgeo" once="menu" id="menu1-7">


    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="#">
                        <img src="{{ asset('assets/vendor/landingpage/images/stmik-logo.png') }}" alt="SIKPS" style="height: 3rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-7" href="#">SIKPS</a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                    @auth
                    <li class="nav-item"><a class="nav-link link text-black display-4" href="{{
                        Auth::guard('admin')->check() ? route('admin.beranda') :
                        (Auth::guard('mahasiswa')->check() ? route('mahasiswa.beranda') :
                        (Auth::guard('dosen')-> check() ? route('dosen.beranda') : route('landingpage')))
                        }}">
                        Beranda</a></li>
                    @endauth
                    <li class="nav-item"><a class="nav-link link text-black display-4" href="#">
                        Daftar Proposal</a></li>
                    @guest
                    <li class="nav-item"><a class="nav-link link text-black display-4" href="{{ route('login') }}">
                        Login</a></li>
                    <li class="nav-item"><a class="nav-link link text-black display-4" href="{{ route('register') }}">
                        Registrasi</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link link text-black display-4" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                        <form action="{{ route('logout') }}" method="POST" id="logout-form"> @csrf
                        <button type="submit" class="btn btn-ghost-dark btn-block d-none">Logout</button></form></a></li>
                    @endguest
                </ul>


            </div>
        </div>
    </nav>
</section>

<section class="header3 cid-st0ReNL0MK mbr-fullscreen" id="header3-1" style="background-image: url('{{ asset('assets/vendor/landingpage/images/mbr.jpg') }}')">



    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(255, 255, 255);"></div>

    <div class="align-center container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2"><strong>SISTEM INFORMASI KERJA PRAKTEK DAN SKRIPSI</strong></h1>
                <h2 class="mbr-section-subtitle mbr-fonts-style mb-3 display-2">STMIK BANDUNG</h2>


            </div>
        </div>
    </div>
</section>

<section class="content15 cid-st0RYyIrQL" id="content15-3">




    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12 col-lg-10">
                <div class="card-wrapper">
                    <div class="card-box align-left">
                        <h4 class="card-title mbr-fonts-style mbr-white mb-3 display-5"><strong>Tentang Kami</strong></h4>
                        <p class="mbr-text mbr-fonts-style display-7">STMIK Bandung merupakan STMIK pertama di Jawa Barat dan pelopor pendidikan tinggi informatika swasta dengan fokus untuk mencetak tenaga profesional dan technopreneur IT.
<br>
<br>Dalam upaya memberikan kesempatan kepada masyarakat yang tidak mempunyai waktu luang mengikuti pendidikan di hari kerja. STMIK BANDUNG membuka Program Kelas Karyawan atau Program Kuliah Karyawan dan Eksekutif jenjang S1.<br><br>Sistem Informasi Kerja Praktek dan Skripsi ini adalah pengembangan dari Sistem Informasi Pengajuan Proposal yang dibuat oleh Kafi Rohman dengan melengkapi fitur-fitur yang kurang dan memperbaiki fitur-fitur yang tidak berjalan.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features19 cid-st0RBapJdg" id="features20-2">



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <div class="card-wrapper pb-4">
                    <div class="card-box align-center">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong>Pengajuan Proposal</strong></h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
                            Sistem Informasi Kerja Praktek dan Skripsi membantu mahasiswa dalam melakukan pengajuan proposal kerja praktek dan skripsi dengan mudah.</p>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="step-number mbr-fonts-style display-5">1</span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7"><strong>Registrasi</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Lakukan registrasi untuk melakukan pengajuan proposal.</h5>
                    </div>
                </div>
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="step-number mbr-fonts-style display-5">2</span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7"><strong>Login</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Login ke dalam sistem dengan menggunakan akun yang sudah diregistrasi.<br><br></h5>
                    </div>
                </div>
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="step-number mbr-fonts-style display-5">3</span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7">
                            <strong>Mengajukan Proposal</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Masuk ke halaman Pengajuan lalu ajukan proposal kerja praktek atau skripsi.<br><br></h5>
                    </div>
                </div>
                <div class="item mbr-flex last">
                    <div class="icon-box">
                        <span class="step-number mbr-fonts-style display-5">4</span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7">
                            <strong>Verifikasi</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Tunggu verifikasi dan cek status proposal di halaman Daftar Proposal.<br></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team2 cid-st0SpdgVGH" xmlns="http://www.w3.org/1999/html" id="team2-5">


    <div class="container">
        <div class="card">
            <div class="card-wrapper">
                <div class="row align-items-center">
                    <div class="col-12 col-md-4">
                        <div class="image-wrapper">
                            <img src="{{ asset('assets/vendor/landingpage/images/newlogo.jpg') }}" alt="SIKPS">
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="card-box">
                            <h5 class="card-title mbr-fonts-style m-0 display-5">
                                <strong>Moch. Rizki Pratama S.</strong></h5>
                            <h6 class="mbr-fonts-style mb-3 display-4">
                                <strong>Creator</strong></h6>
                            <p class="mbr-text mbr-fonts-style display-7">Mahasiswa STMIK Bandung jurusan Sistem Informasi dengan NIM 3218609.</p>
                            <div class="social-row display-7">
                                <div class="soc-item">
                                    <a href="https://www.facebook.com/mrizkips/" target="_blank">
                                        <span class="mbr-iconfont socicon-facebook socicon"></span>
                                    </a>
                                </div>
                                <div class="soc-item">
                                    <a href="mailto:rizki.pezzek@gmail.com">
                                        <span class="mbr-iconfont socicon-mailru socicon"></span>
                                    </a>
                                </div>
                                <div class="soc-item">
                                    <a href="https://github.com/mrizkips" target="_blank">
                                        <span class="mbr-iconfont mbrib-github"></span>
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

<section class="footer7 cid-st0SwvHjCE" once="footers" id="footer7-6">





    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="col-12">
                <p class="mbr-text mb-0 mbr-fonts-style display-7">
                    © Copyright 2021 SIKPS - STMIK Bandung. Created by Rizki Pratama.</p>
            </div>
        </div>
    </div>
</section><section style="background-color: #fff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; color:#aaa; font-size:12px; padding: 0; align-items: center; display: none;"><a href="https://mobirise.site/v" style="flex: 1 1; height: 3rem; padding-left: 1rem;"></a><p style="flex: 0 0 auto; margin:0; padding-right:1rem;">Page was <a href="https://mobirise.site/h" style="color:#aaa;">started with</a> Mobirise</p></section>
<script src="{{ asset('assets/vendor/landingpage/web/assets/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/landingpage/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/landingpage/tether/tether.min.js') }}"></script>
<script src="{{ asset('assets/vendor/landingpage/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/landingpage/smoothscroll/smooth-scroll.js') }}"></script>
<script src="{{ asset('assets/vendor/landingpage/dropdown/js/nav-dropdown.js') }}"></script>
<script src="{{ asset('assets/vendor/landingpage/dropdown/js/navbar-dropdown.js') }}"></script>
<script src="{{ asset('assets/vendor/landingpage/touchswipe/jquery.touch-swipe.min.js') }}"></script>
<script src="{{ asset('assets/vendor/landingpage/theme/js/script.js') }}"></script>


 <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>
  </body>
</html>
