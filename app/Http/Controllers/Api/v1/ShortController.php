<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
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

    public function update($id, Request $request)
    {
        $short = $this->shortService->getShortContent($id);
        $data = $request->all();

        if ($request->hasFile('image_url')) {
            $oldImagePath = $short->image_url;
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

            $image = $request->file('image_url');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('shortContent/bg_image', $filename, 'public');

            // Store the new file and update the image_url field in $data
            $data['image_url'] = 'shortContent/bg_image/' . $filename;
            // dd($data['image_url']);
        } 
        elseif ($request->filled('image_url') === false && $short->image_url) 
        {
            $oldImagePath = $short->image_url;
            
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
        $short = $this->shortService->updateShortContent($id, $data);
        $shortResource = new ShortResource($short);
        return $this->successResponse($shortResource, 'Short updated successfully');
    }
}
