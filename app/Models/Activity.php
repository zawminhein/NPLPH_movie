<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title_en',
        'title_mm',
        'desc_en',
        'desc_mm',
        'image_url',
    ];
}
