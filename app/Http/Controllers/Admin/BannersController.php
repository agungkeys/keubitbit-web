<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function index()
    {
        // $filter = $request->query('filter');
        // if (!empty($filter)) {
        // }
        $banners = Banner::all();
        return view('admin.banners', compact('banners'));
    }
}
