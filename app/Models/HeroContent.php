<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroContent extends Model
{
    protected $fillable = [
        'short_desc_en',
        'short_desc_mm',
        'long_desc_en',
        'long_desc_mm',
        'image_url',
    ];

    /**
     * Always return a valid full URL for the hero image.
     */
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
        return asset('images/hero_section/hero_section_banner1.png');
    }
}
