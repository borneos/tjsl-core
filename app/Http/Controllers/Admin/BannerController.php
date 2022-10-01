<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Banner;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    use CloudinaryImage;
     
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
    public function add()
    {
        return view('admin.banner.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url'   => 'nullable|sometimes',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'tjsl-core/banners']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }else{
            $image_url = '';
            $additional_image = '';
        }
        Banner::create([
            'title' => $request->title,
            'url'   => $request->url ?? '',
            'image' => $image_url,
            'additional_image' => $additional_image
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.banner.index');
    }
}
