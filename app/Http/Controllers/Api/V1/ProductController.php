<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{TraitsProduct, FormatMeta};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use TraitsProduct, FormatMeta;

    public function get_products(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $request_q = $request->q ?? null; // product name
        $slug_merchant = $request->merchant ?? null; // slug merchant
        $sort = $request->sort ?? 'desc';
        $product = $this->QueryProductlist(compact('perPage', 'request_q', 'slug_merchant', 'sort'));

        if ($product->count() == 0) {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        } else {
            $meta = $this->metaProductList([
                'page'    => $request->page == null ? null : $request->page,
                'perPage' => $perPage,
                'total'   => $product->total()
            ]);
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->resultProductList($product)]);
        }
    }
}
