<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Music;
use App\Models\Mailist;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::all();
        $musicFeatured = Music::where('is_featured', 1)->first();
        return view('index', compact(['banners', 'musicFeatured']));
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
