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

    public function show($id)
    {
        $upcoming = $this->upcomingService->getUpcomingContent($id);
        $upcomingResource = new UpcomingResource($upcoming);
        return $this->successResponse($upcomingResource, 'Upcoming fetched successfully');
    }

    public function update(UpcomingContentRequest $request, $id)
    {
        $upcoming = $this->upcomingService->getUpcomingContent($id);
        // dd($upcoming);
        $data = $request->all();

        // if($request->hasFile('image_url')) {
        //     $oldImagePath = $upcoming->image_url;

        //     // DELETE OLD IMAGE: Robustly clean the path before checking/deleting
        //     if ($oldImagePath) {
        //         // Remove potential /storage/ or storage/ prefix that might be saved in the DB
        //         $cleanPath = str_replace('storage/', '', $oldImagePath);
        //         // Remove potential leading slash
        //         $cleanPath = ltrim($cleanPath, '/');
                
        //         if (Storage::disk('public')->exists($cleanPath)) {
        //             Storage::disk('public')->delete($cleanPath);
        //         }
        //     }

        //     $image = $request->file('image_url');
        //     $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        //     // Store on public disk
        //     $image->storeAs('upcomingContent', $filename, 'public');

        //     // Store the new file and update the image_url field in $data
        //     $data['image_url'] = 'upcomingContent/' . $filename;
        //     // dd($data['image_url']);
        // }
        // elseif ($request->filled('image_url') === false && $upcoming->image_url) 
        // {
        //     $oldImagePath = $upcoming->image_url;
            
        //     // DELETE OLD IMAGE: Robustly clean the path before checking/deleting
        //     if ($oldImagePath) {
        //         // Remove potential /storage/ or storage/ prefix that might be saved in the DB
        //         $cleanPath = str_replace('storage/', '', $oldImagePath);
        //         // Remove potential leading slash
        //         $cleanPath = ltrim($cleanPath, '/');
                
        //         if (Storage::disk('public')->exists($cleanPath)) {
        //             Storage::disk('public')->delete($cleanPath);
        //         }
        //     }
            
        //     // Set image_url to null in the database
        //     $data['image_url'] = null;
        // } 
        // else {
        //     unset($data['image_url']); 
        // }

        // if ($request->hasFile('bg_image_url')) {
        //     $oldImagePath = $upcoming->bg_image_url;
        //     // dd($oldImagePath);

        //     // DELETE OLD IMAGE: Robustly clean the path before checking/deleting
        //     if ($oldImagePath) {
        //         // Remove potential /storage/ or storage/ prefix that might be saved in the DB
        //         $cleanPath = str_replace('storage/', '', $oldImagePath);
        //         // Remove potential leading slash
        //         $cleanPath = ltrim($cleanPath, '/');
                
        //         if (Storage::disk('public')->exists($cleanPath)) {
        //             Storage::disk('public')->delete($cleanPath);
        //         }
        //     }

        //     $image = $request->file('bg_image_url');
        //     $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        //     // Store on public disk
        //     $image->storeAs('upcomingContent/bg_image', $filename, 'public');

        //     // Store the new file and update the image_url field in $data
        //     $data['bg_image_url'] = 'upcomingContent/bg_image/' . $filename;
        //     // dd($data['bg_image_url']);
        // } 
        // elseif ($request->filled('bg_image_url') === false && $upcoming->bg_image_url) 
        // {
        //     $oldImagePath = $upcoming->bg_image_url;
            
        //     // DELETE OLD IMAGE: Robustly clean the path before checking/deleting
        //     if ($oldImagePath) {
        //         // Remove potential /storage/ or storage/ prefix that might be saved in the DB
        //         $cleanPath = str_replace('storage/', '', $oldImagePath);
        //         // Remove potential leading slash
        //         $cleanPath = ltrim($cleanPath, '/');
                
        //         if (Storage::disk('public')->exists($cleanPath)) {
        //             Storage::disk('public')->delete($cleanPath);
        //         }
        //     }
            
        //     // Set image_url to null in the database
        //     $data['bg_image_url'] = null;
        // } 
        // else {
        //     unset($data['bg_image_url']); 
        // }
        $upcoming = $this->upcomingService->updateUpcomingContent($upcoming, $request);
        $upcomingResource = new UpcomingResource($upcoming);
        return $this->successResponse($upcomingResource, 'Upcoming updated successfully');
    }
}
