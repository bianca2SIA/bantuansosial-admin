@extends('layouts.admin.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            {{-- HEADER --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-clipboard-check"></i>
                    </span>
                    Detail Verifikasi Lapangan
                </h3>

                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('verifikasi.index') }}">Verifikasi Lapangan</a>
                        </li>
                        <li class="breadcrumb-item active">Detail Verifikasi</li>
                    </ul>
                </nav>
            </div>

            @if (session('success'))
                <div
                    style="background-color:#d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">

                                {{-- ================= LEFT ================= --}}
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="text-muted">Nama Warga</label>
                                        <p class="fw-bold">{{ $verifikasi->pendaftar->warga->nama }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">NIK</label>
                                        <p class="fw-bold">{{ $verifikasi->pendaftar->warga->no_ktp }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">Program Bantuan</label>
                                        <p class="fw-bold">{{ $verifikasi->pendaftar->program->nama_program }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">Petugas</label>
                                        <p class="fw-bold">{{ $verifikasi->petugas }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">Tanggal Verifikasi</label>
                                        <p class="fw-bold">{{ $verifikasi->tanggal }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">Skor</label>
                                        <p class="fw-bold text-primary">{{ $verifikasi->skor }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">Catatan</label>
                                        <p class="fw-bold">{{ $verifikasi->catatan ?? '-' }}</p>
                                    </div>

                                </div>

                                {{-- ================= RIGHT ================= --}}
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="text-muted small mb-1">Foto Verifikasi</label>

                                        @if ($verifikasi->media->count())
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered align-middle text-center mb-0">
                                                    <thead class="table-light small">
                                                        <tr>
                                                            <th width="35">No</th>
                                                            <th width="70">Preview</th>
                                                            <th>Nama File</th>
                                                            <th width="120">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="small">
                                                        @foreach ($verifikasi->media as $i => $file)
                                                            <tr>
                                                                <td>{{ $i + 1 }}</td>

                                                                <td>
                                                                    @if (in_array(pathinfo($file->file_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp']))
                                                                        <img src="{{ asset('storage/uploads/verifikasi_lapangan/' . $file->file_name) }}"
                                                                            style="width:45px;height:45px;object-fit:cover;border-radius:4px;">
                                                                    @else
                                                                        <i
                                                                            class="mdi mdi-file-document-outline mdi-24px text-secondary"></i>
                                                                    @endif
                                                                </td>
                                                                <td class="text-start py-1">
                                                                    <div>
                                                                        {{ preg_replace('/^[^-]+-/', '', $file->file_name) }}
                                                                    </div>

                                                                    <small class="text-muted">
                                                                        <a href="{{ asset('storage/uploads/verifikasi_lapangan/' . $file->file_name) }}"
                                                                            target="_blank" class="doc-link">
                                                                            Buka file
                                                                        </a>
                                                                    </small>
                                                                </td>



                                                                <td>
                                                                    <a href="{{ route('verifikasi.media.download', $file->media_id) }}"
                                                                        class="badge badge-gradient-info me-1">
                                                                        <i class="mdi mdi-download"></i>
                                                                    </a>

                                                                    <form
                                                                        action="{{ route('verifikasi.media.delete', $file->media_id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="badge badge-gradient-danger border-0"
                                                                            onclick="return confirm('Yakin hapus file ini?')">
                                                                            <i class="mdi mdi-delete"></i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="border rounded p-4 mt-2 text-center">
                                                <img src="{{ asset('assets-admin/images/empty.svg') }}" alt="">
                                            </div>
                                        @endif
                                    </div>

                                    {{-- UPLOAD --}}
                                    <form method="POST"
                                        action="{{ route('verifikasi.media.upload', $verifikasi->verifikasi_id) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label class="text-muted">Upload Foto Verifikasi</label>

                                            <div class="d-flex align-items-stretch gap-2">
                                                <input type="file" name="media[]" multiple class="form-control">

                                                <button type="submit"
                                                    class="btn btn-gradient-primary btn-sm px-3 d-flex align-items-center">
                                                    <i class="mdi mdi-upload me-1"></i>
                                                    Upload
                                                </button>

                                            </div>

                                            <small class="text-muted">
                                                *Anda dapat mengupload lebih dari satu file sekaligus.
                                            </small>
                                        </div>


                                    </form>

                                </div>
                                <div class="d-flex justify-content-end mt-0" style="margin-top:-12px;">
                                    <a href="{{ route('verifikasi.index') }}" class="btn btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    @endsection
