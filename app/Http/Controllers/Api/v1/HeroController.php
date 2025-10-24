<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Services\HeroService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HeroController extends Controller
{
    use ApiResponseTrait;
    private $heroService;
    public function __construct(HeroService $heroService)
    {
        $this->heroService = $heroService;
    }
    public function show($id)
    {
        $hero = $this->heroService->getHeroContent($id);
        $heroResource = new HeroResource($hero);
        return $this->successResponse($heroResource, 'Hero fetched successfully');
    }

    
    public function update($id, Request $request)
    {
        $hero = $this->heroService->getHeroContent($id);
        $data = $request->all();

        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($hero->image_url && Storage::disk('public')->exists($hero->image_url)) {
                Storage::disk('public')->delete($hero->image_url);
            }

            $image = $request->file('image_url');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('heroContent', $fileName, 'public');
            $data['image_url'] = 'heroContent/' . $fileName;
            // Store new image
            // $data['image_url'] = $fileName->store('heroContent', 'public');
        } 
        elseif ($request->filled('image_url') === false && $hero->image_url) 
        {
            if (Storage::disk('public')->exists($hero->image_url)) {
                Storage::disk('public')->delete($hero->image_url);
            }
            $data['image_url'] = null;
        } else {
            unset($data['image_url']);
        }

        $hero = $this->heroService->updateHeroContent($id, $data);

        return $this->successResponse(new HeroResource($hero), 'Hero updated successfully');
    }
}
