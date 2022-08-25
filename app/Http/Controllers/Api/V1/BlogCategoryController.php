<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{Category, FormatMeta};
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    use Category, FormatMeta;

    public function get_blog_categories(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $blog_categories = BlogCategory::paginate($perPage);
        if ($blog_categories->count() == 0) {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        } else {
            return response()->json([
                'status' => 'success',
                'meta'   => $this->metaListCategories([
                    'page'    => $request->page == null ? null : $request->page,
                    'perPage' => $perPage,
                    'total'   => $blog_categories->total()
                ]),
                'data'   => $this->result_category_list($blog_categories)
            ]);
        }
    }
}
