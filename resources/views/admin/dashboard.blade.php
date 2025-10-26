<!DOCTYPE html>
<html lang="en">

<style>
    /* Hilangkan pseudo-element panah bawaan Bootstrap */
    a#profileDropdown.nav-link.dropdown-toggle::after {
        display: none !important;
        content: none !important;
    }
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bantuan Sosial Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets-admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets-admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets-admin/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets-admin/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets-admin/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets-admin-adminets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets-admin/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets-admin/images/favicon.png" />
</head>

<body>

    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">

            <!-- Logo besar berisi teks "BINA DESA" -->
            <a class="navbar-brand brand-logo d-flex align-items-center" href="index.html"
                style="text-decoration:none;">
                <h3 style="color:#8a3ab9; font-weight:700; margin:0; line-height:1; display:flex; align-items:center;">
                    BINA DESA
                </h3>
            </a>

            <!-- Logo mini yang tampil saat sidebar di-minimize -->
            <a class="navbar-brand brand-logo-mini" href="index.html">
                <img src="assets-admin/images/logo-mini.svg" alt="logo" />
            </a>
        </div>

        <!-- ========================================================= -->
        <!-- BAGIAN TENGAH & KANAN: MENU, SEARCH, PROFIL, DLL -->
        <!-- ========================================================= -->
        <div class="navbar-menu-wrapper d-flex align-items-stretch">

            <!-- Tombol toggle sidebar (ikon tiga garis di kiri navbar) -->
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>

            <!-- ========================================================= -->
            <!-- KOLOM PENCARIAN -->
            <!-- ========================================================= -->
            <div class="search-field d-none d-md-block">
                <form class="d-flex align-items-center h-100" action="#">
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                            <!-- Ikon kaca pembesar -->
                            <i class="input-group-text border-0 mdi mdi-magnify"></i>
                        </div>
                        <!-- Input teks pencarian -->
                        <input type="text" class="form-control bg-transparent border-0" placeholder="Pencarian">
                    </div>
                </form>
            </div>

            <!-- ========================================================= -->
            <!-- BAGIAN KANAN NAVBAR: PROFIL, PESAN, NOTIFIKASI, DLL -->
            <!-- ========================================================= -->
            <ul class="navbar-nav navbar-nav-right">

                <!-- ========================================================= -->
                <!-- PROFIL PENGGUNA (FOTO, NAMA, DAN MENU DROPDOWN) -->
                <!-- ========================================================= -->
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                        <div class="nav-profile-img">
                            <img src="{{ asset('assets-admin/images/faces/face1.jpg') }}" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text d-flex align-items-center">
                            <p class="mb-1 text-black me-1">Bianca Bahi</p>
                            <i class="mdi mdi-chevron-down text-primary"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#"><i class="mdi mdi-account text-primary me-2"></i>
                            Profil Saya</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-logout text-primary me-2"></i>
                            Keluar</a>
                    </div>
                </li>

                <!-- Dropdown profil -->


                <!-- ========================================================= -->
                <!-- TOMBOL FULLSCREEN (HANYA TAMPIL DI LAYAR BESAR) -->
                <!-- ========================================================= -->
                <li class="nav-item d-none d-lg-block full-screen-link">
                    <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                    </a>
                </li>

                <!-- ========================================================= -->
                <!-- MENU PESAN (EMAIL) -->
                <!-- ========================================================= -->
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Ikon surat -->
                        <i class="mdi mdi-email-outline"></i>
                        <!-- Titik kecil kuning penanda pesan baru -->
                        <span class="count-symbol bg-warning"></span>
                    </a>

                    <!-- Isi dropdown pesan -->
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                        aria-labelledby="messageDropdown">
                        <h6 class="p-3 mb-0">Messages</h6>
                        <div class="dropdown-divider"></div>

                        <!-- Pesan contoh 1 -->
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="assets-admin/images/faces/face4.jpg" alt="image" class="profile-pic">
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message
                                </h6>
                                <p class="text-gray mb-0">1 Minutes ago</p>
                            </div>
                        </a>

                        <!-- Pesan contoh 2 -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="assets-admin/images/faces/face2.jpg" alt="image" class="profile-pic">
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message
                                </h6>
                                <p class="text-gray mb-0">15 Minutes ago</p>
                            </div>
                        </a>

                        <!-- Pesan contoh 3 -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="assets-admin/images/faces/face3.jpg" alt="image" class="profile-pic">
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated
                                </h6>
                                <p class="text-gray mb-0">18 Minutes ago</p>
                            </div>
                        </a>

                        <!-- Footer dropdown -->
                        <div class="dropdown-divider"></div>
                        <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                    </div>
                </li>

                <!-- ========================================================= -->
                <!-- MENU NOTIFIKASI (LONCENG) -->
                <!-- ========================================================= -->
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                        data-bs-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class="count-symbol bg-danger"></span>
                    </a>

                    <!-- Isi dropdown notifikasi -->
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                        aria-labelledby="notificationDropdown">
                        <h6 class="p-3 mb-0">Notifications</h6>
                        <div class="dropdown-divider"></div>

                        <!-- Notifikasi contoh 1 -->
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-calendar"></i>
                                </div>
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                                <p class="text-gray ellipsis mb-0">Just a reminder that you have an event today</p>
                            </div>
                        </a>

                        <!-- Notifikasi contoh 2 -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="mdi mdi-cog"></i>
                                </div>
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                                <p class="text-gray ellipsis mb-0">Update dashboard</p>
                            </div>
                        </a>

                        <!-- Notifikasi contoh 3 -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="mdi mdi-link-variant"></i>
                                </div>
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                                <p class="text-gray ellipsis mb-0">New admin wow!</p>
                            </div>
                        </a>

                        <!-- Footer dropdown -->
                        <div class="dropdown-divider"></div>
                        <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                    </div>
                </li>

                <!-- ========================================================= -->
                <!-- TOMBOL LOGOUT (IKON POWER) -->
                <!-- ========================================================= -->
                <li class="nav-item nav-logout d-none d-lg-block">
                    <a class="nav-link" href="#">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>

                <!-- ========================================================= -->
                <!-- TOMBOL SETTINGS (IKON GARIS-GARIS) -->
                <!-- ========================================================= -->
                <li class="nav-item nav-settings d-none d-lg-block">
                    <a class="nav-link" href="#">
                        <i class="mdi mdi-format-line-spacing"></i>
                    </a>
                </li>
            </ul>

            <!-- ========================================================= -->
            <!-- TOGGLER KHUSUS UNTUK LAYAR KECIL (MOBILE) -->
            <!-- ========================================================= -->
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">
                            <img src="assets-admin/images/faces/face1.jpg" alt="profile" />
                            <span class="login-status online"></span>
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="font-weight-bold mb-2">Bianca Bahi</span>
                            <span class="text-secondary text-small">Admin</span>
                        </div>
                        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('user*') ? '' : 'collapsed' }}" data-bs-toggle="collapse"
                        data-bs-target="#ui-basic" role="button"
                        aria-expanded="{{ request()->is('user*') ? 'true' : 'false' }}" aria-controls="ui-basic"
                        onclick="window.location='{{ route('user.index') }}'">

                        <span class="menu-title">User</span>
                        <i class="menu-icon mdi mdi-account"></i>
                    </a>
                    <div class="collapse {{ request()->is('user*') ? 'show' : '' }}" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('program') ? 'active' : '' }}"
                                    href="{{ route('user.index') }}">Data User</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('program/create') ? 'active' : '' }}"
                                    href="{{ route('program.create') }}">Tambah User</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('warga*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->is('warga*') ? '' : 'collapsed' }}" data-bs-toggle="collapse"
        data-bs-target="#warga-menu" role="button"
        aria-expanded="{{ request()->is('warga*') ? 'true' : 'false' }}" aria-controls="warga-menu"
        onclick="window.location='{{ route('warga.index') }}'">

        <span class="menu-title">Warga</span>
        <i class="mdi mdi-account-multiple menu-icon"></i>
    </a>

    <div class="collapse {{ request()->is('warga*') ? 'show' : '' }}" id="warga-menu">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('warga') ? 'active' : '' }}"
                    href="{{ route('warga.index') }}">Daftar Warga</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('warga/create') ? 'active' : '' }}"
                    href="{{ route('warga.create') }}">Tambah Warga</a>
            </li>
        </ul>
    </div>
</li>

                <li class="nav-item {{ request()->is('program*') ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('program*') ? '' : 'collapsed' }}" data-bs-toggle="collapse"
                        data-bs-target="#ui-basic" role="button"
                        aria-expanded="{{ request()->is('program*') ? 'true' : 'false' }}" aria-controls="ui-basic"
                        onclick="window.location='{{ route('program.index') }}'">

                        <span class="menu-title">Program Bantuan</span>
                        <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                    </a>
                    <div class="collapse {{ request()->is('program*') ? 'show' : '' }}" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('program') ? 'active' : '' }}"
                                    href="{{ route('program.index') }}">Daftar Program</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('program/create') ? 'active' : '' }}"
                                    href="{{ route('program.create') }}">Tambah Program</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false"
                        aria-controls="icons">
                        <span class="menu-title">Pendaftar Bantuan</span>
                        <i class="mdi mdi-contacts menu-icon"></i>
                    </a>
                    <div class="collapse" id="icons">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false"
                        aria-controls="forms">
                        <span class="menu-title">Verifikasi Lapangan</span>
                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="pages/forms/basic_elements.html">Form Elements</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                        aria-controls="charts">
                        <span class="menu-title">Penerima Bantuan</span>
                        <i class="mdi mdi-chart-bar menu-icon"></i>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false"
                        aria-controls="tables">
                        <span class="menu-title">Riwayat Penyaluran Bantuan</span>
                        <i class="mdi mdi-table-large menu-icon"></i>
                    </a>

                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/samples/login.html"> Login </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/samples/register.html"> Register </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span> Dashboard
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i
                                    class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Anggaran Tersalurkan<i
                                        class="mdi mdi-chart-line mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5">Rp 3.425.000.000</h2>
                                <h6 class="card-text">Meningkat 12% dari bulan lalu</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Jumlah Pendaftar Baru <i
                                        class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5">1.284</h2>
                                <h6 class="card-text">Meningkat 8%</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Penerima Aktif Saat Ini <i
                                        class="mdi mdi-diamond mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5">9.578</h2>
                                <h6 class="card-text">Naik 3%</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="clearfix">
                                    <h4 class="card-title float-start">Visit And Sales Statistics</h4>
                                    <div id="visit-sale-chart-legend"
                                        class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                                </div>
                                <canvas id="visit-sale-chart" class="mt-4"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Traffic Sources</h4>
                                <div class="doughnutjs-wrapper d-flex justify-content-center">
                                    <canvas id="traffic-chart"></canvas>
                                </div>
                                <div id="traffic-chart-legend"
                                    class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Status Permohonan Bantuan Terakhir</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> Pendaftar </th>
                                                <th> Program </th>
                                                <th> Status </th>
                                                <th> Update </th>
                                                <th> ID </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="assets-admin/images/faces/face1.jpg" class="me-2"
                                                        alt="image"> Wan Rania Salma
                                                </td>
                                                <td> Bantuan Usaha Mikro Desa </td>
                                                <td>
                                                    <label class="badge badge-gradient-success">DONE</label>
                                                </td>
                                                <td> 2025 </td>
                                                <td> 13 </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="assets-admin/images/faces/face2.jpg" class="me-2"
                                                        alt="image"> Naaila Raqila
                                                </td>
                                                <td> Pembangunan Jalan Desa </td>
                                                <td>
                                                    <label class="badge badge-gradient-warning">PROGRESS</label>
                                                </td>
                                                <td> 2025 </td>
                                                <td> 14 </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="assets-admin/images/faces/face3.jpg" class="me-2"
                                                        alt="image"> Haya Nur Rizky
                                                </td>
                                                <td> Beasiswa Anak Petani </td>
                                                <td>
                                                    <label class="badge badge-gradient-info">ON HOLD</label>
                                                </td>
                                                <td> 2024 </td>
                                                <td> 15 </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="assets-admin/images/faces/face4.jpg" class="me-2"
                                                        alt="image"> Geta Dwi Artika
                                                </td>
                                                <td> Renovasi Rumah Layak Huni </td>
                                                <td>
                                                    <label class="badge badge-gradient-danger">REJECTED</label>
                                                </td>
                                                <td> 2025 </td>
                                                <td> 16 </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="assets-admin/images/faces/face2.jpg" class="me-2"
                                                        alt="image"> Jihan Zahra
                                                </td>
                                                <td> Program Air Bersih </td>
                                                <td>
                                                    <label class="badge badge-gradient-warning">PROGRESS</label>
                                                </td>
                                                <td> 2025 </td>
                                                <td> 17 </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                        © 2025 BINA DESA. All rights reserved.
                    </span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                        Hand-crafted with <i class="mdi mdi-heart text-danger"></i>
                    </span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets-admin-admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets-admin/vendors/chart.js/chart.umd.js"></script>
    <script src="assets-admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets-admin/js/off-canvas.js"></script>
    <script src="assets-admin/js/misc.js"></script>
    <script src="assets-admin/js/settings.js"></script>
    <script src="assets-admin/js/todolist.js"></script>
    <script src="assets-admin/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets-admin/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdown = document.querySelector('#profileDropdown');
            if (dropdown) {
                new bootstrap.Dropdown(dropdown);
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profileDropdown = document.getElementById("profileDropdown");

            if (profileDropdown) {
                // Pastikan dropdown Bootstrap aktif
                const dropdown = new bootstrap.Dropdown(profileDropdown);

                // Buat agar toggle klik tetap jalan meski ada script lain yang bentrok
                profileDropdown.addEventListener("click", function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    dropdown.toggle();
                });
            }
        });
    </script>

</body>

</html>
