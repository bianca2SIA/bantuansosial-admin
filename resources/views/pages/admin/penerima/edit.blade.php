@extends('layouts.admin.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-edit"></i>
                </span> Edit Data Penerima
            </h3>

            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('penerima.index') }}">Data Penerima</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Penerima</li>
                </ul>
            </nav>
        </div>

        {{-- Alert sukses --}}
        @if (session('success'))
            <div style="background-color: #d1e7dd; color:#0f5132; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Alert error --}}
        @if ($errors->any())
            <div style="background-color:#f8d7da; color:#842029; border-radius:8px; padding:10px 15px; margin-bottom:20px;">
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
                        <h4 class="card-title mb-4">Form Edit Penerima</h4>

                        <form method="POST" action="{{ route('penerima.update', $penerima->penerima_id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Program --}}
                            <div class="form-group">
                                <label>Program Bantuan</label>
                                <select name="program_id" class="form-control" required>
                                    <option value="">-- Pilih Program --</option>
                                    @foreach ($program as $item)
                                        <option value="{{ $item->program_id }}"
                                            {{ old('program_id', $penerima->program_id) == $item->program_id ? 'selected' : '' }}>
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
                                        <option value="{{ $item->warga_id }}"
                                            {{ old('warga_id', $penerima->warga_id) == $item->warga_id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Keterangan --}}
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3"
                                    placeholder="Isi keterangan">{{ old('keterangan', $penerima->keterangan) }}</textarea>
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
