<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\{CloudinaryImage, TraitsProduct};
use App\Models\{Merchant, Product};
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    use CloudinaryImage, TraitsProduct;

    public function index(Request $request)
    {
        $search = $this->SearchProductList([
            'filter'    => $request->query('filter'),
            'type'      => $request->query('type'),
            'merchant'  => $request->query('merchant'),
            'status'    => $request->query('status')
        ]);
        return view('admin.product.index', [
            'merchants' => Merchant::all(),
            'filter'    => $search['filter'],
            'type'      => $search['type'],
            'merchant'  => $search['merchant'],
            'status'    => $search['status'] == null ? 404 : $search['status'],
            'products'  => $search['products']
        ]);
    }
    public function product_status(Request $request)
    {
        $product = Product::withoutGlobalScopes()->find($request->id);
        $product->status = $request->status;
        $product->save();
        Alert::toast('Status Updated', 'success');
        return redirect()->route('admin.product.index');
    }
    public function product_favorite(Request $request)
    {
        $product = Product::withoutGlobalScopes()->find($request->id);
        $product->favorite = $request->favorite;
        $product->save();
        Alert::toast('Favorite Updated', 'success');
        return redirect()->route('admin.product.index');
    }
    public function add()
    {
        return view('admin.product.add', [
            'merchants' => Merchant::all()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'merchant' => 'required',
            'name'     => 'required',
            'price'    => 'required',
            'image'    => 'sometimes|array'
        ]);

        if ($request->image) {
            $image = $this->UploadImageMultipleCloudinary(['folder' => 'tjsl-core/products', 'images' => $request->image]);
            $result_image = json_encode($image['result_image']);
            $additional_image = json_encode($image['additional_image']);
        } else {
            $result_image = '';
            $additional_image = '';
        };

        $merchant = Merchant::find($request->merchant);

        Product::create([
            'sku' => $request->sku ?? '',
            'merchant_id' => $merchant->id,
            'merchant_name' => $merchant->name,
            'tags'  => $request->tags ? implode(", ", $request->tags) : '',
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description ?? '',
            'price' => $request->price,
            'image' => $result_image,
            'additional_image' => $additional_image,
            'favorite' => $request->favorite == 'on' ? 1 : 0,
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.product.index');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', [
            'merchants' => Merchant::all(),
            'product'   => $product,
            'tags'      => $product->tags ? explode(', ', $product->tags) : null,
            'additional_image' => $product->additional_image ? json_decode($product->additional_image) : null
        ]);
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'merchant' => 'required',
            'name'     => 'required',
            'price'    => 'required',
            'image'    => 'sometimes|array',
        ]);

        if ($request->image) {
            $image = $this->UpdateImageMultipleCloudinary([
                'images'     => $request->image,
                'folder'     => 'tjsl-core/products',
                'collection' => $product
            ]);
            $result_image     = json_encode($image['result_image']);
            $additional_image = json_encode($image['additional_image']);
        } else {
            $result_image     = $product->image;
            $additional_image = $product->additional_image;
        };

        $merchant = Merchant::find($request->merchant);

        $product->update([
            'sku' => $request->sku ?? '',
            'merchant_id' => $merchant->id,
            'merchant_name' => $merchant->name,
            'tags'  => $request->tags ? implode(", ", $request->tags) : $product->tags,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description ?? '',
            'price' => $request->price,
            'image' => $result_image,
            'additional_image' => $additional_image,
            'favorite' => $request->favorite == 'on' ? 1 : 0,
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        Alert::success('Success', 'Data Updated Successfully');
        return redirect()->route('admin.product.index');
    }
    public function delete(Product $product)
    {
        if ($product->additional_image) {
            foreach (json_decode($product->additional_image) as $item) {
                Cloudinary::destroy($item->public_id);
            }
        }
        $product->delete();
        return response()->json(['status' => 200]);
    }
}
