<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TiptapUploadController extends Controller
{
    /**
     * Upload endpoint used by the TipTap editor toolbar.
     * Accepts any file type up to 50MB.
     * Returns JSON payload: { url: string }
     */
    public function upload(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'file' => 'required|file|max:51200', // max 50MB, any file type
        ]);

        $file = $validated['file'];

        $originalName = $file->getClientOriginalName();
        $ext = strtolower($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'bin');

        $name = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        if ($name === '') {
            $name = 'upload';
        }

        $path = $file->storeAs(
            'tiptap',
            $name . '-' . uniqid() . '.' . $ext,
            'public'
        );

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
