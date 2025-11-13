@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">

            {{-- Header halaman --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-plus"></i>
                    </span> Tambah Pendaftar Bantuan
                </h3>

                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/pendaftar">Data Pendaftar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Pendaftar</li>
                    </ul>
                </nav>
            </div>

            {{-- Alert sukses --}}
            @if (session('success'))
                <div style="background-color:#d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Form Tambah Pendaftar Bantuan</h4>

                            {{-- Validasi error --}}
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

                            {{-- Form Tambah --}}
                            <form class="forms-sample" method="POST" action="{{ route('pendaftar.store') }}">
                                @csrf

                                {{-- Pilih Program --}}
                                <div class="form-group">
                                    <label>Program Bantuan</label>
                                    <select name="program_id" class="form-control" required>
                                        <option value="">-- Pilih Program Bantuan --</option>
                                        @foreach ($program as $program)
                                            <option value="{{ $program->program_id }}"
                                                {{ old('program_id') == $program->program_id ? 'selected' : '' }}>
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
    @foreach ($warga as $item)
        <option value="{{ $item->warga_id }}">{{ $item->nama }}</option>
    @endforeach
</select>

                                </div>

                                {{-- Status Seleksi --}}
                                <div class="form-group">
                                    <label>Status Seleksi</label>
                                    <select name="status_seleksi" class="form-control" required>
                                        <option value="">-- Pilih Status Seleksi --</option>
                                        <option value="Menunggu"
                                            {{ old('status_seleksi') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="Diterima"
                                            {{ old('status_seleksi') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="Ditolak"
                                            {{ old('status_seleksi') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>

                                {{-- Tombol aksi --}}
                                <div class="mt-4 d-flex justify-content-end">
                                    <a href="/pendaftar" class="btn btn-light me-2">
                                        <i class="mdi mdi-arrow-left"></i> Batal
                                    </a>
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
    </div>
@endsection
