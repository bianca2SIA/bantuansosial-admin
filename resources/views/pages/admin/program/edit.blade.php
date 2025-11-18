@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-layers"></i>
                    </span> Edit Program Bantuan
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/program">Program Bantuan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Program</li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Form Edit Program</h4>
                            <form class="forms-sample" method="POST"
                                action="{{ route('program.update', $dataProgram->program_id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Program</label>
                                    <input type="text" name="nama_program" class="form-control"
                                        value="{{ old('nama_program', $dataProgram->nama_program) }}"
                                        placeholder="Masukkan nama program" required>
                                </div>

                                <div class="form-group">
                                    <label>Kode Program</label>
                                    <input type="text" name="kode" class="form-control"
                                        value="{{ old('kode', $dataProgram->kode) }}" placeholder="Masukkan kode program"
                                        required>
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
                                        value="{{ old('anggaran', $dataProgram->anggaran) }}"
                                        placeholder="Masukkan anggaran" required>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi program" required>{{ old('deskripsi', $dataProgram->deskripsi) }}</textarea>
                                </div>



                                <div class="mt-4 d-flex justify-content-end">
                                    <!-- Tombol Batal -->
                                    <a href="/program" class="btn btn-light me-2">
                                        <i class="mdi mdi-arrow-left"></i> Batal
                                    </a>

                                    <!-- Tombol Simpan -->
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
