<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ShortContent extends Model
{
    protected $fillable = [
        'title_en',
        'title_mm',
        'desc_en',
        'desc_mm',
        'youtube_url',
        'image_url',
    ];

    public function getImageUrlAttribute($value)
    {
        //  If it's already a full URL, return as-is
        if ($value && preg_match('/^https?:\/\//', $value)) {
            return $value;
        }

        //  If it's in storage/app/public
        if ($value && Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
        }

        //  If it's in public/images
        if ($value && file_exists(public_path($value))) {
            return asset($value);
        }

        //  Default fallback image
        return asset('images/shorts_section/shorts_section_banner.png');
    }
}
