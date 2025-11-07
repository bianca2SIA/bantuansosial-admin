@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-database"></i>
                    </span> Data Program Bantuan
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
                        <h4 class="card-title mb-0">List Data Program Bantuan</h4>
                        <a href="{{ route('program.create') }}" class="btn btn-gradient-primary text-white">
                            + Tambah Program Bantuan
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-gradient-primary text-white">
                                <tr>
                                    <th class="text-center"><strong>ID</strong></th>
                                    <th class="text-center"><strong>Kode</strong></th>
                                    <th class="text-center"><strong>Nama Program</strong></th>
                                    <th class="text-center"><strong>Tahun</strong></th>
                                    <th class="text-center"><strong>Deskripsi</strong></th>
                                    <th class="text-center"><strong>Anggaran</strong></th>
                                    <th class="text-center"><strong>Aksi</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataProgram as $item)
                                    <tr>
                                        <td>{{ $item->program_id }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama_program }}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>Rp{{ number_format($item->anggaran, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('program.edit', $item->program_id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>

                                            <form action="{{ route('program.destroy', $item->program_id) }}" method="POST"
                                                style="display:inline-block; margin-left: 4px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus data ini?')">
                                                    <i class="mdi mdi-delete"></i> Hapus
                                                </button>
                                            </form>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data program
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
