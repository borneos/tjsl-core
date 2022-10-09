<?php

namespace App\Http\Traits;

use App\Models\Merchant;
use App\Models\Product;

trait TraitsMerchant
{
    public function resultMerchantList($data)
    {
        foreach ($data as $result) {
            $results[] = [
                'id' => $result->id,
                'category' => [
                    'id' => $result->id_category ? $result->id_category : null,
                    'name' => $result->id_category && $result->category->name ? $result->category->name : null,
                    'slug' => $result->id_category && $result->category->slug ? $result->category->slug : null
                ],
                'type' => $result->type,
                'image' => $result->image ? $result->image : null,
                'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
                'seoImage' => $result->seo_image ? $result->seo_image : null,
                'additionalImageSeo' => $result->additional_image_seo ? json_decode($result->additional_image_seo) : null,
                'coverImage' => $result->cover_image ? $result->cover_image : null,
                'additionalImageCover' => $result->additional_image_cover ? json_decode($result->additional_image_cover) : null,
                'name' => $result->name,
                'slug' => $result->slug,
                'tagline' => $result->tagline,
                'shortDescription' => $result->short_description,
                'description' => $result->description,
                'biography' => $result->biography,
                'telp' => $result->telp,
                'address' => $result->address,
                'city' => $result->city,
                'district' => $result->district,
                'latitude' => $result->lat,
                'longitude' => $result->long,
                'ownerName' => $result->owner_name,
                'ownerTelp' => $result->owner_telp,
                'ownerEmail' => $result->owner_email,
                'ownerAddress' => $result->owner_address,
                'socFb' => $result->soc_fb,
                'socIg' => $result->soc_ig,
                'socTwitter' => $result->soc_twitter,
                'website' => $result->website,
                'linkBorneos' => $result->link_borneos,
                'linkTokopedia' => $result->link_tokopedia,
                'linkShopee' => $result->link_shopee,
                'linkBukalapak' => $result->link_bukalapak,
                'favorite' => $result->favorite,
                'products' => $resultProduct
            ];
        }
        return $results;
    }

    public function QueryMerchantlist($data)
    {
        $request_q = $data['request_q']; //merchant name
        $slug_category = $data['slug_category']; //slug category
        $isFavorite = $data['isFavorite']; //favorite

        if ($request_q && $slug_category) {
            if($isFavorite){
                return Merchant::whereHas('category', function ($q) use ($slug_category) {
                    return $q->where('slug', '=', $slug_category);
                })
                    ->where([['name', '=', $request_q],['favorite','=',$isFavorite]])
                    ->orderBy('id', $data['sort'])
                    ->paginate($data['perPage']);
            }else{
                return Merchant::whereHas('category', function ($q) use ($slug_category) {
                    return $q->where('slug', '=', $slug_category);
                })
                    ->where('name', '=', $request_q)
                    ->orderBy('id', $data['sort'])
                    ->paginate($data['perPage']);
            }
        } elseif ($request_q) {
            if($isFavorite){
                return Merchant::where([['name', '=', $request_q],['favorite','=',$isFavorite]])->orderBy('id', $data['sort'])->paginate($data['perPage']);
            }else{
                return Merchant::where('name', '=', $request_q)->orderBy('id', $data['sort'])->paginate($data['perPage']);
            }
        } elseif ($slug_category) {
            if($isFavorite){
                return Merchant::whereHas('category', function ($q) use ($slug_category) {
                        return $q->where('slug', '=', $slug_category);
                    })
                    ->where([['favorite','=',$isFavorite]])
                    ->orderBy('id', $data['sort'])
                    ->paginate($data['perPage']);
            }else{
                return Merchant::whereHas('category', function ($q) use ($slug_category) {
                        return $q->where('slug', '=', $slug_category);
                    })
                    ->orderBy('id', $data['sort'])
                    ->paginate($data['perPage']);
            }
        } else {
            if($isFavorite){
                return Merchant::where([['favorite','=',$isFavorite]])->orderBy('id', $data['sort'])->paginate($data['perPage']);
            }else{
                return Merchant::orderBy('id', $data['sort'])->paginate($data['perPage']);
            }
        }
    }
    public function merchantListWithProductFavorite($data)
    {
        $products = Product::where([['favorite','=',$data['isFavorite']],['status','=',1]])->get();
        if($products->count() == 0){
            return null;
        }else{
            foreach($products as $product){
                $resultProduct[] = [
                    'id' => $product->id,
                    'sku' => $product->sku,
                    'merchant' => [
                        'id' => $product->merchant_id,
                        'type' => $product->merchant_id && $product->merchant->type ? $product->merchant->type : '',
                        'name' => $product->merchant_id && $product->merchant->name ? $product->merchant->name : '',
                        'slug' => $product->merchant_id && $product->merchant->slug ? $product->merchant->slug : '',
                        'image' => $product->merchant_id && $product->merchant->image ? $product->merchant->image : null,
                        'additionalImage' => $product->merchant_id && $product->merchant->additional_image ? json_decode($product->merchant->additional_image) : null,
                        'coverImage' => $product->merchant_id && $product->merchant->cover_image ? $product->merchant->cover_image : null,
                        'additionalImageCover' => $product->merchant_id && $product->merchant->additional_image_cover ? json_decode($product->merchant->additional_image_cover) : null,
                        'seoImage' => $product->merchant_id && $product->merchant->seo_image ? $product->merchant->seo_image : null,
                        'additionalImageSeo' => $product->merchant_id && $product->merchant->additional_image_seo ? json_decode($product->merchant->additional_image_seo) : null,
                        'category' => [
                            'id' => $product->merchant_id && $product->merchant->category->id ? $product->merchant->category->id: '',
                            'name' => $product->merchant_id && $product->merchant->category->name ? $product->merchant->category->name: '',
                            'slug' => $product->merchant_id && $product->merchant->category->slug ? $product->merchant->category->slug: '',
                            'description' => $product->merchant_id && $product->merchant->category->description ? $product->merchant->category->description: '',
                            'image' => $product->merchant_id && $product->merchant->category->image ? $product->merchant->category->image : null,
                            'additionalImage' => $product->merchant_id && $product->merchant->category->additional_image ? json_decode($product->merchant->category->additional_image) : null
                        ],
                    ],
                    'tags' => $product->tags ? explode(', ', $product->tags) : null,
                    'name' => $product->name,
                    'slug' => $product->slug ? $product->slug : '',
                    'description' => $product->description ? $product->description :'',
                    'price' => $product->price,
                    'image' => $product->image ? $product->image : null,
                    'additionalImage' => $product->additional_image ? json_decode($product->additional_image): null,
                    'favorite' => $product->favorite,
                    'status' => $product->status
                ];
            }
            foreach ($data['merchant'] as $result) {
                $resultMerchant[] = [
                    'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
                    'additionalImageCover' => $result->additional_image_cover ? json_decode($result->additional_image_cover) : null,
                    'additionalImageSeo' => $result->additional_image_seo ? json_decode($result->additional_image_seo) : null,
                    'address' => $result->address,
                    'biography' => $result->biography,
                    'category' => [
                        'id' => $result->id_category ? $result->id_category : null,
                        'name' => $result->id_category && $result->category->name ? $result->category->name : null,
                        'slug' => $result->id_category && $result->category->slug ? $result->category->slug : null
                    ],
                    'city' => $result->city,
                    'coverImage' => $result->cover_image ? $result->cover_image : null,
                    'description' => $result->description,
                    'district' => $result->district,
                    'favorite' => $result->favorite,
                    'id' => $result->id,
                    'image' => $result->image ? $result->image : null,
                    'latitude' => $result->lat,
                    'linkBorneos' => $result->link_borneos ? $result->link_borneos : '-',
                    'linkBukalapak' => $result->link_bukalapak ? $result->link_bukalapak : '-',
                    'linkShopee' => $result->link_shopee ? $result->link_shopee : '-',
                    'linkTokopedia' => $result->link_tokopedia ? $result->link_tokopedia : '-',
                    'longitude' => $result->long,
                    'name' => $result->name,
                    'ownerAddress' => $result->owner_address,
                    'ownerEmail' => $result->owner_email,
                    'ownerName' => $result->owner_name,
                    'ownerTelp' => $result->owner_telp,
                    'seoImage' => $result->seo_image ? $result->seo_image : null,
                    'shortDescription' => $result->short_description,
                    'slug' => $result->slug,
                    'socFb' => $result->soc_fb ? $result->soc_fb : '-',
                    'socIg' => $result->soc_ig ? $result->soc_ig :'-',
                    'socTwitter' => $result->soc_twitter ? $result->soc_twitter : '-',
                    'tagline' => $result->tagline,
                    'telp' => $result->telp,
                    'type' => $result->type,
                    'website' => $result->website ? $result->website : '-',
                    'products' => $resultProduct
                ];
            }
            return $resultMerchant;
        }
    }
}
