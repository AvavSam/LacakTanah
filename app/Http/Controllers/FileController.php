<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemException;

class FileController extends Controller
{
    public function serveAzureFile($path)
    {
        try {
            // Check if file exists
            if (!Storage::disk('azure')->exists($path)) {
                abort(404);
            }

            // Get file mime type and contents
            $mime = Storage::disk('azure')->mimeType($path);
            $content = Storage::disk('azure')->get($path);

            // Get the filename for the download
            $filename = basename($path);

            // Determine if it's an image
            $isImage = str_starts_with($mime, 'image/');

            // Set proper headers - display images inline, download other files
            $headers = [
                'Content-Type' => $mime,
                'Cache-Control' => 'public, max-age=86400',
            ];

            if (!$isImage) {
                $headers['Content-Disposition'] = 'attachment; filename="' . $filename . '"';
            }

            return response($content, 200, $headers);

        } catch (FilesystemException $e) {
            abort(500, 'Error retrieving file');
        }
    }
}
