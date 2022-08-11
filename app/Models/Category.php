<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Category extends Model
{
    use HasFactory, Sortable;
    protected $table = 'categories';
    public $sortable = [
        'name', 'slug'
    ];
    protected $fillable = [
        'name', 'slug', 'description', 'image', 'additional_image'
    ];
}
