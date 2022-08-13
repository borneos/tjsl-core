<?php

namespace App\Http\Traits;

use App\Models\Blog;

trait TraitsBlog
{
    public function SearchBloglist($data)
    {
        $filter = $data['filter'];
        $status = $data['status'];
        if (!empty($filter)) {
            if ($status == null) {
                $blogs = Blog::sortable()
                    ->where('blog.title', 'like', '%' . $filter . '%')
                    ->orWhere('blog.slug', 'like', '%' . $filter . '%')
                    ->paginate(10);
                return compact('blogs', 'filter', 'status');
            } else {
                $blogs = Blog::sortable()
                    ->where([['blog.title', 'like', '%' . $filter . '%'], ['status', '=', $status]])
                    ->orWhere([['blog.slug', 'like', '%' . $filter . '%'], ['status', '=', $status]])
                    ->paginate(10);
                return compact('blogs', 'filter', 'status');
            }
        } else {
            if ($status == null) {
                $blogs = Blog::sortable()->paginate(10);
                return compact('blogs', 'filter', 'status');
            } else {
                $blogs = Blog::sortable()->where('status', '=', $status)->paginate(10);
                return compact('blogs', 'filter', 'status');
            }
        }
    }
}
