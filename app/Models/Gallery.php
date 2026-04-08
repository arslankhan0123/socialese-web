<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'name',
        'link',
        'feature_image',
        'gallery_images',
        'gallery_videos',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'gallery_videos' => 'array',
    ];

}

