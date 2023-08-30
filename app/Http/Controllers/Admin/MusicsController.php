<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CloudinaryImage;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class MusicsController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        // $banner_query = Banner::query();
        // $sortColumn = $request->query('sortColumn');
        // $sortDirection = $request->query('sortDirection');
        // $searchParam = $request->query('q');

        // if ($sortColumn && $sortDirection) {
        //     $banner_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        // }

        // if ($searchParam) {
        //     $banner_query = $banner_query->where(function ($query) use ($searchParam) {
        //         $query
        //             ->orWhere('name', 'like', "%$searchParam%")
        //             ->orWhere('link', 'like', "%$searchParam%");
        //     });
        // }

        // $banners = $banner_query->paginate(5);
        // return view('admin.musics', compact('banners', 'sortColumn', 'sortDirection', 'searchParam'));
        return view('admin.musics');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:3000',
            'link' => 'required'
        ]);

        if ($request->file('image')) {
            $dataImage = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'banners']);
            $image = $dataImage['dataImage'];
        } else {
            $image = '';
        };

        Banner::create([
            'name' => $request->name,
            'image' => $image,
            'link' => $request->link
        ]);

        return redirect()->back()->with('success', 'Banner berhasil disimpan!');
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return response()->json([
            'status' => 200,
            'banner' => $banner
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:3000',
            'link' => 'required'
        ]);

        $banner = Banner::findOrFail($request->banner_id);

        if ($request->file('image')) {
            $dataImage = $this->UpdateImageCloudinary([
                'image' => $request->file('image'),
                'folder' => 'banners',
                'collection' => $banner
            ]);
            $image = $dataImage['dataImage'];
        }
        $banner->update([
            'name' => $request->name,
            'image' => $image ?? $banner->image,
            'link' => $request->link
        ]);

        return redirect()->back()->with('success', 'Banner berhasil diubah!');
    }

    public function delete(Request $request)
    {
        $banner = Banner::findOrFail($request->id);
        $key = json_decode($banner->image);
        Cloudinary::destroy($key->public_id);

        $banner->delete();
        return response()->json(['status' => 200]);
    }
}
