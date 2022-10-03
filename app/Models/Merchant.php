<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Merchant extends Model
{
    use HasFactory, Sortable;
    protected $table = 'merchants';
    public $sortable = [
        'name', 'slug', 'status'
    ];
    protected $fillable = [
        'id_category', 'type', 'image','cover_image','seo_image', 'additional_image','additional_image_cover','additional_image_seo', 'name', 'slug', 'tagline', 
        'short_description', 'description', 'biography', 'telp', 'address', 'city', 'district', 'lat', 'long', 'owner_name', 
        'owner_telp', 'owner_email', 'owner_address', 'soc_fb', 'soc_ig', 'soc_twitter', 'website', 'link_borneos', 'link_tokopedia',
        'link_shopee', 'link_bukalapak','favorite','status','status_type'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
    public function compressImage($setSize)
    {
        if ($this->additional_image) {
            $convert = json_decode($this->additional_image);
            if ($convert) {
                $public_image_host_cloudinary = env('PUBLIC_IMAGE_HOST_CLOUDINARY');
                $public_cloudinary_id = env('PUBLIC_CLOUDINARY_ID');
                $public_id = $convert->public_id;
                $link = "$public_image_host_cloudinary $setSize,c_fill/ $public_cloudinary_id $public_id.webp";
                return str_replace(' ', '', $link);
            } else {
                return env('PUBLIC_IMAGE_EMPTY');
            }
        } else {
            return env('PUBLIC_IMAGE_EMPTY');
        }
    }
}
