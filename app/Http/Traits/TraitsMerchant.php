<?php

namespace App\Http\Traits;

use App\Models\Merchant;

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
                'seoImage' => $result->seo_image ? $result->seo_image : null,
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
                'favorite' => $result->favorite
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
}
