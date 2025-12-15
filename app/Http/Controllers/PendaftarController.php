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
        return view('pages.admin.pendaftar.create', [
            'program' => Program::all(),
            'warga'   => Warga::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id'     => 'required|exists:program,program_id',
            'warga_id'       => 'required|exists:warga,warga_id',
            'status_seleksi' => 'required|in:Menunggu,Diterima,Ditolak',
            'media.*'        => 'nullable|file|max:2048',
        ]);

        $pendaftar = Pendaftar::create($request->only(
            'program_id',
            'warga_id',
            'status_seleksi'
        ));

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/pendaftar_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'pendaftar',
                    'ref_id'     => $pendaftar->pendaftar_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()
            ->route('pendaftar.index')
            ->with('success', 'Data pendaftar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pendaftar = Pendaftar::with(['program', 'warga', 'media'])
            ->findOrFail($id);

        return view('pages.admin.pendaftar.show', compact('pendaftar'));
    }

    public function edit($id)
    {
        return view('pages.admin.pendaftar.edit', [
            'pendaftar' => Pendaftar::with('media')->findOrFail($id),
            'program'   => Program::all(),
            'warga'     => Warga::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $request->validate([
            'program_id'     => 'required|exists:program,program_id',
            'warga_id'       => 'required|exists:warga,warga_id',
            'status_seleksi' => 'required|in:Menunggu,Diterima,Ditolak',
            'media.*'        => 'nullable|file|max:2048',
        ]);

        $pendaftar->update($request->only(
            'program_id',
            'warga_id',
            'status_seleksi'
        ));

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/pendaftar_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'pendaftar',
                    'ref_id'     => $id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()
            ->route('pendaftar.index')
            ->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pendaftar = Pendaftar::with('media')->findOrFail($id);

        foreach ($pendaftar->media as $file) {
            Storage::disk('public')
                ->delete('uploads/pendaftar_bantuan/' . $file->file_name);
            $file->delete();
        }

        $pendaftar->delete();

        return redirect()
            ->route('pendaftar.index')
            ->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function uploadMedia(Request $request, $pendaftarId)
    {
        $request->validate([
            'media.*' => 'required|file|max:2048',
        ]);

        foreach ($request->file('media') as $i => $file) {
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $file->storeAs('uploads/pendaftar_bantuan', $fileName, 'public');

            Media::create([
                'ref_table'  => 'pendaftar',
                'ref_id'     => $pendaftarId,
                'file_name'  => $fileName,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => $i,
            ]);
        }

        return back()->with('success', 'Dokumen berhasil diupload.');
    }

    public function downloadFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        abort_if($media->ref_table !== 'pendaftar', 403);

        return response()->download(
            storage_path('app/public/uploads/pendaftar_bantuan/' . $media->file_name)
        );
    }

    public function deleteFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        abort_if($media->ref_table !== 'pendaftar', 403);

        Storage::disk('public')
            ->delete('uploads/pendaftar_bantuan/' . $media->file_name);

        $media->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }
}
