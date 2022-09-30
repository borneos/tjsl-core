<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $banners = Banner::sortable()
                ->where('banners.title', 'like', '%' . $filter . '%')
                ->orWhere('banners.url', 'like', '%' . $filter . '%')
                ->latest()
                ->paginate(10);
        } else {
            $banners = Banner::sortable()->latest()->paginate(10);
        }
        return view('admin.banner.index', compact('banners', 'filter'));
    }
}
