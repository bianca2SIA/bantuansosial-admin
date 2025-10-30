@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-plus"></i>
                    </span> Tambah Data Warga
                </h3>

                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/program">Data Warga</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Warga</li>
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
                            <h4 class="card-title mb-4">Form Tambah Warga</h4>
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

                            <form class="forms-sample" method="POST" action="{{ route('warga.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>No KTP</label>
                                    <input type="text" name="no_ktp" class="form-control" placeholder="Masukkan No KTP"
                                        value="{{ old('no_ktp') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control"
                                        placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Agama</label>
                                    <input type="text" name="agama" class="form-control" placeholder="Masukkan agama"
                                        value="{{ old('agama') }}">
                                </div>

                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control"
                                        placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan') }}">
                                </div>

                                <div class="form-group">
                                    <label>No. Telepon</label>
                                    <input type="text" name="telp" class="form-control"
                                        placeholder="Masukkan nomor telepon" value="{{ old('telp') }}">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                                        value="{{ old('email') }}">
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
