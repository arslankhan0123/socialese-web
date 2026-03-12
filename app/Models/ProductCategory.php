<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'has_intermediate_page',
        'order',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
