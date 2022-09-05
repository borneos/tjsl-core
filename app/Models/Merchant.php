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
        'id_category', 'type', 'image', 'seo_image', 'additional_image', 'additional_image_seo', 'name', 'slug', 'tagline', 'short_description', 'description', 'biography', 'telp', 'address', 'city', 'district', 'lat', 'long', 'owner_name', 'owner_telp', 'owner_email', 'owner_address', 'soc_fb', 'soc_ig', 'soc_twitter', 'website', 'link_borneos', 'link_tokopedia', 'link_shopee', 'link_bukalapak', 'status'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
