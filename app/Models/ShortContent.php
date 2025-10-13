<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortContent extends Model
{
    protected $fillable = [
        'title_en',
        'title_mm',
        'desc_en',
        'desc_mm',
        'youtube_url',
    ];
}
