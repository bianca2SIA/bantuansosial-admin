@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-layers"></i>
                    </span> Tambah Program Bantuan
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/program">Program Bantuan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Program</li>
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
                            <h4 class="card-title mb-4">Form Tambah Program</h4>
                            <form class="forms-sample" method="POST" action="{{ route('program.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Program</label>
                                    <input type="text" name="nama_program" class="form-control"
                                        placeholder="Masukkan nama program" value="{{ old('nama_program') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Kode Program</label>
                                    <input type="text" name="kode" class="form-control"
                                        placeholder="Masukkan kode program" value="{{ old('kode') }}"required>
                                </div>
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2025"
                                        value="{{ old('tahun') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Anggaran (Rp)</label>
                                    <input type="number" name="anggaran" class="form-control"
                                        placeholder="Masukkan anggaran" value="{{ old('anggaran') }}"required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi program" required>{{ old('deskripsi') }}</textarea>
                                </div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <a href="/program" class="btn btn-light me-2">Batal</a>
                                    <button type="submit" class="btn btn-gradient-primary text-white">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
