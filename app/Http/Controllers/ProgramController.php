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
        $filterableColumns = ['tahun'];
        $searchableColumns = ['nama_program'];

        $data['dataProgram'] = Program::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
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
        // VALIDASI LAMA TETAP
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'kode'         => 'required|string|max:50|unique:program,kode',
            'tahun'        => 'required|integer|min:2000|max:2100',
            'anggaran'     => 'required|numeric|min:1',
            'deskripsi'    => 'required|string|max:1000',
        ]);

        // SIMPAN PROGRAM
        $program = Program::create($request->only(
            'kode', 'nama_program', 'tahun', 'deskripsi', 'anggaran'
        ));

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/program_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'program',
                    'ref_id'     => $program->program_id,
                    'file_name'  => $fileName,
                    'caption'    => $request->caption[$index] ?? null,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('program.index')
            ->with('success', 'Data Program Bantuan berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $data['dataProgram'] = Program::findOrFail($id);
        return view('pages.admin.program.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'nama_program' => 'required|string|max:255',
            'kode'         => 'required|string|max:50|unique:program,kode,' . $id . ',program_id',
            'tahun'        => 'required|integer|min:2010|max:2030',
            'anggaran'     => 'required|numeric|min:1',
            'deskripsi'    => 'required|string|max:1000',
        ]);

        // UPDATE PROGRAM
        $program->update($request->only(
            'nama_program', 'kode', 'tahun', 'anggaran', 'deskripsi'
        ));

        if ($request->captions_existing) {
            foreach ($request->captions_existing as $mediaId => $caption) {
                Media::where('media_id', $mediaId)->update([
                    'caption' => $caption,
                ]);
            }
        }

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $index => $file) {

                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('uploads/program_bantuan', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'program',
                    'ref_id'     => $id,
                    'file_name'  => $fileName,
                    'caption'    => $request->caption[$index] ?? null,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('program.index')
            ->with('success', 'Data Program Bantuan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);

        $mediaFiles = Media::where('ref_table', 'program')
            ->where('ref_id', $id)->get();

        foreach ($mediaFiles as $m) {
            Storage::disk('public')->delete('uploads/program_bantuan/' . $m->file_name);
            $m->delete();
        }

        $program->delete();

        return redirect()->route('program.index')
            ->with('success', 'Data Program Bantuan berhasil dihapus!');
    }

    public function mediaList($id)
    {
        $files = Media::where('ref_table', 'program')
            ->where('ref_id', $id)
            ->get();

        if ($files->count() == 0) {
            return response()->json([
                'html' => '<p class="text-muted">Tidak ada dokumen.</p>',
            ]);
        }

        $html = '<ul class="list-group">';

        foreach ($files as $file) {

            $url = asset("storage/uploads/program_bantuan/" . $file->file_name);

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
