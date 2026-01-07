@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-edit"></i>
                    </span> Data Warga
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
                        <h4 class="card-title mb-0">List Data Seluruh Warga</h4>
                        <a href="{{ route('warga.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Tambah Warga
                        </a>

                    </div>

                    <div class="table-responsive">
                        <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                            <div class="row align-items-center">

                                <div class="col-md-2">
                                    <select name="jenis_kelamin" class="form-select filter-control"
                                        onchange="this.form.submit()">

                                        <option value="">Jenis Kelamin</option>
                                        <option value="Laki-Laki"
                                            {{ request('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
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
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817
                                                        4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
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
                                    <th class="text-center fw-bold">No</th>
                                    <th class="text-center fw-bold">No_KTP</th>
                                    <th class="text-center fw-bold">Nama</th>
                                    <th class="text-center fw-bold">Jenis Kelamin</th>
                                    <th class="text-center fw-bold">Agama</th>
                                    <th class="text-center fw-bold">Pekerjaan</th>
                                    <th class="text-center fw-bold">Telp</th>
                                    <th class="text-center fw-bold">Email</th>
                                    <th class="text-center fw-bold">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataWarga as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_ktp }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->agama }}</td>
                                        <td>{{ $item->pekerjaan }}</td>
                                        <td class="text-center">{{ $item->telp }}</td>
                                        <td>{{ $item->email }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('warga.edit', $item->warga_id) }}"
                                                class="badge badge-gradient-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <a href="#" class="badge badge-gradient-danger"
                                                onclick="event.preventDefault(); if(confirm('Yakin hapus data ini?')) {
                                                document.getElementById('delete-warga-{{ $item->warga_id }}')
                                                .submit();}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>

                                            <form id="delete-warga-{{ $item->warga_id }}"
                                                action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                                style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>


                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data warga
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $dataWarga->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
