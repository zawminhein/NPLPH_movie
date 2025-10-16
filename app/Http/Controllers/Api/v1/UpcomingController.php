<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UpcomingResource;
use App\Services\UpcomingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UpcomingController extends Controller
{
    use ApiResponseTrait;
    protected $upcomingService;

    public function __construct(UpcomingService $upcomingService)
    {
        $this->upcomingService = $upcomingService;
    }

    public function show($id)
    {
        $upcoming = $this->upcomingService->getUpcomingContent($id);
        $upcomingResource = new UpcomingResource($upcoming);
        return $this->successResponse($upcomingResource, 'Upcoming fetched successfully');
    }

    public function update(Request $request, $id)
    {
        $upcoming = $this->upcomingService->updateUpcomingContent($id, $request->all());
        $upcomingResource = new UpcomingResource($upcoming);
        return $this->successResponse($upcomingResource, 'Upcoming updated successfully');
    }
}
