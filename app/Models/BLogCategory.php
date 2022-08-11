<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class BLogCategory extends Model
{
    use HasFactory, Sortable;
    protected $table = 'blog-categories';
    public $sortable = [
        'name', 'slug'
    ];
    protected $fillable = [
        'name', 'slug', 'description', 'image', 'additional_image'
    ];
}
