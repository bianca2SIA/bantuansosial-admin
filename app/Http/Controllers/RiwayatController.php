<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Penerima;
use App\Models\Program;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['program_id', 'tahap_ke'];
        $search            = $request->search;

        $riwayat = Riwayat::with(['program', 'penerima.warga', 'media'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('penerima.warga', function ($w) use ($search) {
                    $w->where('nama', 'like', "%$search%");
                });
            })
            ->filter($request, $filterableColumns)
            ->orderBy('riwayat_id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.riwayat.index', compact('riwayat'));
    }

    public function create()
    {
        $program  = Program::all();
        $penerima = Penerima::with('warga')->get();

        return view('pages.admin.riwayat.create', compact('program', 'penerima'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id'  => 'required',
            'penerima_id' => 'required',
            'tahap_ke'    => 'required|integer|min:1',
            'tanggal'     => 'required|date',
            'nilai'       => 'required|numeric|min:0',
        ]);

        $riwayat = Riwayat::create([
            'program_id'  => $request->program_id,
            'penerima_id' => $request->penerima_id,
            'tahap_ke'    => $request->tahap_ke,
            'tanggal'     => $request->tanggal,
            'nilai'       => $request->nilai,
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {

                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/riwayat_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'riwayat_bantuan',
                    'ref_id'     => $riwayat->riwayat_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => $request->caption[$i] ?? null,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('riwayat.index')->with('success', 'Data riwayat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $riwayat  = Riwayat::with('media')->findOrFail($id);
        $program  = Program::all();
        $penerima = Penerima::with('warga')->get();

        return view('pages.admin.riwayat.edit', compact('riwayat', 'program', 'penerima'));
    }

    public function update(Request $request, $id)
    {
        $riwayat = Riwayat::findOrFail($id);

        $request->validate([
            'program_id'  => 'required',
            'penerima_id' => 'required',
            'tahap_ke'    => 'required|integer|min:1',
            'tanggal'     => 'required|date',
            'nilai'       => 'required|numeric|min:0',
        ]);

        $riwayat->update([
            'program_id'  => $request->program_id,
            'penerima_id' => $request->penerima_id,
            'tahap_ke'    => $request->tahap_ke,
            'tanggal'     => $request->tanggal,
            'nilai'       => $request->nilai,
        ]);

        if ($request->captions_existing) {
            foreach ($request->captions_existing as $mediaId => $caption) {
                Media::where('media_id', $mediaId)->update(['caption' => $caption]);
            }
        }

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {

                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/riwayat_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'riwayat_bantuan',
                    'ref_id'     => $riwayat->riwayat_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'caption'    => $request->caption[$i] ?? null,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('riwayat.index')->with('success', 'Data riwayat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $riwayat = Riwayat::findOrFail($id);

        $mediaFiles = Media::where('ref_table', 'riwayat_bantuan')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaFiles as $m) {
            Storage::disk('public')->delete('uploads/riwayat_bantuan/' . $m->file_name);
            $m->delete();
        }

        $riwayat->delete();

        return redirect()->route('riwayat.index')->with('success', 'Data riwayat berhasil dihapus.');
    }
    
    public function mediaList($id)
    {
        $files = Media::where('ref_table', 'riwayat_bantuan')
            ->where('ref_id', $id)
            ->get();

        if ($files->isEmpty()) {
            return response()->json([
                'html' => '<p class="text-muted">Tidak ada dokumen.</p>',
            ]);
        }

        $html = '<ul class="list-group">';

        foreach ($files as $file) {
            $url = asset("storage/uploads/riwayat_bantuan/" . $file->file_name);

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
