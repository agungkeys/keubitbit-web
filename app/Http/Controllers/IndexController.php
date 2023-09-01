<?php

namespace App\Http\Controllers;

use App\Models\Mailist;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'email|required|unique:mailists'
        ]);

        $mailist = new Mailist();
        $mailist->email = $request->email;
        $mailist->save();

        return redirect()->back()->with('subs', 'success');
    }
}
