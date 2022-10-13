<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Responder extends Model
{
    use HasFactory, Sortable;
    protected $table = 'responder';
    protected $fillable = ['name','email','telp','message'];
    public $sortable = [
        'id','name', 'email','message'
    ];
}
