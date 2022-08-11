<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BLogCategory;
use Illuminate\Http\Request;

class BLogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $categories = BLogCategory::sortable()
                ->where('blog-categories.name', 'like', '%' . $filter . '%')
                ->orWhere('blog-categories.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $categories = BLogCategory::sortable()->paginate(10);
        }
        return view('admin.blog-category.index', compact('categories', 'filter'));
    }
}
