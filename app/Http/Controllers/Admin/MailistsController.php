<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mailist;
use Illuminate\Http\Request;

class MailistsController extends Controller
{
    public function index(Request $request)
    {
        $mailist_query = Mailist::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');

        if ($sortColumn && $sortDirection) {
            $mailist_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $mailist_query = $mailist_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%")
                    ->orWhere('email', 'like', "%$searchParam%");
            });
        }
        $mailists = $mailist_query->paginate(5);

        return view('admin.mailists', compact('mailists', 'sortColumn', 'sortDirection', 'searchParam'));
    }
}
