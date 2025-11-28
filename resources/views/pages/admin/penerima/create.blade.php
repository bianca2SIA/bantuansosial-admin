@extends('layouts.admin.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-check"></i>
                </span>
                Tambah Penerima Bantuan
            </h3>

            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('penerima.index') }}">Data Penerima</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Penerima</li>
                </ul>
            </nav>
        </div>

        {{-- Alert sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Alert error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
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

                        <h4 class="card-title mb-4">Form Tambah Penerima</h4>

                        <form action="{{ route('penerima.store') }}" method="POST">
                            @csrf

                            {{-- Program --}}
                            <div class="form-group">
                                <label>Program Bantuan</label>
                                <select name="program_id" class="form-control" required>
                                    <option value="">-- Pilih Program --</option>
                                    @foreach ($program as $item)
                                        <option value="{{ $item->program_id }}">
                                            {{ $item->nama_program }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Warga --}}
                            <div class="form-group">
                                <label>Nama Warga</label>
                                <select name="warga_id" class="form-control" required>
                                    <option value="">-- Pilih Warga --</option>
                                    @foreach ($warga as $item)
                                        <option value="{{ $item->warga_id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Keterangan --}}
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3"
                                    placeholder="Isi keterangan jika ada...">{{ old('keterangan') }}</textarea>
                            </div>

                            <div class="mt-4 d-flex justify-content-end">
                                <a href="{{ route('penerima.index') }}" class="btn btn-light me-2">
                                    <i class="mdi mdi-arrow-left"></i> Batal
                                </a>

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
@endsection
