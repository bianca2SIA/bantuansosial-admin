@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-database"></i>
                    </span> Data Riwayat Penyaluran
                </h3>
            </div>

            @if (session('success'))
                <div
                    style="background-color: #d1e7dd; color:#0f5132; border-radius:8px;
                            padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">List Data Riwayat Penyaluran Bantuan</h4>

                        <a href="{{ route('riwayat.create') }}" class="btn btn-gradient-primary text-white">
                            + Tambah Riwayat
                        </a>
                    </div>

                    <div class="table-responsive">

                        <form method="GET" action="{{ route('riwayat.index') }}" class="mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <select name="tahap_ke" class="form-select filter-control"
                                        onchange="this.form.submit()">
                                        <option value="">Tahap</option>
                                        <option value="1" {{ request('tahap_ke') == '1' ? 'selected' : '' }}>Tahap 1
                                        </option>
                                        <option value="2" {{ request('tahap_ke') == '2' ? 'selected' : '' }}>Tahap 2
                                        </option>
                                        <option value="3" {{ request('tahap_ke') == '3' ? 'selected' : '' }}>Tahap 3
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-2">

                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Nama Penerima">

                                            <button type="submit"
                                                class="btn btn-light border-0 d-flex align-items-center px-3">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                        </div>

                                        @if (request('search'))
                                            <a href="{{ route('riwayat.index') }}" class="btn btn-outline-secondary">
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
                                    <th class="text-center"><strong>ID</strong></th>
                                    <th class="text-center"><strong>Program</strong></th>
                                    <th class="text-center"><strong>Penerima</strong></th>
                                    <th class="text-center"><strong>Tahap</strong></th>
                                    <th class="text-center"><strong>Tanggal</strong></th>
                                    <th class="text-center"><strong>Nilai (Rp)</strong></th>
                                    <th class="text-center"><strong>Aksi</strong></th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($riwayat as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->penerima_id }}</td>

                                        <td>{{ $item->program->nama_program ?? '-' }}</td>

                                        <td>
                                            {{ $item->penerima->warga->nama ?? '-' }}
                                            <br>

                                        </td>

                                        <td class="text-center">
                                            @if ($item->tahap_ke == 1)
                                                <span class="badge badge-gradient-danger">1</span>
                                            @elseif ($item->tahap_ke == 2)
                                                <span class="badge badge-gradient-warning">2</span>
                                            @elseif ($item->tahap_ke == 3)
                                                <span class="badge badge-gradient-success">3</span>
                                            @else
                                                <span class="badge badge-gradient-secondary">-</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        </td>

                                        <td class="text-center">
                                            Rp{{ number_format($item->nilai, 0, ',', '.') }}
                                        </td>

                                        <td class="text-center">

                                            <a href="{{ route('riwayat.show', $item->riwayat_id) }}"
                                                class="badge badge-gradient-info" title="Lihat Detail Program">
                                                <i class="mdi mdi-file-document"></i>
                                            </a>

                                            <a href="{{ route('riwayat.edit', $item->riwayat_id) }}"
                                                class="badge badge-gradient-warning" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <a href="#" class="badge badge-gradient-danger" title="Hapus"
                                                onclick="event.preventDefault(); if (confirm('Yakin hapus data ini?')) {
                                            document.getElementById('delete-riwayat-{{ $item->riwayat_id }}').submit();}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>

                                            <form id="delete-riwayat-{{ $item->riwayat_id }}"
                                                action="{{ route('riwayat.destroy', $item->riwayat_id) }}" method="POST"
                                                style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data riwayat</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $riwayat->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- end main content --}}
    @endsection
