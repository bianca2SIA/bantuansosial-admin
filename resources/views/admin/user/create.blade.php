@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-edit"></i>
                    </span> Tambah Data User
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/program">Data User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                    </ul>
                </nav>
            </div>
            @if (session('success'))
                <div
                    style="background-color: #d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Form Tambah User</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="forms-sample" method="POST" action="{{ route('user.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama"
                                        value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Masukkan email"
                                        value="{{ old('email') }}"required>
                                </div>

                                <div class="form-group">
                                    <label>Password (kosongkan jika tidak ingin diubah)</label>
                                    <input type="text" name="password" class="form-control"
                                        placeholder="Masukkan password baru (opsional)">
                                </div>

                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="text" name="password_confirmation" class="form-control"
                                        placeholder="Ulangi password baru (opsional)">
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <!-- Tombol Batal -->
                                    <a href="/warga" class="btn btn-light me-2">
                                        <i class="mdi mdi-arrow-left"></i> Batal
                                    </a>

                                    <!-- Tombol Simpan -->
                                    <button type="submit" class="btn btn-gradient-primary text-white">
                                        <i class="mdi mdi-content-save"></i> Simpan
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
