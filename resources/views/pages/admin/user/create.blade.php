@extends('layouts.admin.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-edit"></i>
                    </span>
                    Tambah Data User
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/user">Data User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                    </ul>
                </nav>
            </div>

            @if (session('success'))
                <div style="background-color:#d1e7dd;color:#0f5132;border-radius:8px;padding:10px 15px;margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

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

                            <form class="forms-sample" method="POST" action="{{ route('user.store') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Masukkan nama" value="{{ old('name') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Masukkan email" value="{{ old('email') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="Super Admin">Super Admin</option>
                                                <option value="Admin Bansos">Admin Bansos</option>
                                                <option value="Petugas Lapangan">Petugas Lapangan</option>
                                            </select>

                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex flex-column">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Masukkan password">
                                        </div>

                                        <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Ulangi password">
                                        </div>

                                        <div class="mt-auto d-flex justify-content-end">
                                            <a href="/warga" class="btn btn-light me-2">
                                                <i class="mdi mdi-arrow-left"></i> Batal
                                            </a>

                                            <button type="submit" class="btn btn-gradient-primary text-white">
                                                <i class="mdi mdi-content-save"></i> Simpan
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
