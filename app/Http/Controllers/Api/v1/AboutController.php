<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutContentRequest;
use App\Http\Requests\ContentUploadRequest;
use App\Http\Resources\AboutResource;
use App\Models\AboutContent;
use App\Models\Content;
use App\Services\AboutService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function update($id, AboutContentRequest $request)
    {
        $about = $this->aboutService->getAboutContent($id);
        $about = $this->aboutService->updateAboutContent($about, $request);
        $aboutResource = new AboutResource($about);
        return $this->successResponse($aboutResource, 'About updated successfully');
    }

    public function contentUpload(ContentUploadRequest $request, $about_id)
    {
        $uploaded = $this->aboutService->updateAboutImages($request, $about_id);
        return $this->successResponse($uploaded, 'Images uploaded and contents updated successfully.');
    }
}
