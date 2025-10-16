<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShortResource;
use App\Models\ShortContent;
use App\Services\ShortService;
use App\Traits\ApiResponseTrait;
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

    public function update($id, Request $request)
    {
        $short = $this->shortService->updateShortContent($id, $request->all());
        $shortResource = new ShortResource($short);
        return $this->successResponse($shortResource, 'Short updated successfully');
    }
}
