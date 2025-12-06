@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-layers"></i>
                    </span> Edit Program Bantuan
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/program">Program Bantuan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Program</li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Form Edit Program</h4>
                            <form class="forms-sample" method="POST"
                                action="{{ route('program.update', $dataProgram->program_id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Program</label>
                                    <input type="text" name="nama_program" class="form-control"
                                        value="{{ old('nama_program', $dataProgram->nama_program) }}"
                                        placeholder="Masukkan nama program" required>
                                </div>

                                <div class="form-group">
                                    <label>Kode Program</label>
                                    <input type="text" name="kode" class="form-control"
                                        value="{{ old('kode', $dataProgram->kode) }}" placeholder="Masukkan kode program"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select name="tahun" class="form-control" required>
                                        <option value="">-- Pilih Tahun --</option>

                                        @for ($tahun = 2000; $tahun <= date('Y'); $tahun++)
                                            <option value="{{ $tahun }}"
                                                {{ old('tahun', $dataProgram->tahun) == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Anggaran (Rp)</label>
                                    <input type="number" name="anggaran" class="form-control"
                                        value="{{ old('anggaran', $dataProgram->anggaran) }}"
                                        placeholder="Masukkan anggaran" required>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi program" required>{{ old('deskripsi', $dataProgram->deskripsi) }}</textarea>
                                </div>

                                <hr class="my-4">
                                <h4 class="card-title mb-3">Dokumen Program</h4>

                                @foreach ($dataProgram->media as $file)
                                    <div class="d-flex align-items-center mb-2">

                                        <a href="{{ asset('storage/uploads/program_bantuan/' . $file->file_name) }}"
                                            target="_blank" class="d-flex align-items-center"
                                            style="font-size:13px; text-decoration:underline; color:#0d6efd;">
                                            <i class="mdi mdi-file-outline me-1" style="font-size:17px;"></i>
                                            <span>{{ $file->file_name }}</span>
                                        </a>

                                        <input type="text" name="captions_existing[{{ $file->media_id }}]"
                                            class="form-control ms-3" style="max-width:220px; height:30px; font-size:13px;"
                                            placeholder="Caption" value="{{ $file->caption }}">

                                        <button type="button" class="btn btn-link text-danger ms-2 p-0 delete-media"
                                            data-id="{{ $file->media_id }}" style="font-size:18px;">
                                            <i class="mdi mdi-close-circle-outline"></i>
                                        </button>

                                    </div>
                                @endforeach

                                @if ($dataProgram->media->count() == 0)
                                    <p class="text-muted" style="font-size: 13px;">Belum ada dokumen.</p>
                                @endif

                                <div class="form-group mt-4">
                                    <label style="font-size: 14px; font-weight: 600;">Tambah Dokumen Baru</label>
                                    <input type="file" name="media[]" multiple class="form-control"
                                        style="height: 45px;">
                                </div>

                                <div class="mt-4 d-flex justify-content-end">

                                    <a href="/program" class="btn btn-light me-2">
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
        <script>
            document.querySelectorAll('.delete-media').forEach(btn => {

                btn.addEventListener('click', function() {

                    const id = this.getAttribute('data-id');

                    if (!confirm("Hapus file ini?")) return;

                    fetch("/media/" + id, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json"
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                });
            });
        </script>
        {{-- end main content --}}
    @endsection
