<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Merchant, Product};
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
            'price'    => 'required'
        ]);

        if ($request->image) {
            foreach ($request->image as $item) {
                $path_name = $item->getRealPath();
                $image = Cloudinary::upload($path_name, ["folder" => 'tjsl-core/products', "overwrite" => TRUE, "resource_type" => "image"]);
                $image_url = $image->getSecurePath();
                $ext = substr($image_url, -3);
                $ext_jpeg = substr($image_url, -4);

                if ($ext == "jpg") {
                    $image_url_webp = substr($image_url, 0, -3) . "webp";
                } else if ($ext == "png") {
                    $image_url_webp = substr($image_url, 0, -3) . "webp";
                } elseif ($ext == "svg") {
                    $image_url_webp = substr($image_url, 0, -3) . "webp";
                } elseif ($ext_jpeg == "jpeg") {
                    $image_url_webp = substr($image_url, 0, -4) . "webp";
                };
                $additional_image[] = [
                    'https'     =>  $image->getSecurePath(),
                    'public_id' =>  $image->getPublicId(),
                    'file_type' =>  $image->getFileType(),
                    'size'      =>  $image->getReadableSize(),
                    'width'     =>  $image->getWidth(),
                    'height'    =>  $image->getHeight(),
                    'extension' =>  $image->getExtension(),
                    'webp'      =>  $image_url_webp
                ];
                $result_image[] = ['url' => $image_url];
            };
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
            'description' => $request->description ?? '',
            'price' => $request->price,
            'image' => $result_image ? json_encode($result_image) : '',
            'additional_image' => $additional_image ? json_encode($additional_image) : '',
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.product.index');
    }
}
