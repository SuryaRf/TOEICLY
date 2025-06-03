<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class CertificateController extends Controller
{
public function viewPdf($filename)
    {
        // Validate filename to prevent directory traversal
        if (!preg_match('/^[a-zA-Z0-9_\-\.]+\.pdf$/', $filename)) {
            abort(400, 'Invalid filename.');
        }

        $path = 'jadwal_pdf/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        $file = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}