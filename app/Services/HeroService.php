<?php

namespace App\Services;

use App\Models\HeroContent;

class HeroService
{
    public function getHeroContent($id)
    {
        return HeroContent::find($id);
    }
}