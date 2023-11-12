<?php

namespace App\Http\Controllers;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
  public function index(Request $request)
  {
    $tours = Tour::all()->where('is_active', 1)->sortByDesc('created_at');
    return view('tour', compact('tours'));
  }
}
