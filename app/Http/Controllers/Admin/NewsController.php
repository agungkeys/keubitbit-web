<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news_query = News::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');
        $user =

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
        return view('admin.news', compact('news', 'sortColumn', 'sortDirection', 'searchParam'));
    }
}
