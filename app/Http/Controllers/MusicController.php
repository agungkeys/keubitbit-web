<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
  public function index(Request $request)
  {
    $musics = Music::all()->sortByDesc('id');
    return view('music', compact('musics'));
  }
}
