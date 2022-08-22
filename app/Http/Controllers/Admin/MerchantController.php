<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Category;
use App\Models\Merchant;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MerchantController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $merchants = Merchant::sortable()
            ->where('merchants.name', 'like', '%' . $filter . '%')
            ->orWhere('merchants.slug', 'like', '%' . $filter . '%')
            ->paginate(10);
        } else {
            $merchants = Merchant::sortable()->paginate(10);
        }
        return view('admin.merchant.index', compact('merchants', 'filter'));
    }

    public function add(Request $request)
    {
        $categories = Category::all();
        return view('admin.merchant.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'          => 'required',
            'type'              => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'seo_image'         => 'image|mimes:jpeg,png,jpg,svg|max:8192',
            'name'              => 'required',
            'slug'              => 'required',
            'tagline'           => 'required',
            'short_description' => 'required',
            'description'       => 'required',
            'biography'         => 'required',
            'telp'              => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:merchants',
            'address'           => 'required',
            'city'              => 'required',
            'district'          => 'required',
            'lat'               => 'required',
            'long'              => 'required',
            'owner_name'        => 'required',
            'owner_telp'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:merchants',
            'owner_email'       => 'required|unique:merchants',
            'owner_address'     => 'required'
        ]);

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'tjsl-core/merchants/image']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        if ($request->file('seo_image')) {
            $image_seo = $this->UploadImageCloudinary(['image' => $request->file('seo_image'), 'folder' => 'tjsl-core/merchants/seo_image']);
            $image_url_seo = $image_seo['url'];
            $additional_image_seo = $image_seo['additional_image'];
        }

        Merchant::create([
            'id_category'           => $request->category,
            'type'                  => $request->type,
            'image'                 => $image_url,
            'seo_image'             => $image_url_seo,
            'additional_image'      => $additional_image,
            'additional_image_seo'  => $additional_image_seo,
            'name'                  => $request->name,
            'slug'                  => $request->slug,
            'tagline'               => $request->tagline,
            'short_description'     => $request->short_description,
            'description'           => $request->description,
            'biography'             => $request->biography,
            'telp'                  => $request->telp,
            'address'               => $request->address,
            'city'                  => $request->city,
            'district'              => $request->district,
            'lat'                   => $request->lat,
            'long'                  => $request->long,
            'owner_name'            => $request->owner_name,
            'owner_telp'            => $request->owner_telp,
            'owner_email'           => $request->owner_email,
            'owner_address'         => $request->owner_address,
            'soc_fb'                => $request->soc_fb,
            'soc_ig'                => $request->soc_ig,
            'soc_twitter'           => $request->soc_twitter,
            'website'               => $request->website,
            'link_borneos'          => $request->link_borneos,
            'link_tokopedia'        => $request->link_tokopedia,
            'link_shopee'           => $request->link_shopee,
            'link_bukalapak'        => $request->link_bukalapak
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.merchant.index');
    }
}
