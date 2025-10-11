<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroContent extends Model
{
    protected $fillable = [
        'title_en',
        'title_mm',
        'short_desc_en',
        'short_desc_mm',
        'long_desc_en',
        'long_desc_mm',
        'image_url',
    ];
}
