<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleriesController extends Controller
{
    use CloudinaryImage;
    public function index(Request $request)
    {
        $gallery_query = Gallery::query();
        $searchParam = $request->query('q');

        if ($searchParam) {
            $gallery_query = $gallery_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%");
            });
        }

        $galleries = $gallery_query->get();
        return view('admin.galleries', compact('galleries', 'searchParam'));
    }

    public function edit(string $id)
    {
        $gallery = Gallery::find($id);
        return response()->json([
            'status' => 200,
            'gallery' => $gallery
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Gallery::create([
            'name' => $request->name,
            'slug' => Str::slug(request('name')) . "-" . Str::random(5),
            'detail' => $request->detail,
        ]);

        return redirect()->back()->with('success', 'Galeri berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        $gallery = Gallery::findOrFail($request->gallery_id);

        $gallery->update([
            'name' => $request->name,
            'detail' => $request->detail
        ]);

        return redirect()->back()->with('success', 'Galeri berhasil diubah!');
    }

    public function delete(Request $request)
    {
        $gallery = Gallery::findOrFail($request->id);
        $gallery->delete();
        return response()->json(['status' => 200]);
    }

    public function photo(string $id)
    {
        $gallery = Gallery::with('photo')->find($id);
        return response()->json([
            'status' => 200,
            'gallery' => $gallery
        ]);
    }

    public function photoStore(Request $request)
    {
        $request->validate([
            'image1' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
            'image2' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
            'image3' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
            'image4' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
            'image5' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
            'image6' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
            'image7' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
            'image8' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
        ]);


        for ($i = 1; $i <= 8; $i++) {
            if ($request->file('image' . $i)) {
                $dataImage1 = $this->UploadImageCloudinary(['image' => $request->file('image' . $i), 'folder' => 'galleries']);
                // $image1 =
                $photoArray[] = $dataImage1['dataImage'];
            }
        }

        foreach ($photoArray as $photo) {
            Photo::create([
                'gallery_id' => $request->gallery_id,
                'image' => $photo
            ]);
        }

        return redirect()->back()->with('success', 'Foto berhasil disimpan!');
    }
}
