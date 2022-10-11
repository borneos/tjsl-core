<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\{TraitsMerchant,TraitsProduct, FormatMeta};
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    use TraitsMerchant,TraitsProduct, FormatMeta;

    public function get_merchants(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        $request_q = $request->q ?? null; // merchant name
        $slug_category = $request->category ?? null; // slug category
        $isFavorite = $request->isFavorite ?? 'all'; //favorite
        $sort = $request->sort ?? 'desc';
        $merchant = $this->QueryMerchantlist(compact('perPage', 'request_q', 'slug_category','isFavorite', 'sort'));

        if ($merchant->count() == 0) {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        } else {
            $meta = $this->metaMerchantList([
                'page'    => $request->page == null ? null : $request->page,
                'perPage' => $perPage,
                'total'   => $merchant->total()
            ]);
            return response()->json(['status' => 'success','meta'=> $meta,'data' => $this->merchantListWithProductFavorite(compact('merchant','isFavorite'))]);
        }
    }
    public function get_merchant_detail(Request $request)
    {
        $perPage = $request->perPage ?? 1;
        if (Merchant::where('slug', '=', $request->slug)->exists()) {
            $merchant = Merchant::where('slug', '=', $request->slug)->paginate($perPage);
            $meta = $this->metaMerchantList([
                'page'    => $request->page == null ? null : $request->page,
                'perPage' => $perPage,
                'total'   => $merchant->total()
            ]);
            return response()->json(['status' => 'success', 'meta' => $meta, 'data' => $this->resultListMerchantDetail($merchant)]);
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null]);
        }
    }
}
