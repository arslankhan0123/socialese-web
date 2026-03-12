<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function services()
    {
        return view('frontend.services.index');
    }

    public function galleries()
    {
        $galleries = Gallery::latest()->get();
        return view('frontend.galleries.index', compact('galleries'));
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        $images = json_decode($gallery->gallery_images);

        return view('frontend.galleries.show', compact('gallery', 'images'));
    }

    public function inquiry()
    {
        return view('frontend.inquiry.index');
    }

    public function about()
    {
        return view('frontend.about.index');
    }

    public function contact()
    {
        return view('frontend.contact.index');
    }
}
