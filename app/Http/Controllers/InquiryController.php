<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        return view('backend.inquiries.index', compact('inquiries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'budget' => ['nullable', 'string', 'max:255'],
            'timeline' => ['nullable', 'string', 'max:255'],
            'projectDescription' => ['required', 'string'],
            'additionalInfo' => ['nullable', 'string'],
        ]);

        Inquiry::create([
            'name' => $validated['firstName'] . ' ' . $validated['lastName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? null,
            'website' => $validated['website'] ?? null,
            'budget' => $validated['budget'] ?? null,
            'timeline' => $validated['timeline'] ?? null,
            'project_description' => $validated['projectDescription'],
            'additional_info' => $validated['additionalInfo'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your inquiry! We will get back to you within 24 hours.'
        ]);
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();
        
        return redirect()->route('inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
