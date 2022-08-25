<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\Category as TraitsCategory;
use App\Http\Traits\FormatMeta;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use TraitsCategory, FormatMeta;

    public function get_categories(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $categories = Category::paginate($perPage);
        if ($categories->count() == 0) {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        } else {
            return response()->json([
                'status' => 'success',
                'meta'   => $this->metaListCategories([
                    'page'    => $request->page == null ? null : $request->page,
                    'perPage' => $perPage,
                    'total'   => $categories->total()
                ]),
                'data'   => $this->result_category_list($categories)
            ]);
        }
    }
}
