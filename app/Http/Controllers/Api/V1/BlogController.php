<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{TraitsBlog, FormatMeta};
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use TraitsBlog, FormatMeta;

    public function get_blog_list(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $request_q = $request->q ?? null; // for title blog
        $slug_category = $request->category ?? null; // for slug category-blog
        $sort = $request->sort ?? 'desc';

        $blogs = $this->QueryBloglist(compact('perPage', 'request_q', 'slug_category', 'sort'));

        if ($blogs->count() == 0) {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        } else {
            $meta = $this->metaBlogList([
                'page'    => $request->page == null ? null : $request->page,
                'perPage' => $perPage,
                'total'   => $blogs->total()
            ]);
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->resultBlogList($blogs)]);
        }
    }
    public function get_blog_detail(Request $request)
    {
        $perPage = $request->perPage ?? 1;
        if (Blog::where([['slug', '=', $request->slug], ['status', '=', 1]])->exists()) {
            $blog = Blog::where([['slug', '=', $request->slug], ['status', '=', 1]])->paginate($perPage);
            $meta = $this->metaBlogList([
                'page'    => $request->page == null ? null : $request->page,
                'perPage' => $perPage,
                'total'   => $blog->total()
            ]);
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->resultBlogList($blog)]);
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        }
    }
}
