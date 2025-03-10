<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; // Ensure this is imported

class FileController extends Controller
{
    public function index()
    {
        $files = UploadedFile::all();
        return view('files.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,docx|max:10240',
        ]);

        $path = $request->file('file')->store('uploads');
        UploadedFile::create([
            'filename' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
            'expires_at' => now()->addDay(),
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $file = UploadedFile::findOrFail($id);
        Storage::delete($file->path);
        $file->delete();
        return redirect()->back();
    }
}
