<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Store;
use Cloudinary\Configuration\CloudConfigTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoresController extends Controller
{
    use CloudinaryImage;
    public function index(Request $request)
    {
        $store_query = Store::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');

        if ($sortColumn && $sortDirection) {
            $store_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $store_query = $store_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%")
                    ->orWhere('detail', 'like', "%$searchParam%");
            });
        }

        $stores = $store_query->paginate(5);
        return view('admin.stores', compact('stores', 'sortColumn', 'sortDirection', 'searchParam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:3000'
        ]);

        if ($request->file('image')) {
            $dataImage = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'stores']);
            $image = $dataImage['dataImage'];
        } else {
            $image = '';
        }

        Store::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'detail' => $request->detail,
            'image' => $image,
            'price' => $request->price,
            'link' => $request->link
        ]);

        return redirect()->back()->with('success', 'Store berhasil disimpan!');
    }

    public function edit($id)
    {
        $store = Store::find($id);
        return response()->json([
            'status' => 200,
            'store' => $store
        ]);
    }
}
