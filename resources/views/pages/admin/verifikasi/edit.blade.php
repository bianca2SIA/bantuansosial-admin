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
                            <h4 class="card-title mb-4">Form Edit Verifikasi</h4>

                            <form class="forms-sample" method="POST"
                                action="{{ route('verifikasi.update', $verifikasi->verifikasi_id) }}"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Pendaftar</label>
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
                                    <input type="date" name="tanggal" class="form-control" style="cursor: pointer;"
                                        value="{{ old('tanggal', $verifikasi->tanggal) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $verifikasi->catatan) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Skor</label>
                                    <input type="number" name="skor" class="form-control"
                                        value="{{ old('skor', $verifikasi->skor) }}" min="0" required>
                                </div>
                                <hr class="my-4">
                                <h4 class="card-title mb-3">Foto Verifikasi</h4>

                                @foreach ($verifikasi->media as $file)
                                    <div class="d-flex align-items-center mb-2">

                                        <a href="{{ asset('storage/uploads/verifikasi_bantuan/' . $file->file_name) }}"
                                            target="_blank" class="d-flex align-items-center"
                                            style="font-size:13px; text-decoration:underline; color:#0d6efd;">
                                            <i class="mdi mdi-file-outline me-1" style="font-size:17px;"></i>
                                            <span>{{ $file->file_name }}</span>
                                        </a>

                                        <input type="text" name="captions_existing[{{ $file->media_id }}]"
                                            class="form-control ms-3" style="max-width:220px; height:30px; font-size:13px;"
                                            placeholder="Caption" value="{{ $file->caption }}">

                                        <button type="button" class="btn btn-link text-danger ms-2 p-0 delete-media"
                                            data-id="{{ $file->media_id }}" style="font-size:18px;">
                                            <i class="mdi mdi-close-circle-outline"></i>
                                        </button>

                                    </div>
                                @endforeach

                                @if ($verifikasi->media->count() == 0)
                                    <p class="text-muted" style="font-size: 13px;">Belum ada foto.</p>
                                @endif

                                <div class="form-group mt-4">
                                    <label style="font-size: 14px; font-weight: 600;">Tambah Foto Baru</label>
                                    <input type="file" name="media[]" multiple class="form-control"
                                        style="height: 45px;">
                                </div>

                                <div class="mt-4 d-flex justify-content-end">
                                    <a href="{{ route('verifikasi.index') }}" class="btn btn-light me-2">
                                        <i class="mdi mdi-arrow-left"></i> Batal
                                    </a>

                                    <button type="submit" class="btn btn-gradient-primary text-white">
                                        <i class="mdi mdi-content-save"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
