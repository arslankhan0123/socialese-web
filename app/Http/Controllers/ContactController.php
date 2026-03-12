<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contacts()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('backend.contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Contact::create([
            'name' => $validated['firstName'] . ' ' . $validated['lastName'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone'] ?? '',
            'msg_subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you soon.'
        ]);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return redirect()->route('contacts.index')->with('error', 'No contacts selected.');
        }
        
        $count = Contact::whereIn('id', $ids)->delete();
        
        return redirect()->route('contacts.index', ['deleted' => 'success', 'count' => $count])->with('success', $count . ' contact(s) deleted successfully.');
    }
}
