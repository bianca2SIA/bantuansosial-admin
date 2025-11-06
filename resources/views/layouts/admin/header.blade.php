<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo d-flex align-items-center" href="/dashboard" style="text-decoration:none;">
            <h3 style="color:#8a3ab9; font-weight:700; margin:0; line-height:1;">BINA DESA</h3>
        </a>
        <a class="navbar-brand brand-logo-mini" href="/dashboard">
            <h3 style="color:#8a3ab9; font-weight:700;">BD</h3>
        </a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <!-- Tombol Sidebar -->
        <button class="navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Pencarian">
                </div>
            </form>
        </div>

        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                    id="profileDropdown">

                    <div class="nav-profile-img">
                        <img src="{{ asset('assets-admin/images/faces/face6.jpg') }}" alt="image">
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
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout text-primary me-2"></i> Keluar
                        </a>
                    </form>

                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="javascript:void(0)"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-email-outline"></i>
                    <span class="count-symbol bg-warning"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                    aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">Pesan Baru</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('assets-admin/images/faces/face2.jpg') }}" alt="image"
                                class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Data penerima baru ditambahkan
                            </h6>
                            <p class="text-gray mb-0">5 menit lalu</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('assets-admin/images/faces/face3.jpg') }}" alt="image"
                                class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Verifikasi lapangan selesai
                            </h6>
                            <p class="text-gray mb-0">15 menit lalu</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">Lihat semua pesan</h6>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="javascript:void(0)"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count-symbol bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifikasi</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="mdi mdi-information mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject font-weight-normal mb-1">Laporan penyaluran butuh konfirmasi</p>
                            <p class="text-gray mb-0">10 menit lalu</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="mdi mdi-cog-outline"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject font-weight-normal mb-1">Penerima baru telah diverifikasi</p>
                            <p class="text-gray mb-0">Diperbarui 1 jam lalu</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <p class="p-3 mb-0 text-center">Lihat semua notifikasi</p>
                </div>
            </li>


            <li class="nav-item d-none d-lg-block">
                <a class="nav-link" href="javascript:void(0)" id="fullscreenToggle" title="Layar Penuh">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>



            <li class="nav-item d-none d-lg-block">
                <a class="nav-link" href="javascript:void(0)" title="Pengaturan Tampilan">
                    <i class="mdi mdi-format-line-spacing"></i>
                </a>
            </li>

            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
    </div>
</nav>
