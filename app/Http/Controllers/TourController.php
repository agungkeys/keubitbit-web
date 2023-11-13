<?php

namespace App\Http\Controllers;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
  public function index(Request $request)
  {
    if($request->filter === 'upcoming'){
      $tours = Tour::whereDate('date_gigs', '>', today())->get()->sortByDesc('created_at');
    } else if($request->filter === 'past'){
      $tours = Tour::whereDate('date_gigs', '<', today())->get()->sortByDesc('created_at');
    }else {
      $tours = Tour::all()->where('is_active', 1)->sortByDesc('created_at');
    }

    return view('tour', compact('tours'));
  }
}
