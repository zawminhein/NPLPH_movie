<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UpcomingContent extends Model
{
    protected $fillable = [
        'title_en',
        'title_mm',
        'image_url',
        'bg_image_url',
        'short_desc_en',
        'short_desc_mm',
        'long_desc_en',
        'long_desc_mm',
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
        return asset('images/upcoming_section/upcoming_banner1.png');
    }
}
