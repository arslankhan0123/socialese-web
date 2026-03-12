<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function services()
    {
        return view('frontend.services.index');
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
