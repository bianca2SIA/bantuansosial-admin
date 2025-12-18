@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-file-check menu-icon"></i>
                    </span> Tambah Data Verifikasi Lapangan
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('verifikasi.index') }}">Data Verifikasi</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Verifikasi</li>
                    </ul>
                </nav>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
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

                            <form class="forms-sample" method="POST" action="{{ route('verifikasi.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pendaftar</label>
                                            <select name="pendaftar_id" class="form-control" required>
                                                <option value="">-- Pilih Pendaftar --</option>
                                                @foreach ($pendaftar as $p)
                                                    <option value="{{ $p->pendaftar_id }}"
                                                        {{ old('pendaftar_id') == $p->pendaftar_id ? 'selected' : '' }}>
                                                        {{ $p->pendaftar_id }} - {{ $p->warga->nama ?? 'Tidak ada nama' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Petugas</label>
                                            <input type="text" name="petugas" class="form-control"
                                                placeholder="Masukkan nama petugas" value="{{ old('petugas') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Verifikasi</label>
                                            <input type="date" name="tanggal" class="form-control"
                                                value="{{ old('tanggal') }}" required>
                                        </div>
                                        {{-- CATATAN --}}
                                        <div class="form-group">
                                            <label>Catatan (Opsional)</label>
                                            <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan catatan">{{ old('catatan') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex flex-column">
                                        <div class="form-group">
                                            <label>Skor</label>
                                            <input type="number" name="skor" class="form-control"
                                                placeholder="Masukkan skor" value="{{ old('skor') }}" required
                                                min="0">
                                        </div>

                                        <div class="form-group mt-2">
                                            <label>Upload Foto Verifikasi</label>
                                            <input type="file" name="media[]" multiple class="form-control">

                                            <small class="text-muted">
                                                *Anda dapat mengupload lebih dari satu file sekaligus.

                                            </small>
                                        </div>

                                        <div class="mt-auto d-flex justify-content-end">
                                            <a href="/verifikasi" class="btn btn-light me-2">
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
