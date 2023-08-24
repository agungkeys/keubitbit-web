<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Member;

class AboutController extends Controller
{
  public function index(Request $request)
  {
    $members = Member::all();
    return view('about', compact('members'));
  }
}
