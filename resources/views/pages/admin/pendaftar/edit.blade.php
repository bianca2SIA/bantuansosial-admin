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
                            <h4 class="card-title mb-4">Form Edit Pendaftar Bantuan</h4>
                            <form class="forms-sample" method="POST"
                                action="{{ route('pendaftar.update', $pendaftar->pendaftar_id) }}"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Program Bantuan</label>
                                    <select name="program_id" class="form-control" required>
                                        <option value="">-- Pilih Program --</option>
                                        @foreach ($program as $program)
                                            <option value="{{ $program->program_id }}"
                                                {{ old('program_id', $pendaftar->program_id) == $program->program_id ? 'selected' : '' }}>
                                                {{ $program->nama_program }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Nama Warga</label>
                                    <select name="warga_id" class="form-control" required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach ($warga as $warga)
                                            <option value="{{ $warga->warga_id }}"
                                                {{ old('warga_id', $pendaftar->warga_id) == $warga->warga_id ? 'selected' : '' }}>
                                                {{ $warga->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Status Seleksi</label>
                                    <select name="status_seleksi" class="form-control" required>
                                        <option value="Menunggu"
                                            {{ old('status_seleksi', $pendaftar->status_seleksi) == 'Menunggu' ? 'selected' : '' }}>
                                            Menunggu</option>
                                        <option value="Diterima"
                                            {{ old('status_seleksi', $pendaftar->status_seleksi) == 'Diterima' ? 'selected' : '' }}>
                                            Diterima</option>
                                        <option value="Ditolak"
                                            {{ old('status_seleksi', $pendaftar->status_seleksi) == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak</option>
                                    </select>
                                </div>

                                <hr class="my-4">
                                <h4 class="card-title mb-3">Berkas Pendaftaran</h4>

                                @foreach ($pendaftar->media as $file)
                                    <div class="d-flex align-items-center mb-2">

                                        <a href="{{ asset('storage/uploads/pendaftar_bantuan/' . $file->file_name) }}"
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

                                @if ($pendaftar->media->count() == 0)
                                    <p class="text-muted" style="font-size: 13px;">Belum ada berkas.</p>
                                @endif

                                <div class="form-group mt-4">
                                    <label style="font-size: 14px; font-weight: 600;">Tambah Berkas Baru</label>
                                    <input type="file" name="media[]" multiple class="form-control"
                                        style="height: 45px;">
                                </div>

                                <div class="mt-4 d-flex justify-content-end">
                                    <a href="{{ route('pendaftar.index') }}" class="btn btn-light me-2">
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
        {{-- end main content --}}
    @endsection
