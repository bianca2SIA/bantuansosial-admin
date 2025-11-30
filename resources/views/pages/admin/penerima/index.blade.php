@extends('layouts.admin.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-check"></i>
                    </span> Data Penerima Bantuan
                </h3>
            </div>

            {{-- Alert sukses --}}
            @if (session('success'))
                <div
                    style="background-color:#d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif


            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">List Data Penerima</h4>
                        <a href="{{ route('penerima.create') }}" class="btn btn-gradient-primary text-white">
                            + Tambah Penerima
                        </a>
                    </div>

                    <div class="table-responsive">

                        {{-- Search Bar --}}
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center gap-2">

                                <form method="GET" action="{{ route('penerima.index') }}">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="Nama Warga ">

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
                                    <a href="{{ route('penerima.index') }}" class="btn btn-outline-secondary">
                                        Clear
                                    </a>
                                @endif

                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead class="bg-gradient-primary text-white">
                                <tr>
                                    <th class="text-center fw-bold">ID</th>
                                    <th class="text-center fw-bold">Warga</th>
                                    <th class="text-center fw-bold">Program</th>
                                    <th class="text-center fw-bold">Keterangan</th>
                                    <th class="text-center fw-bold">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($penerima as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->warga->warga_id }}</td>

                                        <td>
                                            {{ $item->warga->nama ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $item->program->nama_program ?? '-' }}
                                        </td>

                                        <td>{{ $item->keterangan ?? '-' }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('penerima.edit', $item->penerima_id) }}"
                                                class="badge badge-gradient-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <a href="#" class="badge badge-gradient-danger"
                                                onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus data ini?')) {
                                            document.getElementById('delete-penerima-{{ $item->penerima_id }}').submit();}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>

                                            <form id="delete-penerima-{{ $item->penerima_id }}"
                                                action="{{ route('penerima.destroy', $item->penerima_id) }}" method="POST"
                                                style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            Belum ada data penerima
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $penerima->links('pagination::bootstrap-5') }}
                        </div>


                    </div>
                </div>

            </div>
        </div>
    @endsection
