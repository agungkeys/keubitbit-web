<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $banner_query = Banner::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');

        if ($sortColumn && $sortDirection) {
            $banner_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $banner_query = $banner_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%")
                    ->orWhere('link', 'like', "%$searchParam%");
            });
        }

        $banners = $banner_query->paginate(5);
        return view('admin.banners', compact('banners', 'sortColumn', 'sortDirection', 'searchParam'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:8192',
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

        return redirect(route('admin.banners'))->with('success', 'Banner berhasil disimpan!');
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return response()->json([
            'status' => 200,
            'banner' => $banner
        ]);
    }
}
