<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $categories = Category::sortable()
                ->where('categories.name', 'like', '%' . $filter . '%')
                ->orWhere('categories.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $categories = Category::sortable()->paginate(10);
        }
        return view('admin.category.index', compact('categories', 'filter'));
    }
}
