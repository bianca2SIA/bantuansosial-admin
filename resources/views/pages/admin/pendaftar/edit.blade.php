@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-edit"></i>
                    </span> Edit Data Pendaftar Bantuan
                </h3>

                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('pendaftar.index') }}">Data Pendaftar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Pendaftar</li>
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
                                action="{{ route('pendaftar.update', $pendaftar->pendaftar_id) }}"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Program Bantuan</label>
                                            <select name="program_id" class="form-control" required>
                                                <option value="">-- Pilih Program --</option>
                                                @foreach ($program as $item)
                                                    <option value="{{ $item->program_id }}"
                                                        {{ old('program_id', $pendaftar->program_id) == $item->program_id ? 'selected' : '' }}>
                                                        {{ $item->nama_program }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Warga</label>
                                            <select name="warga_id" class="form-control" required>
                                                <option value="">-- Pilih Warga --</option>
                                                @foreach ($warga as $w)
                                                    <option value="{{ $w->warga_id }}"
                                                        {{ old('warga_id', $pendaftar->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                        {{ $w->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Status Seleksi</label>
                                            <select name="status_seleksi" class="form-control" required>
                                                <option value="Menunggu"
                                                    {{ old('status_seleksi', $pendaftar->status_seleksi) == 'Menunggu' ? 'selected' : '' }}>
                                                    Menunggu
                                                </option>
                                                <option value="Diterima"
                                                    {{ old('status_seleksi', $pendaftar->status_seleksi) == 'Diterima' ? 'selected' : '' }}>
                                                    Diterima
                                                </option>
                                                <option value="Ditolak"
                                                    {{ old('status_seleksi', $pendaftar->status_seleksi) == 'Ditolak' ? 'selected' : '' }}>
                                                    Ditolak
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex flex-column">
                                        <div class="alert alert-purple small d-flex align-items-center mb-3 mt-3">
                                            <i class="mdi mdi-information-outline me-2"></i>
                                            <span>
                                                Ingin melihat atau menghapus file sebelumnya?
                                                <a href="{{ route('pendaftar.show', $pendaftar->pendaftar_id) }}"
                                                    class="alert-link">
                                                    Klik ke halaman Detail
                                                </a>
                                            </span>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label>Upload Berkas Pendaftaran</label>
                                            <input type="file" name="media[]" multiple class="form-control"
                                                style="height: 45px;">

                                            <small class="text-muted">
                                                *File yang diupload di sini akan ditambahkan ke daftar file yang sudah ada
                                            </small>
                                        </div>

                                        <div class="mt-auto d-flex justify-content-end">
                                            <a href="{{ route('pendaftar.index') }}" class="btn btn-light me-2">
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
        {{-- end main content --}}

    @endsection
