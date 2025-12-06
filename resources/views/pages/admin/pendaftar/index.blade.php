@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-edit"></i>
                    </span> Data Pendaftar Bantuan
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
                        <h4 class="card-title mb-0">List Data Seluruh Pendaftar</h4>
                        <a href="{{ route('pendaftar.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Tambah Pendaftar
                        </a>

                    </div>

                    <div class="table-responsive">
                        <form method="GET" action="{{ route('pendaftar.index') }}" class="mb-3">
                            <div class="row align-items-center">

                                <div class="col-md-2">
                                    <select name="status" class="form-select filter-control" onchange="this.form.submit()">
                                        <option value="">Status</option>
                                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>
                                            Menunggu
                                        </option>
                                        <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>
                                            Diterima
                                        </option>
                                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-2">

                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Nama Warga">

                                            <button type="submit"
                                                class="btn btn-light border-0 d-flex align-items-center px-3">
                                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>

                                        @if (request('search'))
                                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                                class="btn btn-outline-secondary">
                                                Clear
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered table-striped">
                            <thead class="bg-gradient-primary text-white">
                                <tr>
                                    <th class="text-center fw-bold">ID</th>
                                    <th class="text-center fw-bold">Program</th>
                                    <th class="text-center fw-bold">Nama Warga</th>
                                    <th class="text-center fw-bold">Status Seleksi</th>
                                    <th class="text-center fw-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendaftar as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->pendaftar_id }}</td>
                                        <td>{{ $item->program->nama_program ?? '-' }}</td>
                                        <td>{{ $item->warga->nama ?? '-' }}</td>
                                        <td class="text-center">
                                            @if ($item->status_seleksi == 'Diterima')
                                                <span class="badge badge-gradient-success">Diterima</span>
                                            @elseif ($item->status_seleksi == 'Ditolak')
                                                <span class="badge badge-gradient-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-gradient-warning">Menunggu</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if ($item->media()->count() > 0)
                                                <a href="javascript:void(0)"
                                                    class="badge badge-gradient-info open-media-modal"
                                                    data-id="{{ $item->pendaftar_id }}" title="Lihat Berkas"
                                                    style="border:none !important; outline:none !important; box-shadow:none !important;">
                                                    <i class="mdi mdi-file-document"></i>
                                                </a>
                                            @else
                                                <span class="badge badge-gradient-secondary" title="Tidak ada berkas">
                                                    <i class="mdi mdi-file-remove"></i>
                                                </span>
                                            @endif

                                            <a href="{{ route('pendaftar.edit', $item->pendaftar_id) }}"
                                                class="badge badge-gradient-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <a href="#" class="badge badge-gradient-danger"
                                                onclick="event.preventDefault();
                                            if(confirm('Yakin hapus data ini?')) {
                                            document.getElementById('delete-pendaftar-{{ $item->pendaftar_id }}').submit();}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>

                                            <form id="delete-pendaftar-{{ $item->pendaftar_id }}"
                                                action="{{ route('pendaftar.destroy', $item->pendaftar_id) }}"
                                                method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data pendaftar
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $pendaftar->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="mediaModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
                <div class="modal-content" style="border-radius: 12px; overflow: hidden;">

                    <div class="modal-header bg-gradient-primary text-white">
                        <h5 class="modal-title">Berkas Pendaftaran</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body" id="mediaModalBody">
                        <p class="text-muted">Memuat berkas...</p>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('.open-media-modal').forEach(btn => {
                btn.addEventListener('click', function() {

                    let id = this.getAttribute('data-id');
                    let modalBody = document.getElementById('mediaModalBody');

                    modalBody.innerHTML = "<p class='text-muted'>Memuat berkas...</p>";

                    fetch(`/pendaftar/${id}/dokumen`)
                        .then(res => res.json())
                        .then(data => {
                            modalBody.innerHTML = data.html;
                        });

                    let modal = new bootstrap.Modal(document.getElementById('mediaModal'));
                    modal.show();
                });
            });
        </script>
        {{-- end main content --}}
    @endsection
