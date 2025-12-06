@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-edit"></i>
                    </span> Data User
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
                        <h4 class="card-title mb-0">List Data Seluruh User</h4>
                        <a href="{{ route('user.create') }}" class="btn btn-gradient-primary text-white">
                            + Tambah User
                        </a>
                    </div>

                    <div class="table-responsive">
                        <!-- Search + Clear -->
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <form method="GET" action="{{ route('user.index') }}">
                                    <div class="input-group">

                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="Nama User">


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
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                        class="btn btn-outline-secondary">
                                        Clear
                                    </a>
                                @endif
                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead class="bg-gradient-primary text-white">
                                <tr>
                                    <th class="text-center fw-bold">Nama</th>
                                    <th class="text-center fw-bold">Email</th>
                                    <th class="text-center fw-bold">Role</th>
                                    <th class="text-center fw-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataUser as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td class="text-center">
                                            @if ($item->role == 'Super Admin')
                                                <span class="badge badge-gradient-info">Super Admin</span>
                                            @elseif ($item->role == 'Admin Bansos')
                                                <span class="badge badge-gradient-warning">Admin Bansos</span>
                                            @elseif ($item->role == 'Verifikator')
                                                <span class="badge badge-gradient-primary">Verifikator</span>
                                            @elseif ($item->role == 'Operator Penyaluran')
                                                <span class="badge badge-gradient-danger">Operator Penyaluran</span>
                                            @elseif ($item->role == 'Warga')
                                                <span class="badge badge-gradient-success">Warga</span>
                                            @endif
                                        </td>


                                        <td class="text-center">
                                            <a href="{{ route('user.edit', $item->id) }}"
                                                class="badge badge-gradient-warning">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <a href="#" class="badge badge-gradient-danger"
                                                onclick="event.preventDefault(); if(confirm('Yakin hapus data ini?')) {
                                            document.getElementById('delete-user-{{ $item->id }}').submit();}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>

                                            <form id="delete-user-{{ $item->id }}"
                                                action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada data user
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $dataUser->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
