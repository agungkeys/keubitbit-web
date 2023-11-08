<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Music;

class AboutController extends Controller
{
  public function index(Request $request)
  {
    $members = Member::all();
    $musics = Music::all()->sortByDesc('id');
    return view('about', compact('members', 'musics'));
  }
}
