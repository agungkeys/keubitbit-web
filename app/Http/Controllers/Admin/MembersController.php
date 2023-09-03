<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Traits\CloudinaryImage;
use App\Models\Member;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    use CloudinaryImage;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $member_query = Member::query();
        $searchParam = $request->query('q');

        if ($searchParam) {
            $member_query = $member_query->where(function ($query) use ($searchParam) {
                $query
                    ->orWhere('name', 'like', "%$searchParam%")
                    ->orWhere('position', 'like', "%$searchParam%");
            });
        }

        $members = $member_query->get();
        return view('admin.members', compact('members', 'searchParam'));
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
            'position' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:3000',
        ]);

        if ($request->file('image')) {
            $dataImage = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'members']);
            $image = $dataImage['dataImage'];
        } else {
            $image = '';
        };

        Member::create([
            'name' => $request->name,
            'slug' => Str::slug(request('name')) . "-" . Str::random(5),
            'position' => $request->position,
            'detail' => $request->detail,
            'social_facebook' => $request->facebook,
            'social_instagram' => $request->instagram,
            'social_twitter' => $request->twitter,
            'social_tiktok' => $request->tiktok,
            'social_youtube' => $request->youtube,
            'image' => $image,
        ]);

        return redirect()->back()->with('success', 'Banner berhasil disimpan!');
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
        $member = Member::find($id);
        return response()->json([
            'status' => 200,
            'member' => $member
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_position' => 'required',
            'edit_detail' => 'required'
        ]);

        $member = Member::findOrFail($request->member_id);

        if ($request->file('edit_image')) {
            $dataImage = $this->UpdateImageCloudinary([
                'image' => $request->file('edit_image'),
                'folder' => 'members',
                'collection' => $member
            ]);
            $image = $dataImage['dataImage'];
        }
        $member->update([
            'name' => $request->edit_name,
            'position' => $request->edit_position,
            'detail' => $request->edit_detail,
            'social_facebook' => $request->edit_facebook,
            'social_instagram' => $request->edit_instagram,
            'social_twitter' => $request->edit_twitter,
            'social_tiktok' => $request->edit_tiktok,
            'social_youtube' => $request->edit_youtube,
            'image' => $image ?? $member->image
        ]);

        return redirect()->back()->with('success', 'Member berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $member = Member::findOrFail($request->id);
        $key = json_decode($member->image);
        Cloudinary::destroy($key->public_id);

        $member->delete();
        return response()->json(['status' => 200]);
    }
}
