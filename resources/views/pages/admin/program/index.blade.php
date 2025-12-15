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
                            + Tambah Program
                        </a>
                    </div>

                    <div class="table-responsive">
                        <form method="GET" action="{{ route('program.index') }}" class="mb-3">
                            <div class="row align-items-center">

                                <!-- Filter Gender -->

                                <div class="col-md-2">
                                    <select name="tahun" class="form-select" onchange="this.form.submit()">
                                        <option value="">Tahun</option>

                                        @for ($year = 2020; $year <= 2026; $year++)
                                            <option value="{{ $year }}"
                                                {{ request('tahun') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>

                                </div>

                                <!-- Search + Clear -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-2">

                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Nama Program">


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
                                        <td>
                                            <span
                                                style="background:#A06EFF;color:#fff;padding:4px 12px;border-radius:8px;font-size:13px;">
                                                {{ $item->kode }}
                                            </span>
                                        </td>
                                        <td>{{ $item->nama_program }}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>Rp{{ number_format($item->anggaran, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('program.edit', $item->program_id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('program.destroy', $item->program_id) }}" method="POST"
                                                style="display:inline-block; margin-left: 4px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus data ini?')">
                                                    <i class="mdi mdi-delete"></i>
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
                        <div class="mt-3">
                            {{ $dataProgram->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
