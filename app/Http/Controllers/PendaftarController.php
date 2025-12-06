<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Pendaftar;
use App\Models\Program;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['status_seleksi'];
        $keyword           = $request->search;

        $pendaftar = Pendaftar::with(['program', 'warga'])
            ->filter($request, $filterableColumns)
            ->search($keyword)
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.pendaftar.index', compact('pendaftar'));
    }

    public function create()
    {
        $program = Program::all();
        $warga   = Warga::all();
        return view('pages.admin.pendaftar.create', compact('program', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id'     => 'required|exists:program,program_id',
            'warga_id'       => 'required|exists:warga,warga_id',
            'status_seleksi' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);

        $pendaftar = Pendaftar::create([
            'program_id'     => $request->program_id,
            'warga_id'       => $request->warga_id,
            'status_seleksi' => $request->status_seleksi,
        ]);

        return redirect()->route('pendaftar.index')
            ->with('success', 'Data pendaftar bantuan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pendaftar = Pendaftar::with(['program', 'warga'])->findOrFail($id);
        return view('pages.admin.pendaftar.show', compact('pendaftar'));
    }

    public function edit($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $program   = Program::all();
        $warga     = Warga::all();

        return view('pages.admin.pendaftar.edit', compact('pendaftar', 'program', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $request->validate([
            'program_id'     => 'required|exists:program,program_id',
            'warga_id'       => 'required|exists:warga,warga_id',
            'status_seleksi' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);

        // Update data utama
        $pendaftar->update([
            'program_id'     => $request->program_id,
            'warga_id'       => $request->warga_id,
            'status_seleksi' => $request->status_seleksi,
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
                $file->storeAs('uploads/pendaftar_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'pendaftar_bantuan',
                    'ref_id'     => $pendaftar->pendaftar_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => $request->caption[$index] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('pendaftar.index')
            ->with('success', 'Data pendaftar bantuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $mediaFiles = Media::where('ref_table', 'pendaftar_bantuan')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaFiles as $m) {
            Storage::disk('public')->delete('uploads/pendaftar_bantuan/' . $m->file_name);
            $m->delete();
        }

        $pendaftar->delete();

        return redirect()->route('pendaftar.index')
            ->with('success', 'Data pendaftar bantuan berhasil dihapus!');
    }

    public function mediaList($id)
    {
        $files = Media::where('ref_table', 'pendaftar_bantuan')
            ->where('ref_id', $id)
            ->get();

        if ($files->isEmpty()) {
            return response()->json([
                'html' => '<p class="text-muted">Tidak ada dokumen.</p>',
            ]);
        }

        $html = '<ul class="list-group">';

        foreach ($files as $file) {

            $url = asset("storage/uploads/pendaftar_bantuan/" . $file->file_name);

            $html .= '
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="' . $url . '" target="_blank" class="text-primary text-decoration-underline">
                        <i class="mdi mdi-file-outline"></i> ' . $file->file_name . '
                    </a>
                    <small class="text-muted">' . ($file->caption ?: "Tanpa caption") . '</small>
                </li>
            ';
        }

        $html .= '</ul>';

        return response()->json(['html' => $html]);
    }
}
