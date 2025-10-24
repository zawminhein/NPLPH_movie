<?php

namespace App\Http\Controllers\APi\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Services\ActivityService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->all();
        if($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('activityContent', $filename, 'public');

            // Store the new file and update the image_url field in $data
            $data['image_url'] = 'activityContent/' . $filename;
        } else {
            $data['image_url'] = null;
        }

        if($request->hasFile('bg_image_url')) {
            $image = $request->file('bg_image_url');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('activityContent/bg_image', $filename, 'public');

            // Store the new file and update the image_url field in $data
            $data['bg_image_url'] = 'activityContent/bg_image/' . $filename;
        } else {
            $data['bg_image_url'] = null;
        }
        $activity = $this->activityService->createActivity($data);
        $activityResource = new ActivityResource($activity);
        return $this->successResponse($activityResource, 'Activity created successfully', 201);
    }

    public function update($id, ActivityRequest $request)
    {
        $activity = $this->activityService->getActivity($id);
        // dd($activity);
        $data = $request->all();

        if($request->hasFile('image_url')) {
            $oldImagePath = $activity->image_url;

            // DELETE OLD IMAGE: Robustly clean the path before checking/deleting
            if ($oldImagePath) {
                // Remove potential /storage/ or storage/ prefix that might be saved in the DB
                $cleanPath = str_replace('storage/', '', $oldImagePath);
                // Remove potential leading slash
                $cleanPath = ltrim($cleanPath, '/');
                
                if (Storage::disk('public')->exists($cleanPath)) {
                    Storage::disk('public')->delete($cleanPath);
                }
            }

            $image = $request->file('image_url');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('activityContent', $filename, 'public');

            // Store the new file and update the image_url field in $data
            $data['image_url'] = 'activityContent/' . $filename;
            // dd($data['image_url']);
        }
        elseif ($request->filled('image_url') === false && $activity->image_url) 
        {
            $oldImagePath = $activity->image_url;
            
            // DELETE OLD IMAGE: Robustly clean the path before checking/deleting
            if ($oldImagePath) {
                // Remove potential /storage/ or storage/ prefix that might be saved in the DB
                $cleanPath = str_replace('storage/', '', $oldImagePath);
                // Remove potential leading slash
                $cleanPath = ltrim($cleanPath, '/');
                
                if (Storage::disk('public')->exists($cleanPath)) {
                    Storage::disk('public')->delete($cleanPath);
                }
            }
            
            // Set image_url to null in the database
            $data['image_url'] = null;
        } 
        else {
            unset($data['image_url']); 
        }

        if ($request->hasFile('bg_image_url')) {
            $oldImagePath = $activity->bg_image_url;
            // dd($oldImagePath);

            // DELETE OLD IMAGE: Robustly clean the path before checking/deleting
            if ($oldImagePath) {
                // Remove potential /storage/ or storage/ prefix that might be saved in the DB
                $cleanPath = str_replace('storage/', '', $oldImagePath);
                // Remove potential leading slash
                $cleanPath = ltrim($cleanPath, '/');
                
                if (Storage::disk('public')->exists($cleanPath)) {
                    Storage::disk('public')->delete($cleanPath);
                }
            }

            $image = $request->file('bg_image_url');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('activityContent/bg_image', $filename, 'public');

            // Store the new file and update the image_url field in $data
            $data['bg_image_url'] = 'activityContent/bg_image/' . $filename;
            // dd($data['bg_image_url']);
        } 
        elseif ($request->filled('bg_image_url') === false && $activity->bg_image_url) 
        {
            $oldImagePath = $activity->bg_image_url;
            
            // DELETE OLD IMAGE: Robustly clean the path before checking/deleting
            if ($oldImagePath) {
                // Remove potential /storage/ or storage/ prefix that might be saved in the DB
                $cleanPath = str_replace('storage/', '', $oldImagePath);
                // Remove potential leading slash
                $cleanPath = ltrim($cleanPath, '/');
                
                if (Storage::disk('public')->exists($cleanPath)) {
                    Storage::disk('public')->delete($cleanPath);
                }
            }
            
            // Set image_url to null in the database
            $data['bg_image_url'] = null;
        } 
        else {
            unset($data['bg_image_url']); 
        }
        $activity = $this->activityService->updateActivity($id, $data);
        $activityResource = new ActivityResource($activity);
        return $this->successResponse($activityResource, 'Activity updated successfully');
    }

    public function destroy($id)
    {
        $this->activityService->deleteActivity($id);
        return $this->successResponse('message', 'ACtivity deleted successfully');
    }
}
