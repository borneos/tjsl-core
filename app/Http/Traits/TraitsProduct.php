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
        $type     = $data['type'];

        if ($filter == null) {
            if ($merchant == null) { /* filter null merchant null */
                if ($status == null) {
                    /* filter null merchant null status null */
                    $products = Product::sortable()->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products', 'type');
                } else {
                    /* filter null merchant null status not null */
                    $products = Product::sortable()->where('products.status', 'like', '%' . $status . '%')->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products', 'type');
                }
            } else { /* filter null merchant not null */
                if ($status == null) {
                    /* filter null merchant not null status null */
                    $products = Product::sortable()->where('products.merchant_id', '=', $merchant)->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products', 'type');
                } else {
                    /* filter null merchant not null status not null */
                    $products = Product::sortable()
                        ->where([['products.merchant_id', '=', $merchant],['products.status', '=', $status]])
                        ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products', 'type');
                }
            }
        } else { /* filter not null */
            if ($merchant == null) {
                if ($status == null) {
                    /* filter not null merchant null status null */
                     $products = Product::sortable()
                            ->where('products.name', 'like', '%' . $filter . '%')
                            ->orWhere('products.price', '=', $filter)
                            ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products', 'type');
                } else {
                    /* filter not null merchant null status not null */
                    $products = Product::sortable()
                            ->where([['products.name', 'like', '%' . $filter . '%'],['products.status','=',$status]])
                            ->orWhere([['products.price','=',$filter],['products.status','=',$status]])
                            ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products', 'type');
                }
            } else { /* filter not null merchant not null */
                if ($status == null) {
                    /* filter not null merchant not null status null */
                    $products = Product::sortable()
                        ->where([['products.merchant_id', '=', $merchant],['products.name', 'like', '%' . $filter . '%']])
                        ->orWhere([['products.merchant_id', '=', $merchant],['products.price', '=', $filter]])
                        ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products', 'type');
                } else {
                    /* filter not null merchant not null status not null */
                    $products = Product::sortable()
                        ->where([['products.merchant_id', '=', $merchant],['products.name', 'like', '%' . $filter . '%'],['products.status','=',$status]])
                        ->orWhere([['products.merchant_id', '=', $merchant],['products.price', '=', $filter],['products.status','=',$status]])
                        ->paginate(10);
                    return compact('filter', 'merchant', 'status', 'products', 'type');
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
}
