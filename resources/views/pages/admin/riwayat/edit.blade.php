@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-history"></i>
                    </span> Edit Riwayat Penyaluran
                </h3>

                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('riwayat.index') }}">Riwayat Penyaluran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Riwayat</li>
                    </ul>
                </nav>
            </div>

            @if (session('success'))
                <div
                    style="background-color:#d1e7dd; color:#0f5132; border-radius:8px;
                            padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    style="background-color:#f8d7da; color:#842029; border-radius:8px;
                            padding:10px 15px; margin-bottom:20px;">
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

                            <h4 class="card-title mb-4">Form Edit Riwayat Penyaluran</h4>

                            <form class="forms-sample" method="POST"
                                action="{{ route('riwayat.update', $riwayat->riwayat_id) }}" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Program Bantuan</label>
                                    <select name="program_id" class="form-control" required>
                                        <option value="">-- Pilih Program --</option>

                                        @foreach ($program as $p)
                                            <option value="{{ $p->program_id }}"
                                                {{ old('program_id', $riwayat->program_id) == $p->program_id ? 'selected' : '' }}>
                                                {{ $p->nama_program }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Penerima Bantuan</label>
                                    <select name="penerima_id" class="form-control" required>
                                        <option value="">-- Pilih Penerima --</option>

                                        @foreach ($penerima as $pn)
                                            <option value="{{ $pn->penerima_id }}"
                                                {{ old('penerima_id', $riwayat->penerima_id) == $pn->penerima_id ? 'selected' : '' }}>
                                                {{ $pn->warga->nama }} (ID: {{ $pn->penerima_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tahap Ke</label>
                                    <input type="number" name="tahap_ke" class="form-control"
                                        value="{{ old('tahap_ke', $riwayat->tahap_ke) }}" placeholder="Contoh: 1" required>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Penyaluran</label>
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ old('tanggal', $riwayat->tanggal) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Nilai Bantuan (Rp)</label>
                                    <input type="number" name="nilai" class="form-control"
                                        value="{{ old('nilai', $riwayat->nilai) }}" placeholder="Contoh: 2500000" required>
                                </div>

                                <hr class="my-4">
                                <h4 class="card-title mb-3">Bukti Penyaluran</h4>

                                @foreach ($riwayat->media as $file)
                                    <div class="d-flex align-items-center mb-2">

                                        <a href="{{ asset('storage/uploads/penyaluran_bantuan/' . $file->file_name) }}"
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

                                @if ($riwayat->media->count() == 0)
                                    <p class="text-muted" style="font-size: 13px;">Belum ada bukti penyaluran.</p>
                                @endif

                                <div class="form-group mt-4">
                                    <label style="font-size: 14px; font-weight: 600;">Tambah Bukti Penyaluran Baru</label>
                                    <input type="file" name="media[]" multiple class="form-control"
                                        style="height: 45px;">
                                </div>

                                <div class="mt-4 d-flex justify-content-end">
                                    <a href="{{ route('riwayat.index') }}" class="btn btn-light me-2">
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
