<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Traits\CloudinaryImage;
use App\Models\Music;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class MusicsController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $music_query = Music::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');

        if ($sortColumn && $sortDirection) {
            $music_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $music_query = $music_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%");
            });
        }

        $musics = $music_query->paginate(5);
        return view('admin.musics', compact('musics', 'sortColumn', 'sortDirection', 'searchParam'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'iframe' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:3000',
        ]);

        if ($request->file('image')) {
            $dataImage = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'musics']);
            $image = $dataImage['dataImage'];
        } else {
            $image = '';
        };

        Music::create([
            'name' => $request->name, 
            'slug' => Str::slug(request('name')) . "-" . Str::random(5),
            'detail' => $request->detail, 
            'date_release' => $request->date,
            'image' => $image, 
            'iframe' => $request->iframe,
            'link_spotify' => $request->spotify,
            'link_youtube' => $request->youtube,
            'link_apple' => $request->apple,
            'is_featured' => $request->featured ? 1 : 0
        ]);

        return redirect()->back()->with('success', 'Music berhasil disimpan!');
    }

    public function edit($id)
    {
        $music = Music::find($id);
        return response()->json([
            'status' => 200,
            'music' => $music
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_date' => 'required',
            'edit_iframe' => 'required',
            'edit_image' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
        ]);

        $music = Music::findOrFail($request->music_id);

        if ($request->file('edit_image')) {
            $dataImage = $this->UpdateImageCloudinary([
                'image' => $request->file('edit_image'),
                'folder' => 'musics',
                'collection' => $music
            ]);
            $image = $dataImage['dataImage'];
        }

        $music->update([
            'name' => $request->edit_name, 
            'detail' => $request->edit_detail, 
            'date_release' => $request->edit_date,
            'image' => $image ?? $music->image,
            'iframe' => $request->edit_iframe,
            'link_spotify' => $request->edit_spotify,
            'link_youtube' => $request->edit_youtube,
            'link_apple' => $request->edit_apple,
            'is_featured' => $request->edit_featured ? 1 : 0
        ]);

        return redirect()->back()->with('success', 'Music berhasil diubah!');
    }

    public function delete(Request $request)
    {
        $banner = Music::findOrFail($request->id);
        $key = json_decode($banner->image);
        Cloudinary::destroy($key->public_id);

        $banner->delete();
        return response()->json(['status' => 200]);
    }
}
