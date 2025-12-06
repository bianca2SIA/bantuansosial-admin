<?php
namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        $path = 'uploads/program_bantuan/' . $media->file_name;

        Storage::disk('public')->delete($path);
        $media->delete();

        return response()->json(['success' => true]);
    }
    public function view($id)
    {
        $media = Media::findOrFail($id);

        $filePath = storage_path('app/public/uploads/program_bantuan/' . $media->file_name);

        if (! file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($filePath);
    }
    public function updateCaption(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $media->caption = $request->caption;
        $media->save();

        return response()->json(['success' => true]);
    }
}
