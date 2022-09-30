<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Banner extends Model
{
    use HasFactory, Sortable;
    protected $table = 'banners';
    protected $fillable = ['title','image','additional_image','url'];
     public $sortable = [
        'title', 'url'
    ];
}
