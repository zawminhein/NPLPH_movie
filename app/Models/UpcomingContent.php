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
    protected function resolveImagePath($value, $defaultPath)
    {
        if ($value && preg_match('/^https?:\/\//', $value)) {
            return $value;
        }

        if ($value && Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
        }

        if ($value && file_exists(public_path($value))) {
            return asset($value);
        }

        return asset($defaultPath);
    }

    public function getImageUrlAttribute($value)
    {
        return $this->resolveImagePath($value, 'images/upcoming_section/upcoming_banner2.png');
    }

    public function getBgImageUrlAttribute($value)
    {
        return $this->resolveImagePath($value, 'images/upcoming_section/upcoming_bg_banner1.png');
    }
}
