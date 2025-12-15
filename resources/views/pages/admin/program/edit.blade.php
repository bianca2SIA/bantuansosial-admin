@extends('layouts.admin.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            {{-- HEADER --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-layers"></i>
                    </span>
                    Edit Program Bantuan
                </h3>

                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('program.index') }}">Program Bantuan</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Program</li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="{{ route('program.update', $dataProgram->program_id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Program</label>
                                            <input type="text" name="nama_program" class="form-control"
                                                value="{{ old('nama_program', $dataProgram->nama_program) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Kode Program</label>
                                            <input type="text" name="kode" class="form-control"
                                                value="{{ old('kode', $dataProgram->kode) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <select name="tahun" class="form-control" required>
                                                <option value="">-- Pilih Tahun --</option>
                                                @for ($tahun = 2000; $tahun <= date('Y'); $tahun++)
                                                    <option value="{{ $tahun }}"
                                                        {{ old('tahun', $dataProgram->tahun) == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Anggaran (Rp)</label>
                                            <input type="number" name="anggaran" class="form-control"
                                                value="{{ old('anggaran', $dataProgram->anggaran) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex flex-column">

                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $dataProgram->deskripsi) }}</textarea>
                                        </div>

                                        <div class="alert alert-purple small d-flex align-items-center mb-3">
                                            <i class="mdi mdi-information-outline me-2"></i>
                                            <span>
                                                Ingin melihat atau menghapus file sebelumnya?
                                                <a href="{{ route('program.show', $dataProgram->program_id) }}"
                                                    class="alert-link">
                                                    Klik ke halaman Detail
                                                </a>
                                            </span>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label>Upload Dokumen Program</label>
                                            <input type="file" name="media[]" multiple class="form-control"
                                                style="height:45px;">
                                            <small class="text-muted">
                                                *File yang diupload di sini akan ditambahkan ke daftar file yang sudah ada
                                            </small>
                                        </div>

                                        <div class="mt-auto d-flex justify-content-end">
                                            <a href="{{ route('program.index') }}" class="btn btn-light me-2">
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
