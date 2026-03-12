<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'feature_image' => ['required', 'image'],
            'gallery_images' => ['required'],
        ]);

        // feature image upload
        $featureImage = $request->file('feature_image')->store('galleries', 'public');

        // gallery images upload
        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('galleries', 'public');
                $galleryImages[] = $path;
            }
        }

        Gallery::create([
            'name' => $validated['name'],
            'feature_image' => $featureImage,
            'gallery_images' => json_encode($galleryImages), // store as json
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

        $galleryImages = json_decode($gallery->gallery_images, true);


        if ($request->delete_images) {

            foreach ($request->delete_images as $img) {

                Storage::disk('public')->delete($img);

                $galleryImages = array_diff($galleryImages, [$img]);
            }
        }


        if ($request->hasFile('gallery_images')) {

            foreach ($request->file('gallery_images') as $image) {

                $path = $image->store('galleries', 'public');

                $galleryImages[] = $path;
            }
        }


        if ($request->hasFile('feature_image')) {

            Storage::disk('public')->delete($gallery->feature_image);

            $gallery->feature_image = $request->file('feature_image')->store('galleries', 'public');
        }


        $gallery->update([

            'name' => $request->name,
            'gallery_images' => json_encode(array_values($galleryImages))

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
        if ($gallery->feature_image && Storage::disk('public')->exists($gallery->feature_image)) {
            Storage::disk('public')->delete($gallery->feature_image);
        }

        // Delete gallery images
        if ($gallery->gallery_images) {
            $images = json_decode($gallery->gallery_images, true);

            if (is_array($images)) {
                foreach ($images as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
        }

        // Delete record
        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery deleted successfully.');
    }
}
