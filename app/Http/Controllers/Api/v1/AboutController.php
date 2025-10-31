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
    public function show()
    {
        $about = $this->aboutService->getAboutContent();
        $aboutResource = new AboutResource($about);
        return $this->successResponse($aboutResource, 'About fetched successfully');
    }

    public function update( AboutContentRequest $request)
    {
        try{
            $about = $this->aboutService->getAboutContent();
            $about = $this->aboutService->updateAboutContent($about, $request);
            $aboutResource = new AboutResource($about);
            return $this->successResponse($aboutResource, 'About updated successfully');
        } catch(\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function contentUpload(ContentUploadRequest $request)
    {
        $uploaded = $this->aboutService->updateAboutImages($request);
        return $this->successResponse($uploaded, 'Images uploaded and contents updated successfully.');
    }
}
