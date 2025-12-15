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
            'media.*'     => 'nullable|file|max:2048',
        ]);

        $riwayat = Riwayat::create($request->only(
            'program_id',
            'penerima_id',
            'tahap_ke',
            'tanggal',
            'nilai'
        ));

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/riwayat_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'riwayat_bantuan',
                    'ref_id'     => $riwayat->riwayat_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('riwayat.index')
            ->with('success', 'Riwayat berhasil ditambahkan');
    }

    public function show($id)
    {
        $riwayat = Riwayat::with(['program', 'penerima.warga', 'media'])
            ->findOrFail($id);

        return view('pages.admin.riwayat.show', compact('riwayat'));
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
            'media.*'     => 'nullable|file|max:2048',
        ]);

        $riwayat->update($request->only(
            'program_id',
            'penerima_id',
            'tahap_ke',
            'tanggal',
            'nilai'
        ));

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/riwayat_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'riwayat_bantuan',
                    'ref_id'     => $id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('riwayat.index')
            ->with('success', 'Riwayat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $riwayat = Riwayat::with('media')->findOrFail($id);

        foreach ($riwayat->media as $file) {
            Storage::disk('public')
                ->delete('uploads/riwayat_bantuan/' . $file->file_name);
            $file->delete();
        }

        $riwayat->delete();

        return redirect()->route('riwayat.index')
            ->with('success', 'Riwayat berhasil dihapus');
    }

    public function uploadMedia(Request $request, $riwayatId)
    {
        $request->validate([
            'media.*' => 'required|file|max:2048',
        ]);

        foreach ($request->file('media') as $i => $file) {
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $file->storeAs('uploads/riwayat_bantuan', $fileName, 'public');

            Media::create([
                'ref_table'  => 'riwayat_bantuan',
                'ref_id'     => $riwayatId,
                'file_name'  => $fileName,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => $i,
            ]);
        }

        return back()->with('success', 'Dokumen berhasil diupload');
    }

    public function downloadFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        abort_if($media->ref_table !== 'riwayat_bantuan', 403);

        return response()->download(
            storage_path('app/public/uploads/riwayat_bantuan/' . $media->file_name)
        );
    }

    public function deleteFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        abort_if($media->ref_table !== 'riwayat_bantuan', 403);

        Storage::disk('public')
            ->delete('uploads/riwayat_bantuan/' . $media->file_name);

        $media->delete();

        return back()->with('success', 'File berhasil dihapus');
    }
}
