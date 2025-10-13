<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactContent extends Model
{
    protected $fillable = [
        'desc_en',
        'desc_mm',
        'mail',
        'phone',
        'address',
        'image_url',
    ];
}
