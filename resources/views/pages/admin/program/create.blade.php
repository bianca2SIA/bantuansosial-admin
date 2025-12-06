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
                                    <select name="tahun" class="form-control" required>
                                        <option value="">-- Pilih Tahun --</option>
                                        @for ($tahun = 2000; $tahun <= date('Y'); $tahun++)
                                            <option value="{{ $tahun }}"
                                                {{ old('tahun') == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Anggaran (Rp)</label>
                                    <input type="text" name="anggaran" id="anggaran" class="form-control"
                                        placeholder="Masukkan anggaran" value="{{ old('anggaran') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi program" required>{{ old('deskripsi') }}</textarea>
                                </div>
                                <div class="form-group mt-4">
                                    <label>Dokumen Program</label>
                                    <input type="file" name="media[]" multiple class="form-control">

                                    <small class="text-muted">
                                        *Anda dapat mengupload lebih dari satu file sekaligus.
                                        Caption bisa diedit nanti pada halaman Edit Program.
                                    </small>
                                </div>

                                <div class="mt-4 d-flex justify-content-end">

                                    <a href="/program" class="btn btn-light me-2">
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
    @endsection
