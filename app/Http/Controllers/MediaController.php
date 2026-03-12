<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function media()
    {
        $media = Media::all();
        return view('backend.media.index', compact('media'));
    }

    public function create()
    {
        return view('backend.media.create');
    }

    public function edit(Media $media)
    {
        return view('backend.media.edit', compact('media'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:image,video'],
            'image' => ['required_if:type,image', 'nullable', 'image', 'max:5120'],
            'video' => ['required_if:type,video', 'nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska', 'max:51200'],
        ]);

        $destinationPath = public_path('backend/media');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file = $validated['type'] === 'image'
            ? $request->file('image')
            : $request->file('video');

        if (!$file) {
            return back()->with('error', 'Please upload a valid file.')->withInput();
        }

        $extension = $file->getClientOriginalExtension() ?: ($validated['type'] === 'image' ? 'jpg' : 'mp4');
        $filename = time() . '_' . Str::random(12) . '.' . $extension;
        $file->move($destinationPath, $filename);

        Media::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'medial_name' => $filename,
            'media_url' => 'backend/media/' . $filename,
        ]);

        return redirect()->route('media.index')->with('success', 'Media created successfully.');
    }

    public function update(Request $request, Media $media)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:image,video'],
            'image' => ['nullable', 'image', 'max:5120'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska', 'max:51200'],
        ]);

        $validated = $validator->validate();

        $newType = $validated['type'];
        $newFile = $newType === 'image' ? $request->file('image') : $request->file('video');

        $hasExistingFile = !empty($media->media_url) || !empty($media->medial_name);

        // If type changed, require a new upload.
        if (($media->type ?? null) !== $newType && !$newFile) {
            return back()->withErrors([
                $newType === 'image' ? 'image' : 'video' => 'File is required when changing media type.',
            ])->withInput();
        }

        // If same type but no existing file and no new upload, block.
        if (($media->type ?? null) === $newType && !$hasExistingFile && !$newFile) {
            return back()->withErrors([
                $newType === 'image' ? 'image' : 'video' => 'Please upload a file.',
            ])->withInput();
        }

        // Replace file if a new one is uploaded
        if ($newFile) {
            $destinationPath = public_path('backend/media');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Delete old file from public folder
            $oldRelative = $media->media_url ?: ($media->medial_name ? ('backend/media/' . $media->medial_name) : null);
            if ($oldRelative) {
                $oldPath = public_path(ltrim($oldRelative, '/'));
                if (File::exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $extension = $newFile->getClientOriginalExtension() ?: ($newType === 'image' ? 'jpg' : 'mp4');
            $filename = time() . '_' . Str::random(12) . '.' . $extension;
            $newFile->move($destinationPath, $filename);

            $media->medial_name = $filename;
            $media->media_url = 'backend/media/' . $filename;
        }

        $media->title = $validated['title'];
        $media->description = $validated['description'] ?? null;
        $media->type = $newType;
        $media->save();

        return redirect()->route('media.index')->with('success', 'Media updated successfully.');
    }

    public function destroy(Media $media)
    {
        $relative = $media->media_url ?: ($media->medial_name ? ('backend/media/' . $media->medial_name) : null);
        if ($relative) {
            $path = public_path(ltrim($relative, '/'));
            if (File::exists($path)) {
                @unlink($path);
            }
        }

        $media->delete();

        return redirect()->route('media.index')->with('success', 'Media deleted successfully.');
    }
}
