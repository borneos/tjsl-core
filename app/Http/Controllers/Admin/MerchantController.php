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
            'image'             => 'image|mimes:jpeg,png,jpg,svg|max:3072',
            'cover_image'       => 'image|mimes:jpeg,png,jpg,svg|max:3072',
            'seo_image'         => 'image|mimes:jpeg,png,jpg,svg|max:3072',
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
        }else{
            $image_url = '';
            $additional_image = '';
        }

        if ($request->file('cover_image')) {
            $image_cover = $this->UploadImageCloudinary(['image' => $request->file('cover_image'), 'folder' => 'tjsl-core/merchants/cover_image']);
            $image_url_cover = $image_cover['url'];
            $additional_image_cover = $image_cover['additional_image'];
        }else{
            $image_url_cover = '';
            $additional_image_cover = '';
        }

        if ($request->file('seo_image')) {
            $image_seo = $this->UploadImageCloudinary(['image' => $request->file('seo_image'), 'folder' => 'tjsl-core/merchants/seo_image']);
            $image_url_seo = $image_seo['url'];
            $additional_image_seo = $image_seo['additional_image'];
        }else{
            $image_url_seo = '';
            $additional_image_seo = '';
        }

        Merchant::create([
            'id_category'           => $request->category,
            'type'                  => $request->type,
            'status_type'           => $request->status_type == 'on' ? 1 : 0,
            'image'                 => $image_url,
            'seo_image'             => $image_url_seo,
            'cover_image'           => $image_url_cover,
            'additional_image'      => $additional_image,
            'additional_image_cover'=> $additional_image_cover,
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

    public function edit(Merchant $merchant)
    {
        $categories = Category::all();
        return view('admin.merchant.edit', [
            'merchant'  => $merchant,
            'categories'=> $categories
        ]);
    }

    public function update(Request $request, Merchant $merchant)
    {
        $request->validate([
            'category'          => 'required',
            'category'          => 'required',
            'type'              => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg,svg|max:3072',
            'cover_image'       => 'image|mimes:jpeg,png,jpg,svg|max:3072',
            'seo_image'         => 'image|mimes:jpeg,png,jpg,svg|max:3072',
            'name'              => 'required',
            'slug'              => 'required',
            'tagline'           => 'required',
            'short_description' => 'required',
            'description'       => 'required',
            'biography'         => 'required',
            'telp'              => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:merchants,telp,'.$merchant->id,
            'address'           => 'required',
            'city'              => 'required',
            'district'          => 'required',
            'lat'               => 'required',
            'long'              => 'required',
            'owner_name'        => 'required',
            'owner_telp'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:merchants,owner_telp,'.$merchant->id,
            'owner_email'       => 'required|unique:merchants,owner_email,'.$merchant->id,
            'owner_address'     => 'required'
        ]);

        if ($request->file('image')) {
            $image = $this->UpdateImageMerchantCloudinary([
                'image'      => $request->file('image'),
                'folder'     => 'tjsl-core/merchants/image',
                'storagePath'=> 'additionalImage',
                'collection' => $merchant
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        if ($request->file('cover_image')) {
            $cover_image = $this->UpdateImageMerchantCloudinary([
                'image'      => $request->file('cover_image'),
                'folder'     => 'tjsl-core/merchants/cover_image',
                'storagePath'=> 'additionalImageCover',
                'collection' => $merchant
            ]);
            $image_url_cover = $cover_image['url'];
            $additional_image_cover = $cover_image['additional_image'];
        }

        if ($request->file('seo_image')) {
            $seo_image = $this->UpdateImageMerchantCloudinary([
                'image'      => $request->file('seo_image'),
                'folder'     => 'tjsl-core/merchants/seo_image',
                'storagePath'=> 'additionalImageSeo',
                'collection' => $merchant
            ]);
            $image_url_seo = $seo_image['url'];
            $additional_image_seo = $seo_image['additional_image'];
        }

        $merchant->update([
            'id_category'           => $request->category,
            'type'                  => $request->type,
            'status_type'           => $request->status_type == 'on' ? 1 : 0,
            'image'                 => $image_url ?? $merchant->image,
            'cover_image'           => $image_url_cover ?? $merchant->cover_image,
            'seo_image'             => $image_url_seo ?? $merchant->seo_image,
            'additional_image'      => $additional_image ?? $merchant->additional_image,
            'additional_image_cover'=> $additional_image_cover ?? $merchant->additional_image_cover,
            'additional_image_seo'  => $additional_image_seo ?? $merchant->additional_image_seo,
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
        Alert::success('Success', 'Updated Successfully');
        return redirect()->route('admin.merchant.index');
    }

    public function delete(Merchant $merchant)
    {
        if ($merchant->image && $merchant->additional_image) {
            $key = json_decode($merchant->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        if ($merchant->seo_image && $merchant->additional_image_seo) {
            $key = json_decode($merchant->additional_image_seo);
            Cloudinary::destroy($key->public_id);
        }
        if ($merchant->cover_image && $merchant->additional_image_cover) {
            $key = json_decode($merchant->additional_image_cover);
            Cloudinary::destroy($key->public_id);
        }
        $merchant->delete();
        return response()->json(['status' => 200]);
    }

    public function status(Merchant $merchant, Request $request)
    {
        $merchant->update(['status' => $request->status]);

        Alert::toast('Status Updated', 'success');
        return redirect('/merchant');
    }
}
