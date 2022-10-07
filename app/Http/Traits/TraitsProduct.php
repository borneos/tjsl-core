<?php

namespace App\Http\Traits;

use App\Models\Product;

trait TraitsProduct
{
    public function SearchProductList($data)
    {
        $filter   = $data['filter'];
        $merchant = $data['merchant'];
        $status   = $data['status'];

        if ($filter == null) {
            if ($merchant == null) { /* filter null merchant null */
                if ($status == null) {
                    /* filter null merchant null status null */
                    $products = Product::sortable()->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products');
                } else {
                    /* filter null merchant null status not null */
                    $products = Product::sortable()->where('products.status', 'like', '%' . $status . '%')->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products');
                }
            } else { /* filter null merchant not null */
                if ($status == null) {
                    /* filter null merchant not null status null */
                    $products = Product::sortable()->where('products.merchant_id', '=', $merchant)->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products');
                } else {
                    /* filter null merchant not null status not null */
                    $products = Product::sortable()->where('products.merchant_id', '=', $merchant)
                        ->where('products.status', '=', $status)
                        ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products');
                }
            }
        } else { /* filter not null */
            if ($merchant == null) {
                if ($status == null) {
                    /* filter not null merchant null status null */
                    $products = Product::sortable()
                        ->where('products.sku', 'like', '%' . $filter . '%')
                        ->orWhere('products.name', 'like', '%' . $filter . '%')
                        ->orWhere('products.merchant_name', 'like', '%' . $filter . '%')
                        ->orWhere('products.tags', 'like', '%' . $filter . '%')
                        ->orWhere('products.price', 'like', '%' . $filter . '%')
                        ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products');
                } else {
                    /* filter not null merchant null status not null */
                    $products = Product::sortable()
                        ->where('products.status', '=', $status)
                        ->orWhere('products.sku', 'like', '%' . $filter . '%')
                        ->orWhere('products.name', 'like', '%' . $filter . '%')
                        ->orWhere('products.merchant_name', 'like', '%' . $filter . '%')
                        ->orWhere('products.tags', 'like', '%' . $filter . '%')
                        ->orWhere('products.price', 'like', '%' . $filter . '%')
                        ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products');
                }
            } else { /* filter not null merchant not null */
                if ($status == null) {
                    /* filter not null merchant not null status null */
                    $products = Product::sortable()
                        ->where('products.merchant_id', '=', $merchant)
                        ->orWhere('products.sku', 'like', '%' . $filter . '%')
                        ->orWhere('products.name', 'like', '%' . $filter . '%')
                        ->orWhere('products.tags', 'like', '%' . $filter . '%')
                        ->orWhere('products.price', 'like', '%' . $filter . '%')
                        ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products');
                } else {
                    /* filter not null merchant not null status not null */
                    $products = Product::sortable()
                        ->where('products.merchant_id', '=', $merchant)
                        ->where('products.status', '=', $status)
                        ->orWhere('products.sku', 'like', '%' . $filter . '%')
                        ->orWhere('products.name', 'like', '%' . $filter . '%')
                        ->orWhere('products.tags', 'like', '%' . $filter . '%')
                        ->orWhere('products.price', 'like', '%' . $filter . '%')
                        ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products');
                }
            }
        }
    }
    public function QueryProductlist($data)
    {
        $request_q = $data['request_q']; //product name
        $slug_merchant = $data['slug_merchant']; //slug merchant

        if ($request_q && $slug_merchant) {
            return Product::whereHas('merchant', function ($q) use ($slug_merchant) {
                return $q->where('slug', '=', $slug_merchant);
            })
                ->where([['name', '=', $request_q], ['status', '=', 1]])
                ->orderBy('id', $data['sort'])
                ->paginate($data['perPage']);
        } elseif ($request_q) {
            return Product::where([['name', '=', $request_q], ['status', '=', 1]])->orderBy('id', $data['sort'])->paginate($data['perPage']);
        } elseif ($slug_merchant) {
            return Product::whereHas('merchant', function ($q) use ($slug_merchant) {
                return $q->where('slug', '=', $slug_merchant);
            })
                ->where('status', '=', 1)
                ->orderBy('id', $data['sort'])
                ->paginate($data['perPage']);
        } else {
            return Product::where('status', '=', 1)->orderBy('id', $data['sort'])->paginate($data['perPage']);
        }
    }
    public function resultProductList($data)
    {
        foreach ($data as $result) {
            $results[] = [
                'id' => $result->id,
                'sku' => $result->sku ? $result->sku : null,
                'merchant' => [
                    'id' => $result->merchant_id,
                    'name' => $result->merchant_id && $result->merchant->name ? $result->merchant->name : null,
                    'slug' => $result->merchant_id && $result->merchant->slug ? $result->merchant->slug : null
                ],
                'tags' => $result->tags ? $result->tags : null,
                'name' => $result->name,
                'slug' => $result->slug,
                'description' => $result->description ? $result->description : null,
                'price' => $result->price,
                'image' => $result->image ? json_decode($result->image) : null,
                'additionalImage' => $result->additional_image ? json_decode($result->additional_image) : null,
                'status' => $result->status
            ];
        }
        return $results;
    }
    public function productListByFavorite($data)
    {
        $products = Product::where([['favorite','=',$data['isFavorite']],['status','=',1]])->get();
        if($products->count() == 0){
            return null;
        }else{
            foreach($products as $product){
                $results[] = [
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
            return $results;
        }
    }
}
