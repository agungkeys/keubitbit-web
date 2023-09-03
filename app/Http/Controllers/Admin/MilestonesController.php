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
    public function index(Request $request)
    {
        $milestone_query = Milestone::query();
        $sortColumn = $request->query('sortColumn');
        $sortDirection = $request->query('sortDirection');
        $searchParam = $request->query('q');

        if ($sortColumn && $sortDirection) {
            $milestone_query->orderBy($sortColumn, $sortDirection ?: 'asc');
        }

        if ($searchParam) {
            $milestone_query = $milestone_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%");
            });
        }

        $milestones = $milestone_query->paginate(5);
        return view('admin.milestones', compact('milestones', 'sortColumn', 'sortDirection', 'searchParam'));
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
        $request->validate([
            'name' => 'required',
            'year' => 'required'
        ]);

        Milestone::create([
            'name' => $request->name, 
            'year' => $request->year, 
            'detail' => $request->detail
        ]);

        return redirect()->back()->with('success', 'Milestone berhasil disimpan!');
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
        $milestone = Milestone::find($id);
        return response()->json([
            'status' => 200,
            'milestone' => $milestone
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_year' => 'required'
        ]);

        $milestone = Milestone::findOrFail($request->milestone_id);

        $milestone->update([
            'name' => $request->edit_name, 
            'year' => $request->edit_year, 
            'detail' => $request->edit_detail
        ]);

        return redirect()->back()->with('success', 'Milestone berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $milestone = Milestone::findOrFail($request->id);
        $milestone->delete();
        return response()->json(['status' => 200]);
    }
}
