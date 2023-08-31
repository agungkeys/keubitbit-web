<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    use CloudinaryImage;
    public function index(Request $request)
    {
        $news_query = News::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');
        $user = User::all();

        if ($sortColumn && $sortDirection) {
            $news_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $news_query = $news_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%")
                    ->orWhere('detail', 'like', "%$searchParam%");
            });
        }

        $news = $news_query->paginate(5);
        return view('admin.news', compact('news', 'sortColumn', 'sortDirection', 'searchParam', 'user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:3000'
        ]);

        if ($request->file('image')) {
            $dataImage = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'news']);
            $image = $dataImage['dataImage'];
        } else {
            $image = '';
        };

        News::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'detail' => $request->detail,
            'image' => $image,
            'reference' => $request->reference,
            'is_active' => 1,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Berita berhasil disimpan!');
    }

    public function changeActive(Request $request)
    {
        $news = News::findOrFail($request->news_id);
        $news->is_active = $request->is_active;
        $news->save();

        return response()->json(['status' => 200]);
    }
}
