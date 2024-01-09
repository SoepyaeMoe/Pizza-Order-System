<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    // contact
    public function contactInex()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.contact.contact', compact('contacts'));
    }

    public function detail($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.detail', compact('contact'));
    }
}
