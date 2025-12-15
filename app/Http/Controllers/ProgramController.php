<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{

    public function index(Request $request)
    {
        $data['dataProgram'] = Program::filter($request, ['tahun'])
            ->search($request, ['nama_program'])
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.program.index', $data);
    }

    public function create()
    {
        return view('pages.admin.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'         => 'required|unique:program,kode',
            'nama_program' => 'required',
            'tahun'        => 'required|integer',
            'anggaran'     => 'required|numeric|min:1',
            'deskripsi'    => 'required',
            'media.*'      => 'nullable|file|max:2048',
        ]);

        $program = Program::create($request->only(
            'kode', 'nama_program', 'tahun', 'anggaran', 'deskripsi'
        ));

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/program_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'program',
                    'ref_id'     => $program->program_id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('program.index')
            ->with('success', 'Program berhasil ditambahkan');
    }

    public function show($id)
    {
        $program = Program::with('media')->findOrFail($id);
        return view('pages.admin.program.show', compact('program'));
    }

    public function edit($id)
    {
        $data['dataProgram'] = Program::with('media')->findOrFail($id);
        return view('pages.admin.program.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'kode'         => 'required|unique:program,kode,' . $id . ',program_id',
            'nama_program' => 'required',
            'tahun'        => 'required|integer',
            'anggaran'     => 'required|numeric|min:1',
            'deskripsi'    => 'required',
            'media.*'      => 'nullable|file|max:2048',
        ]);

        $program->update($request->only(
            'kode', 'nama_program', 'tahun', 'anggaran', 'deskripsi'
        ));

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $i => $file) {
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/program_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'program',
                    'ref_id'     => $id,
                    'file_name'  => $fileName,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('program.index')
            ->with('success', 'Program berhasil diperbarui');
    }

    public function destroy($id)
    {
        $program = Program::with('media')->findOrFail($id);

        foreach ($program->media as $file) {
            Storage::disk('public')
                ->delete('uploads/program_bantuan/' . $file->file_name);
            $file->delete();
        }

        $program->delete();

        return redirect()->route('program.index')
            ->with('success', 'Program berhasil dihapus');
    }

    public function uploadMedia(Request $request, $programId)
    {
        $request->validate([
            'media.*' => 'required|file|max:2048',
        ]);

        foreach ($request->file('media') as $i => $file) {
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $file->storeAs('uploads/program_bantuan', $fileName, 'public');

            Media::create([
                'ref_table'  => 'program',
                'ref_id'     => $programId,
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

        abort_if($media->ref_table !== 'program', 403);

        return response()->download(
            storage_path('app/public/uploads/program_bantuan/' . $media->file_name)
        );
    }

    public function deleteFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        abort_if($media->ref_table !== 'program', 403);

        Storage::disk('public')
            ->delete('uploads/program_bantuan/' . $media->file_name);

        $media->delete();

        return back()->with('success', 'File berhasil dihapus');
    }
}
