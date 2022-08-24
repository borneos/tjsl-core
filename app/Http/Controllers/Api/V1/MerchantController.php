<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{TraitsMerchant, FormatMeta};
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    use TraitsMerchant, FormatMeta;

    public function get_merchants(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $request_q = $request->q ?? null; // merchant name
        $slug_category = $request->category ?? null; // slug category
        $sort = $request->sort ?? 'desc';
        $merchant = $this->QueryMerchantlist(compact('perPage', 'request_q', 'slug_category', 'sort'));

        if ($merchant->count() == 0) {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        } else {
            $meta = $this->metaMerchantList([
                'page'    => $request->page == null ? null : $request->page,
                'perPage' => $perPage,
                'total'   => $merchant->total()
            ]);
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->resultMerchantList($merchant)]);
        }
    }
}
