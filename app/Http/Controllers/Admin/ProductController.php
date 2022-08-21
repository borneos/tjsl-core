<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $products = Product::sortable()
                ->where('products.sku', 'like', '%' . $filter . '%')
                ->orWhere('products.name', 'like', '%' . $filter . '%')
                ->orWhere('products.merchant_name', 'like', '%' . $filter . '%')
                ->orWhere('products.tags', 'like', '%' . $filter . '%')
                ->orWhere('products.price', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $products = Product::sortable()->paginate(10);
        }
        return view('admin.product.index', compact('products', 'filter'));
    }
    public function product_status(Request $request)
    {
        $product = Product::withoutGlobalScopes()->find($request->id);
        $product->status = $request->status;
        $product->save();
        Alert::toast('Status Updated', 'success');
        return redirect()->route('admin.product.index');
    }
}
