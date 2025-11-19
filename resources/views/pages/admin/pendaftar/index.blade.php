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
                                                <span class="badge bg-success text-white">Diterima</span>
                                            @elseif ($item->status_seleksi == 'Ditolak')
                                                <span class="badge bg-danger text-white">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('pendaftar.edit', $item->pendaftar_id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>

                                            <form action="{{ route('pendaftar.destroy', $item->pendaftar_id) }}"
                                                method="POST" style="display:inline-block; margin-left: 4px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus data ini?')">
                                                    <i class="mdi mdi-delete"></i> Hapus
                                                </button>
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
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
