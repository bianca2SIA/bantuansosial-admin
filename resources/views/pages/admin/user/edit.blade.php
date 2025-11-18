@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-account-edit"></i>
                    </span> Edit Data User
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ul>
                </nav>
            </div>

            {{-- Alert sukses --}}
            @if (session('success'))
                <div
                    style="background-color: #d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Alert error validasi --}}
            @if ($errors->any())
                <div
                    style="background-color:#f8d7da; color:#842029; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Form Edit User</h4>

                            <form class="forms-sample" method="POST" action="{{ route('user.update', $dataUser->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Pengguna</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $dataUser->name) }}" placeholder="Masukkan nama pengguna"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $dataUser->email) }}" placeholder="Masukkan email pengguna"
                                        required>
                                </div>



                                <div class="form-group">
                                    <label>Password (kosongkan jika tidak ingin diubah)</label>
                                    <input type="text" name="password" class="form-control"
                                        placeholder="Masukkan password baru (opsional)">
                                </div>

                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="text" name="password_confirmation" class="form-control"
                                        placeholder="Ulangi password baru (opsional)">
                                </div>


                                <div class="mt-4 d-flex justify-content-end">
                                    <!-- Tombol Batal -->
                                    <a href="/warga" class="btn btn-light me-2">
                                        <i class="mdi mdi-arrow-left"></i> Batal
                                    </a>

                                    <!-- Tombol Simpan -->
                                    <button type="submit" class="btn btn-gradient-primary text-white">
                                        <i class="mdi mdi-content-save"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- end main content --}}
    @endsection
