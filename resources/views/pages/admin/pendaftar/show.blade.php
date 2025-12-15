@extends('layouts.admin.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            {{-- HEADER --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-details"></i>
                    </span>
                    Detail Pendaftar Bantuan
                </h3>

                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('pendaftar.index') }}">Pendaftar Bantuan</a>
                        </li>
                        <li class="breadcrumb-item active">Detail Pendaftar</li>
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

                                {{-- ================= LEFT COLUMN ================= --}}
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="text-muted">Nama Warga</label>
                                        <p class="fw-bold">{{ $pendaftar->warga->nama }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">NIK</label>
                                        <p class="fw-bold">{{ $pendaftar->warga->no_ktp }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">Status Seleksi</label>
                                        <p class="fw-bold text-primary">
                                            {{ $pendaftar->status_seleksi }}
                                        </p>
                                    </div>



                                    <div class="form-group">
                                        <label class="text-muted">Program Bantuan</label>
                                        <p class="fw-bold">{{ $pendaftar->program->nama_program }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">Kode Program</label>
                                        <p class="fw-bold">{{ $pendaftar->program->kode }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-muted">Tahun</label>
                                        <p class="fw-bold">{{ $pendaftar->program->tahun }}</p>
                                    </div>

                                </div>

                                {{-- ================= RIGHT COLUMN ================= --}}
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="text-muted small mb-1">
                                            Berkas Pendaftaran
                                        </label>

                                        @if ($pendaftar->media->count())
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
                                                        @foreach ($pendaftar->media as $i => $file)
                                                            <tr>
                                                                <td>{{ $i + 1 }}</td>

                                                                <td>
                                                                    @if (in_array(pathinfo($file->file_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp']))
                                                                        <img src="{{ asset('storage/uploads/pendaftar_bantuan/' . $file->file_name) }}"
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
                                                                        <a href="{{ asset('storage/uploads/program_bantuan/' . $file->file_name) }}"
                                                                            target="_blank" class="doc-link">
                                                                            Buka file
                                                                        </a>
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('pendaftar.media.download', $file->media_id) }}"
                                                                        class="badge badge-gradient-info me-1">
                                                                        <i class="mdi mdi-download"></i>
                                                                    </a>

                                                                    <a href="#" class="badge badge-gradient-danger"
                                                                        onclick="event.preventDefault();
                                                                   if(confirm('Yakin hapus file ini?')){
                                                                       document.getElementById('del-{{ $file->media_id }}').submit();
                                                                   }">
                                                                        <i class="mdi mdi-delete"></i>
                                                                    </a>

                                                                    <form id="del-{{ $file->media_id }}"
                                                                        action="{{ route('pendaftar.media.delete', $file->media_id) }}"
                                                                        method="POST" class="d-none">

                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="border rounded p-4 mt-2">
                                                <div class="empty-state">
                                                    <img src="{{ asset('assets-admin/images/empty.svg') }}"
                                                        alt="Tidak ada dokumen">
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- UPLOAD --}}
                                    <form method="POST" action="{{ route('pendaftar.media.upload', $pendaftar->pendaftar_id) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group mt-3">
                                            <label class="text-muted">Upload Berkas Pendaftaran</label>

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
                                        <div class="card-footer bg-transparent border-0 d-flex justify-content-end">
                                            <a href="{{ route('pendaftar.index') }}" class="btn btn-light px-4">
                                                <i class="mdi mdi-arrow-left"></i> Kembali
                                            </a>
                                        </div>

                                    </form>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
