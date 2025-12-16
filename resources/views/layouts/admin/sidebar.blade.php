<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets-admin/images/faces/face6.jpg') }}" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">Bianca Bahi</span>
                    <span class="text-secondary text-small">Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        {{-- Dashboard --}}
        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        {{-- User --}}
        <li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <span class="menu-title">User</span>
                <i class="menu-icon mdi mdi-account"></i>

            </a>
        </li>

        {{-- Warga --}}
        <li class="nav-item {{ request()->is('warga*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('warga.index') }}">
                <span class="menu-title">Warga</span>
                <i class="menu-icon mdi mdi-account-multiple"></i>
            </a>
        </li>


        {{-- Program Bantuan --}}
        <li class="nav-item {{ request()->is('program*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('program.index') }}">
                <span class="menu-title">Program Bantuan</span>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
        </li>

        {{-- Pendaftar Bantuan --}}
        <li class="nav-item {{ request()->is('pendaftar*') ? 'active' : '' }}">
            <a class="nav-link" href="/pendaftar">
                <span class="menu-title">Pendaftar Bantuan</span>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
        </li>

        {{-- Verifikasi Lapangan --}}
        <li class="nav-item {{ request()->is('verifikasi*') ? 'active' : '' }}">
            <a class="nav-link" href="/verifikasi">
                <span class="menu-title">Verifikasi Lapangan</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>

        {{-- Penerima Bantuan --}}
        <li class="nav-item {{ request()->is('penerima*') ? 'active' : '' }}">
            <a class="nav-link" href="/penerima">
                <span class="menu-title">Penerima Bantuan</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>


        {{-- Riwayat Penyaluran Bantuan --}}
        <li class="nav-item {{ request()->is('riwayat*') ? 'active' : '' }}">
            <a class="nav-link" href="/riwayat">
                <span class="menu-title">Riwayat Penyaluran Bantuan</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>

        <li class="nav-item {{ request()->is('about-developer') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('about.developer') }}">
        <span class="menu-title">About Developer</span>
        <i class="mdi mdi-account-star menu-icon"></i>
    </a>
</li>



    </ul>
</nav>
