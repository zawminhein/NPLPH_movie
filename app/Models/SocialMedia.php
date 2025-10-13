<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_medias';
    
    protected $fillable = [
        'facebook_link',
        'youtube_link',
        'tiktok_link',
    ];
}
