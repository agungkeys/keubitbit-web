<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return view('contact');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->back()->with('contact', 'success');
    }
}
