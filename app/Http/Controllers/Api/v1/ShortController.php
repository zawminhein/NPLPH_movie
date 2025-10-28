<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortContentRequest;
use App\Http\Resources\ShortResource;
use App\Models\ShortContent;
use App\Services\ShortService;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ShortController extends Controller
{
    use ApiResponseTrait;
    protected $shortService;
    public function __construct(ShortService $shortService)
    {
        $this->shortService = $shortService;
    }

    public function show($id)
    {
        $short = $this->shortService->getShortContent($id);
        $shortResource = new ShortResource($short);
        return $this->successResponse($shortResource, 'Short fetched successfully');
    }

    public function update($id, ShortContentRequest $request)
    {
        $short = $this->shortService->getShortContent($id);
        $short = $this->shortService->updateShortContent($short, $request);
        $shortResource = new ShortResource($short);
        return $this->successResponse($shortResource, 'Short updated successfully');
    }
}
