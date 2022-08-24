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
}
