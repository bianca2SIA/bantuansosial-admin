<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Pendaftar;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerifikasiController extends Controller
{
    /* =========================
     * INDEX
     * ========================= */
    public function index(Request $request)
    {
        $search = $request->search;

        $verifikasi = Verifikasi::with(['pendaftar.warga', 'pendaftar.program'])
            ->search($search)
            ->orderBy('verifikasi_id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.verifikasi.index', compact('verifikasi'));
    }

    /* =========================
     * CREATE
     * ========================= */
    public function create()
    {
        $pendaftar = Pendaftar::with(['warga', 'program'])->get();

        return view('pages.admin.verifikasi.create', compact('pendaftar'));
    }

    /* =========================
     * STORE
     * ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'pendaftar_id' => 'required|exists:pendaftar,pendaftar_id',
            'petugas'      => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string',
            'skor'         => 'required|integer|min:0',
            'media.*'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);

        $verifikasi = Verifikasi::create($request->only(
            'pendaftar_id',
            'petugas',
            'tanggal',
            'catatan',
            'skor'
        ));

        /* ===== MEDIA (SAMA PERSIS DENGAN PROGRAM) ===== */
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/verifikasi_lapangan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'verifikasi_lapangan',
                    'ref_id'     => $verifikasi->verifikasi_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Data verifikasi berhasil ditambahkan.');
    }

    /* =========================
     * SHOW
     * ========================= */
    public function show($id)
    {
        $verifikasi = Verifikasi::with([
            'pendaftar.warga',
            'pendaftar.program',
            'media'
        ])->findOrFail($id);

        return view('pages.admin.verifikasi.show', compact('verifikasi'));
    }

    /* =========================
     * EDIT
     * ========================= */
    public function edit($id)
    {
        $verifikasi = Verifikasi::with('media')->findOrFail($id);
        $pendaftar  = Pendaftar::with(['warga', 'program'])->get();

        return view('pages.admin.verifikasi.edit', compact('verifikasi', 'pendaftar'));
    }

    /* =========================
     * UPDATE
     * ========================= */
    public function update(Request $request, $id)
    {
        $verifikasi = Verifikasi::findOrFail($id);

        $request->validate([
            'pendaftar_id' => 'required|exists:pendaftar,pendaftar_id',
            'petugas'      => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string',
            'skor'         => 'required|integer|min:0',
            'media.*'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);

        $verifikasi->update($request->only(
            'pendaftar_id',
            'petugas',
            'tanggal',
            'catatan',
            'skor'
        ));

        /* ===== TAMBAH MEDIA BARU (TIDAK HAPUS LAMA) ===== */
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/verifikasi_lapangan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'verifikasi_lapangan',
                    'ref_id'     => $id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Data verifikasi berhasil diperbarui.');
    }

    /* =========================
     * DELETE DATA + MEDIA
     * ========================= */
    public function destroy($id)
    {
        $verifikasi = Verifikasi::with('media')->findOrFail($id);

        foreach ($verifikasi->media as $file) {
            Storage::disk('public')
                ->delete('uploads/verifikasi_lapangan/' . $file->file_name);
            $file->delete();
        }

        $verifikasi->delete();

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Data verifikasi berhasil dihapus.');
    }

    /* =========================
     * UPLOAD MEDIA (HALAMAN SHOW)
     * ========================= */
    public function uploadMedia(Request $request, $verifikasiId)
    {
        $request->validate([
            'media.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);

        foreach ($request->file('media') as $i => $file) {
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $file->storeAs('uploads/verifikasi_lapangan', $fileName, 'public');

            Media::create([
                'ref_table'  => 'verifikasi_lapangan',
                'ref_id'     => $verifikasiId,
                'file_name'  => $fileName,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => $i,
            ]);
        }

        return back()->with('success', 'Dokumen berhasil diupload.');
    }

    /* =========================
     * DOWNLOAD FILE
     * ========================= */
    public function downloadFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        abort_if($media->ref_table !== 'verifikasi_lapangan', 403);

        return response()->download(
            storage_path('app/public/uploads/verifikasi_lapangan/' . $media->file_name)
        );
    }

    /* =========================
     * DELETE FILE
     * ========================= */
    public function deleteFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        abort_if($media->ref_table !== 'verifikasi_lapangan', 403);

        Storage::disk('public')
            ->delete('uploads/verifikasi_lapangan/' . $media->file_name);

        $media->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }
}
