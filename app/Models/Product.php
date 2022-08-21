<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $table = 'products';

    protected $fillable = [
        'sku', 'merchant_id', 'merchant_name', 'tags', 'name', 'description', 'price', 'image', 'additional_image', 'status'
    ];

    public $sortable = [
        'sku', 'name', 'merchant_name', 'tags', 'price'
    ];
}
