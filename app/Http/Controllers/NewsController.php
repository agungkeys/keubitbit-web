<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  public function index(Request $request)
  {
    $news = News::all()->where('is_active', 1)->sortByDesc('created_at');
    return view('news', compact('news'));
  }
}
