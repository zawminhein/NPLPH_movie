<?php

namespace App\Http\Controllers\APi\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Services\ActivityService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    use ApiResponseTrait;

    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function index()
    {
        $activities = $this->activityService->getActivities();
        $activitiesResource = ActivityResource::collection($activities);
        return $this->successResponse($activitiesResource, 'Activities fetched successfully');
    }

    public function show($id)
    {
        $activity = $this->activityService->getActivity($id);
        $activityResource = new ActivityResource($activity);
        return $this->successResponse($activityResource, 'Activity details fetched successfully');
    }

    public function store(Request $request)
    {
        $activity = $this->activityService->createActivity($request->all());
        $activityResource = new ActivityResource($activity);
        return $this->successResponse($activityResource, 'Activity created successfully', 201);
    }

    public function update($id, Request $request)
    {
        $activity = $this->activityService->updateActivity($id, $request->all());
        $activityResource = new ActivityResource($activity);
        return $this->successResponse($activityResource, 'Activity updated successfully');
    }

    public function destroy($id)
    {
        $this->activityService->deleteActivity($id);
        return $this->successResponse('message', 'ACtivity deleted successfully');
    }
}
