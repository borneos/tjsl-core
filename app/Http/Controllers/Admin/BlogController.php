<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\{CloudinaryImage, TraitsBlog};
use App\Models\{Blog, BlogCategory};
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    use TraitsBlog, CloudinaryImage;

    public function index(Request $request)
    {
        $search = $this->SearchBloglist([
            'filter' => $request->query('filter'),
            'status' => $request->query('status')
        ]);
        return view('admin.blog.index', [
            'blogs'  => $search['blogs'],
            'filter' => $search['filter'],
            'status' => $search['status'] == null ? 404 : $search['status']
        ]);
    }
    public function blog_status(Request $request)
    {
        $blog = Blog::withoutGlobalScopes()->find($request->id);
        $blog->status = $request->status;
        $blog->save();
        Alert::toast('Status Updated', 'success');
        return redirect()->route('admin.blog.index');
    }
    public function add()
    {
        return view('admin.blog.add', [
            'categories' => BlogCategory::all()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'slug'     => 'required',
            'category' => 'required',
            'image'    => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'tjsl-core/blogs']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }
        Blog::create([
            'title'       => $request->title,
            'slug'        => $request->slug,
            'category_id' => $request->category,
            'author'      => $request->author ?? '',
            'tags'        => $request->tags ?? '',
            'status'      => 1,
            'image'       => $image_url ?? '',
            'additional_image'  => $additional_image ?? '',
            'short_description' => $request->short_description ?? '',
            'description'       => $request->description ?? ''
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.blog.index');
    }
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', [
            'blog'       => $blog,
            'categories' => BlogCategory::all()
        ]);
    }
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'    => 'required',
            'slug'     => 'required',
            'category' => 'required',
            'image'    => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'tjsl-core/blogs',
                'collection' => $blog
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }
        $blog->update([
            'title'       => $request->title,
            'slug'        => $request->slug,
            'category_id' => $request->category,
            'author'      => $request->author ?? '',
            'tags'        => $request->tags ?? '',
            'image'       => $image_url ?? $blog->image,
            'additional_image'  => $additional_image ?? $blog->additional_image,
            'short_description' => $request->short_description ?? '',
            'description'       => $request->description ?? ''
        ]);
        Alert::success('Success', 'Data Updated Successfully');
        return redirect()->route('admin.blog.index');
    }
}
