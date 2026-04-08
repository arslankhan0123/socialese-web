<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        return view('backend.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('backend.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'feature_image' => ['required', 'image'],
            'gallery_images' => ['required', 'array'],
            'gallery_images.*' => ['image'],
            'gallery_videos' => ['nullable', 'array'],
            'gallery_videos.*' => ['mimes:mp4,mov,ogg,qt,webm'],
        ]);

        $uploadPath = public_path('uploads/galleries');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        // feature image upload
        $featureImage = null;
        if ($request->hasFile('feature_image')) {
            $file = $request->file('feature_image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $featureImage = 'uploads/galleries/' . $fileName;
        }

        // gallery images upload
        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                if ($image->isValid()) {
                    $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($uploadPath, $fileName);
                    $galleryImages[] = 'uploads/galleries/' . $fileName;
                }
            }
        }

        // gallery videos upload
        $galleryVideos = [];
        if ($request->hasFile('gallery_videos')) {
            foreach ($request->file('gallery_videos') as $video) {
                if ($video->isValid()) {
                    $fileName = time() . '_' . uniqid() . '.' . $video->getClientOriginalExtension();
                    $video->move($uploadPath, $fileName);
                    $galleryVideos[] = 'uploads/galleries/' . $fileName;
                }
            }
        }

        Gallery::create([
            'name' => $request->name,
            'feature_image' => $featureImage,
            'gallery_images' => array_values($galleryImages),
            'gallery_videos' => array_values($galleryVideos),
        ]);

        return redirect()->route('gallery.index')->with('success', 'Gallery created successfully.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backend.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'feature_image' => ['nullable', 'image'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image'],
            'gallery_videos' => ['nullable', 'array'],
            'gallery_videos.*' => ['mimes:mp4,mov,ogg,qt,webm'],
        ]);
        $currentImages = is_array($gallery->gallery_images) ? $gallery->gallery_images : [];
        $currentVideos = is_array($gallery->gallery_videos) ? $gallery->gallery_videos : [];

        $uploadPath = public_path('uploads/galleries');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        // Delete selected images via checkboxes
        if ($request->delete_images && is_array($request->delete_images)) {
            foreach ($request->delete_images as $img) {
                if ($img && File::exists(public_path($img))) {
                    File::delete(public_path($img));
                }
                $currentImages = array_diff($currentImages, [$img]);
            }
        }

        // Delete selected videos via checkboxes
        if ($request->delete_videos && is_array($request->delete_videos)) {
            foreach ($request->delete_videos as $vid) {
                if ($vid && File::exists(public_path($vid))) {
                    File::delete(public_path($vid));
                }
                $currentVideos = array_diff($currentVideos, [$vid]);
            }
        }

        // Upload new gallery images (REPLACE existing if new ones provided)
        if ($request->hasFile('gallery_images')) {
            // Delete ALL current images first
            foreach ($currentImages as $img) {
                if ($img && File::exists(public_path($img))) {
                    File::delete(public_path($img));
                }
            }
            $currentImages = []; // Reset array

            foreach ($request->file('gallery_images') as $image) {
                if ($image->isValid()) {
                    $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move($uploadPath, $fileName);
                    $currentImages[] = 'uploads/galleries/' . $fileName;
                }
            }
        }

        // Upload new gallery videos (REPLACE existing if new ones provided)
        if ($request->hasFile('gallery_videos')) {
            // Delete ALL current videos first
            foreach ($currentVideos as $vid) {
                if ($vid && File::exists(public_path($vid))) {
                    File::delete(public_path($vid));
                }
            }
            $currentVideos = []; // Reset array

            foreach ($request->file('gallery_videos') as $video) {
                if ($video->isValid()) {
                    $fileName = time() . '_' . uniqid() . '.' . $video->getClientOriginalExtension();
                    $video->move($uploadPath, $fileName);
                    $currentVideos[] = 'uploads/galleries/' . $fileName;
                }
            }
        }

        // Update feature image
        $featureImage = $gallery->feature_image;
        if ($request->hasFile('feature_image')) {
            if ($featureImage && File::exists(public_path($featureImage))) {
                File::delete(public_path($featureImage));
            }
            $file = $request->file('feature_image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $featureImage = 'uploads/galleries/' . $fileName;
        }

        $gallery->update([
            'name' => $request->name,
            'feature_image' => $featureImage,
            'gallery_images' => array_values($currentImages),
            'gallery_videos' => array_values($currentVideos)
        ]);

        return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully');
    }

    // public function update(Request $request, $id)
    // {
    //     $gallery = Gallery::findOrFail($id);

    //     $validated = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'feature_image' => ['nullable', 'image'],
    //         'gallery_images' => ['nullable'],
    //     ]);

    //     // Update feature image if provided
    //     if ($request->hasFile('feature_image')) {
    //         // Delete old feature image
    //         if ($gallery->feature_image && Storage::disk('public')->exists($gallery->feature_image)) {
    //             Storage::disk('public')->delete($gallery->feature_image);
    //         }

    //         // Upload new feature image
    //         $featureImage = $request->file('feature_image')->store('galleries', 'public');
    //         $gallery->feature_image = $featureImage;
    //     }

    //     // Update gallery images if provided
    //     if ($request->hasFile('gallery_images')) {
    //         // Delete old gallery images
    //         if ($gallery->gallery_images) {
    //             $images = json_decode($gallery->gallery_images, true);
    //             if (is_array($images)) {
    //                 foreach ($images as $image) {
    //                     if (Storage::disk('public')->exists($image)) {
    //                         Storage::disk('public')->delete($image);
    //                     }
    //                 }
    //             }
    //         }

    //         // Upload new gallery images
    //         $galleryImages = [];
    //         foreach ($request->file('gallery_images') as $image) {
    //             $path = $image->store('galleries', 'public');
    //             $galleryImages[] = $path;
    //         }
    //         $gallery->gallery_images = json_encode($galleryImages);
    //     }

    //     // Update other fields
    //     $gallery->name = $validated['name'];
    //     $gallery->save();

    //     return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully.');
    // }

    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete feature image
        if ($gallery->feature_image && File::exists(public_path($gallery->feature_image))) {
            File::delete(public_path($gallery->feature_image));
        }

        // Delete gallery images
        $images = is_array($gallery->gallery_images) ? $gallery->gallery_images : [];
        foreach ($images as $image) {
            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
        }

        // Delete gallery videos
        $videos = is_array($gallery->gallery_videos) ? $gallery->gallery_videos : [];
        foreach ($videos as $video) {
            if (File::exists(public_path($video))) {
                File::delete(public_path($video));
            }
        }

        // Delete record
        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery deleted successfully.');
    }
}
