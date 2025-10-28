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
                        <a href="{{ route('warga.create') }}" class="btn btn-gradient-primary text-white">
                            + Tambah Warga
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-gradient-primary text-white">
                                <tr>
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
                                        <td>{{ $item->no_ktp }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->agama }}</td>
                                        <td>{{ $item->pekerjaan }}</td>
                                        <td>{{ $item->telp }}</td>
                                        <td>{{ $item->email }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('warga.edit', $item->warga_id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                                style="display:inline;">


                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
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
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
