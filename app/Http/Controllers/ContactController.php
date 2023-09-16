<?php

namespace App\Http\Controllers;
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
            'email' => 'email|required|unique:mailists',
            'message' => 'required',
        ]);

        // $mailist = new Mailist();
        // $mailist->email = $request->email;
        // $mailist->save();

        // return redirect()->back()->with('subs', 'success');
    }
}
