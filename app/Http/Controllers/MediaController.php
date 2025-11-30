<?php
namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    public static function saveFiles($files, $refTable, $refId)
    {
        if (! $files) {
            return;
        }

        foreach ($files as $file) {

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = "media/$refTable/$refId";

            $file->storeAs($path, $fileName, 'public');

            Media::create([
                'ref_table'  => $refTable,
                'ref_id'     => $refId,
                'file_name'  => $fileName,
                'mime_type'  => $file->getClientMimeType(),
                'caption'    => null,
                'sort_order' => 0,
            ]);
        }
    }

    public function view($id)
    {
        $media = Media::findOrFail($id);

        $filePath = storage_path(
            'app/public/media/' . $media->ref_table . '/' . $media->ref_id . '/' . $media->file_name
        );

        if (! file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($filePath);
    }

    public function delete($id)
    {
        $media = Media::findOrFail($id);

        $filePath = storage_path(
            'app/public/media/' . $media->ref_table . '/' . $media->ref_id . '/' . $media->file_name
        );

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $media->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }

    public function updateCaption(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $media->caption = $request->caption;
        $media->save();

        return back()->with('success', 'Caption berhasil diperbarui.');
    }
}
