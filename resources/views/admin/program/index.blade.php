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
                                            <th>ID</th>
                                            <th>Kode</th>
                                            <th>Nama Program</th>
                                            <th>Tahun</th>
                                            <th>Deskripsi</th>
                                            <th>Anggaran</th>
                                            <th class="text-center">Aksi</th>
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
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('program.destroy', $item->program_id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                                    </form>
                                                </td>
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
