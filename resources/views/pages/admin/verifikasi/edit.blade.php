@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-file-check menu-icon"></i>
                    </span> Edit Data Verifikasi Lapangan
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('verifikasi.index') }}">Data Verifikasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Verifikasi</li>
                    </ul>
                </nav>
            </div>

            @if (session('success'))
                <div
                    style="background-color: #d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    style="background-color:#f8d7da; color:#842029; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <form class="forms-sample" method="POST"
                                action="{{ route('verifikasi.update', $verifikasi->verifikasi_id) }}"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="row">

                                    {{-- ================= BAGIAN KIRI ================= --}}
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label>Nama Pendaftar</label>
                                            <select name="pendaftar_id" class="form-control" required>
                                                <option value="">-- Pilih Pendaftar --</option>

                                                @foreach ($pendaftar as $p)
                                                    <option value="{{ $p->pendaftar_id }}"
                                                        {{ old('pendaftar_id', $verifikasi->pendaftar_id) == $p->pendaftar_id ? 'selected' : '' }}>
                                                        {{ $p->pendaftar_id }} - {{ $p->warga->nama ?? 'Tidak ada nama' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Petugas</label>
                                            <input type="text" name="petugas" class="form-control"
                                                value="{{ old('petugas', $verifikasi->petugas) }}"
                                                placeholder="Masukkan nama petugas" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Verifikasi</label>
                                            <input type="date" name="tanggal" class="form-control"
                                                style="cursor:pointer;" value="{{ old('tanggal', $verifikasi->tanggal) }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $verifikasi->catatan) }}</textarea>
                                        </div>

                                    </div>

                                    {{-- ================= BAGIAN KANAN ================= --}}
                                    <div class="col-md-6 d-flex flex-column">



                                        <div class="form-group">
                                            <label>Skor</label>
                                            <input type="number" name="skor" class="form-control"
                                                value="{{ old('skor', $verifikasi->skor) }}" min="0" required>
                                        </div>




                                        <div class="alert alert-purple small d-flex align-items-center mb-3">
                                            <i class="mdi mdi-information-outline me-2"></i>
                                            <span>
                                                Ingin melihat atau menghapus file sebelumnya?
                                                <a href="{{ route('verifikasi.show', $verifikasi->verifikasi_id) }}"
                                                    class="alert-link">
                                                    Klik ke halaman Detail
                                                </a>
                                            </span>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label>Upload Foto Verifikasi</label>
                                            <input type="file" name="media[]" multiple class="form-control"
                                                style="height:45px;">
                                                  <small class="text-muted">
                                                *File yang diupload di sini akan ditambahkan ke daftar file yang sudah ada
                                            </small>
                                        </div>

                                        {{-- TOMBOL --}}
                                        <div class="mt-auto d-flex justify-content-end">
                                            <a href="{{ route('verifikasi.index') }}" class="btn btn-light me-2">
                                                <i class="mdi mdi-arrow-left"></i> Batal
                                            </a>

                                            <button type="submit" class="btn btn-gradient-primary text-white">
                                                <i class="mdi mdi-content-save"></i> Simpan Perubahan
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
