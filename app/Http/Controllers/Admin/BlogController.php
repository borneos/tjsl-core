<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $blogs = Blog::sortable()
                ->where('blog.title', 'like', '%' . $filter . '%')
                ->orWhere('blog.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $blogs = Blog::sortable()->paginate(10);
        }
        return view('admin.blog.index', compact('blogs', 'filter'));
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
