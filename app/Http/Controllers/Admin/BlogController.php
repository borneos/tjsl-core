<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\TraitsBlog;
use App\Models\Blog;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    use TraitsBlog;

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
}
