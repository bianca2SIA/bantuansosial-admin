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

            {{-- Alert sukses --}}
            @if (session('success'))
                <div
                    style="background-color: #d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Alert error validasi --}}
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
                                action="{{ route('pendaftar.update', $pendaftar->pendaftar_id) }}">
                                @csrf
                                @method('PUT')

                                {{-- Pilih Program --}}
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

                                {{-- Pilih Warga --}}
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

                                {{-- Status Seleksi --}}
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
