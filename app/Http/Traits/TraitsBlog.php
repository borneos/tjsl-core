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
                    ->orWhereHas('category', function ($q) use ($filter) {
                        return $q->where('name', '=', $filter);
                    })
                    ->paginate(10);
                return compact('blogs', 'filter', 'status');
            } else {
                $blogs = Blog::sortable()
                    ->where([['blog.title', 'like', '%' . $filter . '%'], ['status', '=', $status]])
                    ->orWhere([['blog.slug', 'like', '%' . $filter . '%'], ['status', '=', $status]])
                    ->orWhereHas('category', function ($q) use ($filter) {
                        return $q->where('name', '=', $filter);
                    })
                    ->where('status',$status)
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
    public function QueryBloglist($data)
    {
        $request_q = $data['request_q']; // for title blog
        $slug_category = $data['slug_category']; // for slug blog-category

        if ($request_q && $slug_category) {
            return Blog::whereHas('category', function ($q) use ($slug_category) {
                return $q->where('slug', '=', $slug_category);
            })
                ->where([['title', '=', $request_q], ['status', '=', 1]])
                ->orderBy('id', $data['sort'])
                ->paginate($data['perPage']);
        } elseif ($request_q) {
            return Blog::where([['title', '=', $request_q],['status','=',1]])->orderBy('id', $data['sort'])->paginate($data['perPage']);
        } elseif ($slug_category) {
            return Blog::whereHas('category', function ($q) use ($slug_category) {
                return $q->where('slug', '=', $slug_category);
            })
                ->where('status', '=', 1)
                ->orderBy('id', $data['sort'])
                ->paginate($data['perPage']);
        } else {
            return Blog::where('status', '=', 1)->orderBy('id', $data['sort'])->paginate($data['perPage']);
        }
    }
    public function resultBlogList($data)
    {
        foreach ($data as $result) {
            $results[] = [
                'id' => $result->id,
                'title' => $result->title,
                'slug' => $result->slug,
                'shortDescription' => $result->short_description ?? null,
                'description' => $result->description ?? null,
                'category' => [
                    'id' => $result->category_id ? $result->category_id : null,
                    'name' => $result->category_id && $result->category->name ? $result->category->name : null,
                    'slug' => $result->category_id && $result->category->slug ? $result->category->slug : null,
                    'image' => $result->category_id && $result->category->image ? $result->category->image : null,
                    'additionalImage' => $result->category_id && $result->category->additional_image ? json_decode($result->category->additional_image) : null,
                ],
                'image' => $result->image ? $result->image : null,
                'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
                'author' => $result->author ?? null,
                'tags' => $result->tags ?? null,
                'status' => $result->status,
                'dateCreate' => $result->created_at->format('d/m/Y'),
                'dateUpdate' => $result->updated_at->format('d/m/Y')
            ];
        };
        return $results;
    }
    public function resultListBlogDetail($data)
    {
        $result = $data[0];
        return [
            'id' => $result->id,
            'title' => $result->title,
            'slug' => $result->slug,
            'shortDescription' => $result->short_description ?? null,
            'description' => $result->description ?? null,
            'category' => [
                'id' => $result->category_id ? $result->category_id : null,
                'name' => $result->category_id && $result->category->name ? $result->category->name : null,
                'slug' => $result->category_id && $result->category->slug ? $result->category->slug : null,
                'image' => $result->category_id && $result->category->image ? $result->category->image : null,
                'additionalImage' => $result->category_id && $result->category->additional_image ? json_decode($result->category->additional_image) : null,
            ],
            'image' => $result->image ? $result->image : null,
            'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
            'author' => $result->author ?? null,
            'tags' => $result->tags ?? null,
            'status' => $result->status,
            'dateCreate' => $result->created_at->format('d/m/Y'),
            'dateUpdate' => $result->updated_at->format('d/m/Y')
        ];
    }
}
