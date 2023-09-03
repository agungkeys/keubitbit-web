<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Traits\CloudinaryImage;
use App\Models\Milestone;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class MilestonesController extends Controller
{
    use CloudinaryImage;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $milestone_query = Milestone::query();
        // $sortColumn = $request->query('sortColumn');
        // $sortDirection = $request->query('sortDirection');
        // $searchParam = $request->query('q');

        // if ($sortColumn && $sortDirection) {
        //     $milestone_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        // }

        // if ($searchParam) {
        //     $milestone_query = $milestone_query->where(function ($query) use ($searchParam) {
        //         $query
        //             ->orWhere('name', 'like', "%$searchParam%");
        //     });
        // }

        // $milestones = $milestone_query->paginate(5);
        // return view('admin.milestones', compact('milestones', 'sortColumn', 'sortDirection', 'searchParam'));
        return view('admin.milestones');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
