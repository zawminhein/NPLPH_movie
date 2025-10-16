<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Services\AboutService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;


class AboutController extends Controller
{
    use ApiResponseTrait;
    protected $aboutService;
    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }
    public function show($id)
    {
        $about = $this->aboutService->getAboutContent($id);
        $aboutResource = new AboutResource($about);
        return $this->successResponse($aboutResource, 'About fetched successfully');
    }

    public function update($id, Request $request)
    {
        $about = $this->aboutService->updateAboutContent($id, $request->all());
        $aboutResource = new AboutResource($about);
        return $this->successResponse($aboutResource, 'About updated successfully');
    }
}
