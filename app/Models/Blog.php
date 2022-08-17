<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Blog extends Model
{
    use HasFactory, Sortable;
    protected $table = 'blog';
    public $sortable = [
        'id', 'title', 'slug'
    ];
    protected $fillable = [
        'title', 'slug', 'short_description', 'description', 'category_id', 'image', 'additional_image',
        'author', 'tags', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function compressImage($setSize)
    {
        if ($this->additional_image) {
            $convert = json_decode($this->additional_image);
            if ($convert && $convert->public_id) {
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
