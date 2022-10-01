<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Banner;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
    public function edit(int $id)
    {
        return view('admin.banner.edit',['banner' => Banner::findOrFail($id)]);
    }
    public function update(Request $request,int $id)
    {
        $request->validate([
            'title' => 'required',
            'url'   => 'nullable|sometimes',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'tjsl-core/banners',
                'collection' => $banner
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        $banner->update([
            'title' => $request->title,
            'url'   => $request->url ?? '',
            'image' => $image_url ?? $banner->image,
            'additional_image' => $additional_image ?? $banner->additional_image
        ]);
        Alert::success('Success', 'Data Updated Successfully');
        return redirect()->route('admin.banner.index');
    }
    public function delete(int $id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->image && $banner->additional_image) {
            $key = json_decode($banner->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        $banner->delete();
        return response()->json(['status' => 200]);
    }
}
