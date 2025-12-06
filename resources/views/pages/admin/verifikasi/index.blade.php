@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-file-check menu-icon"></i>
                    </span> Data Verifikasi Lapangan
                </h3>
            </div>

            @if (session('success'))
                <div
                    style="background-color: #d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">List Data Seluruh Verifikasi</h4>
                        <a href="{{ route('verifikasi.create') }}" class="btn btn-gradient-primary text-white">
                            + Tambah Verifikasi
                        </a>
                    </div>

                    <div class="table-responsive">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center gap-2">

                                <form method="GET" action="{{ route('verifikasi.index') }}">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="Nama Petugas">

                                        <button type="submit"
                                            class="btn btn-light border-0 d-flex align-items-center px-3">
                                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>

                                @if (request('search'))
                                    <a href="{{ route('verifikasi.index') }}" class="btn btn-outline-secondary">
                                        Clear
                                    </a>
                                @endif

                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead class="bg-gradient-primary text-white">
                                <tr>
                                    <th class="text-center fw-bold">ID</th>
                                    <th class="text-center fw-bold">Pendaftar</th>
                                    <th class="text-center fw-bold">Petugas</th>
                                    <th class="text-center fw-bold">Tanggal</th>
                                    <th class="text-center fw-bold">Skor</th>
                                    <th class="text-center fw-bold">Catatan</th>
                                    <th class="text-center fw-bold">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($verifikasi as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->pendaftar->pendaftar_id }}</td>
                                        <td>

                                            <span>{{ $item->pendaftar->warga->nama ?? '-' }}</span>

                                        </td>
                                        <td>{{ $item->petugas }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d F Y') }}
                                        </td>

                                        <td>
                                            <div style="width:100px; background:#eee; border-radius:4px; overflow:hidden;">
                                                <div
                                                    style="
                                                width: {{ $item->skor }}%;
                                                height: 8px;
                                                background:
                                                @if ($item->skor >= 80) linear-gradient(90deg, #4caf50, #2e7d32)
                                                @elseif($item->skor >= 50)
                                                linear-gradient(90deg, #FFD200, #FFB800)
                                                @else
                                                linear-gradient(90deg, #ff9bb3, #ff4770) @endif;">
                                                </div>
                                            </div>
                                            <small>{{ $item->skor }}%</small>
                                        </td>

                                        <td>{{ $item->catatan ?? '-' }}</td>

                                        <td class="text-center">
                                            @if ($item->media()->count() > 0)
                                                <a href="javascript:void(0)"
                                                    class="badge badge-gradient-info open-media-modal"
                                                    data-id="{{ $item->verifikasi_id }}" title="Lihat Dokumen"
                                                    style="border:none !important; outline:none !important; box-shadow:none !important;">
                                                    <i class="mdi mdi-file-document"></i>
                                                </a>
                                            @else
                                                <span class="badge badge-gradient-secondary" title="Tidak ada dokumen">
                                                    <i class="mdi mdi-file-remove"></i>
                                                </span>
                                            @endif

                                            <a href="{{ route('verifikasi.edit', $item->verifikasi_id) }}"
                                                class="badge badge-gradient-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <a href="#" class="badge badge-gradient-danger"
                                                onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus data ini?')) {
                                            document.getElementById('delete-verifikasi-{{ $item->verifikasi_id }}').submit();}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>

                                            <form id="delete-verifikasi-{{ $item->verifikasi_id }}"
                                                action="{{ route('verifikasi.destroy', $item->verifikasi_id) }}"
                                                method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada data verifikasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $verifikasi->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mediaModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
                <div class="modal-content" style="border-radius: 12px; overflow: hidden;">

                    <div class="modal-header bg-gradient-primary text-white">
                        <h5 class="modal-title">Foto Verifikasi</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body" id="mediaModalBody">
                        <p class="text-muted">Memuat foto...</p>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('.open-media-modal').forEach(btn => {
                btn.addEventListener('click', function() {

                    let id = this.getAttribute('data-id');
                    let modalBody = document.getElementById('mediaModalBody');

                    modalBody.innerHTML = "<p class='text-muted'>Memuat foto...</p>";

                    fetch(`/verifikasi/${id}/dokumen`)
                        .then(res => res.json())
                        .then(data => {
                            modalBody.innerHTML = data.html;
                        });

                    let modal = new bootstrap.Modal(document.getElementById('mediaModal'));
                    modal.show();
                });
            });
        </script>
    @endsection
