<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all()->sortByDesc('created_at');
        return view('photo', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $gallery = Gallery::where('slug', $slug)->first();
        $imageFeturedPhoto = Photo::where('gallery_id', $gallery->id)->first();
        $featuredPhoto = json_decode($imageFeturedPhoto->image);
        $photos = Photo::where('gallery_id', $gallery->id)->get();
        return view('photo-detail', compact(['gallery', 'featuredPhoto', 'photos']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
