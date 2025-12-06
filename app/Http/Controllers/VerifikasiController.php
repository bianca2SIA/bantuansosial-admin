<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Pendaftar;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerifikasiController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $verifikasi = Verifikasi::with(['pendaftar.warga'])
            ->search($search)
            ->orderBy('verifikasi_id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.verifikasi.index', compact('verifikasi'));
    }

    public function create()
    {
        $pendaftar = Pendaftar::with('warga')->get();

        return view('pages.admin.verifikasi.create', compact('pendaftar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendaftar_id' => 'required|integer|exists:pendaftar,pendaftar_id',
            'petugas'      => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string',
            'skor'         => 'required|integer|min:0',
            'media.*'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);

        $verifikasi = Verifikasi::create([
            'pendaftar_id' => $request->pendaftar_id,
            'petugas'      => $request->petugas,
            'tanggal'      => $request->tanggal,
            'catatan'      => $request->catatan,
            'skor'         => $request->skor,
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/verifikasi_lapangan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'verifikasi_lapangan',
                    'ref_id'     => $verifikasi->verifikasi_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => $request->caption[$index] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('verifikasi.index')
            ->with('success', 'Data verifikasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $verifikasi = Verifikasi::with('media')->findOrFail($id);
        $pendaftar  = Pendaftar::with('warga')->get();

        return view('pages.admin.verifikasi.edit', compact('verifikasi', 'pendaftar'));
    }

    public function update(Request $request, $id)
    {
        $verifikasi = Verifikasi::findOrFail($id);

        $request->validate([
            'pendaftar_id' => 'required|integer|exists:pendaftar,pendaftar_id',
            'petugas'      => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string',
            'skor'         => 'required|integer|min:0',

            'media.*'      => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:20480',

        ]);

        $verifikasi->update([
            'pendaftar_id' => $request->pendaftar_id,
            'petugas'      => $request->petugas,
            'tanggal'      => $request->tanggal,
            'catatan'      => $request->catatan,
            'skor'         => $request->skor,
        ]);

        if ($request->captions_existing) {
            foreach ($request->captions_existing as $mediaId => $caption) {
                Media::where('media_id', $mediaId)
                    ->update(['caption' => $caption]);
            }
        }

        if ($request->hasFile('media')) {

            foreach ($request->file('media') as $index => $file) {

                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/verifikasi_lapangan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'verifikasi_lapangan',
                    'ref_id'     => $verifikasi->verifikasi_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => $request->caption[$index] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('verifikasi.index')
            ->with('success', 'Data verifikasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $verifikasi = Verifikasi::findOrFail($id);

        $mediaFiles = Media::where('ref_table', 'verifikasi_lapangan')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaFiles as $m) {
            Storage::disk('public')->delete('uploads/verifikasi_lapangan/' . $m->file_name);
            $m->delete();
        }

        $verifikasi->delete();

        return redirect()->route('verifikasi.index')
            ->with('success', 'Data verifikasi berhasil dihapus.');
    }

    public function mediaList($id)
    {
        $files = Media::where('ref_table', 'verifikasi_lapangan')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        if ($files->isEmpty()) {
            return response()->json([
                'html' => '<p class="text-muted">Tidak ada foto verifikasi.</p>',
            ]);
        }

        $html = '<ul class="list-group">';

        foreach ($files as $file) {
            $url = asset("storage/uploads/verifikasi_lapangan/" . $file->file_name);

            $html .= '
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="' . $url . '" target="_blank" class="text-primary text-decoration-underline">
                        <i class="mdi mdi-image-outline"></i> ' . $file->file_name . '
                    </a>
                    <small class="text-muted">' . ($file->caption ?: "Tanpa caption") . '</small>
                </li>
            ';
        }

        $html .= '</ul>';

        return response()->json(['html' => $html]);
    }
}
