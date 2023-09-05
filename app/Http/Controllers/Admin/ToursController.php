<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Traits\CloudinaryImage;
use App\Models\Tour;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class ToursController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $tour_query = Tour::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');

        if ($sortColumn && $sortDirection) {
            $tour_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $tour_query = $tour_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%");
            });
        }

        $tours = $tour_query->paginate(5);
        return view('admin.tours', compact('tours', 'sortColumn', 'sortDirection', 'searchParam'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'location' => 'required',
        ]);

        if ($request->file('image')) {
            $dataImage = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'tours']);
            $image = $dataImage['dataImage'];
        } else {
            $image = '';
        };

        Tour::create([
            'name' => $request->name, 
            'slug' => Str::slug(request('name')) . "-" . Str::random(5),
            'detail' => $request->detail, 
            'date_gigs' => $request->date,
            'image' => $image, 
            'location' => $request->location,
            'link' => $request->link,
            'is_active' => $request->is_active ? 1 : 0
        ]);

        return redirect()->back()->with('success', 'Tour Schedule berhasil disimpan!');
    }

    public function edit($id)
    {
        $tour = Tour::find($id);
        return response()->json([
            'status' => 200,
            'tour' => $tour
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_date' => 'required',
            'edit_location' => 'required'
        ]);

        $tour = Tour::findOrFail($request->tour_id);

        if ($request->file('edit_image')) {
            $dataImage = $this->UpdateImageCloudinary([
                'image' => $request->file('edit_image'),
                'folder' => 'tours',
                'collection' => $tour
            ]);
            $image = $dataImage['dataImage'];
        }

        $tour->update([
            'name' => $request->edit_name, 
            'detail' => $request->edit_detail, 
            'date_gigs' => $request->edit_date,
            'image' => $image ?? null, 
            'location' => $request->edit_location,
            'link' => $request->edit_link,
            'is_active' => $request->edit_is_active ? 1 : 0
        ]);

        return redirect()->back()->with('success', 'Tour Schedule berhasil diubah!');
    }

    public function delete(Request $request)
    {
        $tour = Tour::findOrFail($request->id);
        $key = json_decode($tour->image);
        if($key){
            Cloudinary::destroy($key->public_id);
        }
        $tour->delete();
        return response()->json(['status' => 200]);
    }
}
