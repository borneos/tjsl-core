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
        'name', 'slug'
    ];
    protected $fillable = [
        'name', 'slug', 'description', 'image', 'additional_image'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
