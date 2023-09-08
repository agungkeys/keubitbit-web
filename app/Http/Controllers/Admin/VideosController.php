<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Video;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideosController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $video_query = Video::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');

        if ($sortColumn && $sortDirection) {
            $video_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $video_query = $video_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%");
            });
        }

        $videos = $video_query->paginate(5);
        return view('admin.videos', compact('videos', 'sortColumn', 'sortDirection', 'searchParam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'iframe_youtube' => 'required',
            'link' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:3000'
        ]);

        if ($request->file('image')) {
            $dataImage = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'videos']);
            $image = $dataImage['dataImage'];
        } else {
            $image = '';
        }

        Video::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'detail' => $request->detail,
            'iframe_youtube' => $request->iframe_youtube,
            'link' => $request->link,
            'image' => $image
        ]);
        return redirect()->back()->with('success', 'Video berhasil disimpan!');
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return response()->json([
            'status' => 200,
            'video' => $video
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'iframe_youtube' => 'required',
            'link' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:3000'
        ]);

        $video = Video::findOrFail($request->video_id);

        if ($request->file('image')) {
            $dataImage = $this->UpdateImageCloudinary([
                'image' => $request->file('image'),
                'folder' => 'videos ',
                'collection' => $video
            ]);
            $image = $dataImage['dataImage'];
        }
        $video->update([
            'name' => $request->name,
            'detail' => $request->detail,
            'image' => $image ?? $video->image,
            'iframe_youtube' => $request->iframe_youtube,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Video berhasil diubah!');
    }

    public function delete(Request $request)
    {
        $video = Video::findOrFail($request->id);
        $key = json_decode($video->image);
        if ($key) {
            Cloudinary::destroy($key->public_id);
        }
        $video->delete();
        return response()->json(['status' => 200]);
    }
}
