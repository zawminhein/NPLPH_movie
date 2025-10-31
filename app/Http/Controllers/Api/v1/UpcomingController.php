<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpcomingContentRequest;
use App\Http\Resources\UpcomingResource;
use App\Services\UpcomingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpcomingController extends Controller
{
    use ApiResponseTrait;
    protected $upcomingService;

    public function __construct(UpcomingService $upcomingService)
    {
        $this->upcomingService = $upcomingService;
    }

    public function show()
    {
        $upcoming = $this->upcomingService->getUpcomingContent();
        $upcomingResource = new UpcomingResource($upcoming);
        return $this->successResponse($upcomingResource, 'Upcoming fetched successfully');
    }

    public function update(UpcomingContentRequest $request)
    {
        try{
            $upcoming = $this->upcomingService->getUpcomingContent();
            $upcoming = $this->upcomingService->updateUpcomingContent($upcoming, $request);
            $upcomingResource = new UpcomingResource($upcoming);
            return $this->successResponse($upcomingResource, 'Upcoming updated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
