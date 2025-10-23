<?php

namespace App\Http\Controllers\APi\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
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
        return $this->paginationResponse($activitiesResource, $activities, 'Activities fetched successfully');
    }

    public function show($id)
    {
        $activity = $this->activityService->getActivity($id);
        $activityResource = new ActivityResource($activity);
        return $this->successResponse($activityResource, 'Activity details fetched successfully');
    }

    public function store(ActivityRequest $request)
    {
        // $request->validate([
        //     'title_en' => 'required|string|max:255',
        //     'title_mm' => 'required|string|max:255',
        //     'desc_en' => 'required|string',
        //     'desc_mm' => 'required|string',
        //     'image_url' => 'nullable|string',
        // ]);
        // dd($request->validated());
        $activity = $this->activityService->createActivity($request->validated());
        $activityResource = new ActivityResource($activity);
        return $this->successResponse($activityResource, 'Activity created successfully', 201);
    }

    public function update($id, ActivityRequest $request)
    {
        // dd($request->all(), $request->method());

        // $request->validate([
        //     'title_en' => 'required|string|max:255',
        //     'title_mm' => 'required|string|max:255',
        //     'desc_en' => 'required|string',
        //     'desc_mm' => 'required|string',
        //     'image_url' => 'nullable|string',
        // ]);
        $activity = $this->activityService->updateActivity($id, $request->validated());
        $activityResource = new ActivityResource($activity);
        return $this->successResponse($activityResource, 'Activity updated successfully');
    }

    public function destroy($id)
    {
        $this->activityService->deleteActivity($id);
        return $this->successResponse('message', 'ACtivity deleted successfully');
    }
}
