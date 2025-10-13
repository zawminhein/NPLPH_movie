<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpcomingContent extends Model
{
    protected $fillable = [
        'title_en',
        'title_mm',
        'image_url',
        'short_desc_en',
        'short_desc_mm',
        'long_desc_en',
        'long_desc_mm',
    ];
}
