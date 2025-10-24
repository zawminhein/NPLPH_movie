<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
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
    public function show($id)
    {
        $about = $this->aboutService->getAboutContent($id);
        $aboutResource = new AboutResource($about);
        return $this->successResponse($aboutResource, 'About fetched successfully');
    }

    public function update($id, Request $request)
    {
        $about = $this->aboutService->getAboutContent($id);
        $data = $request->all(); 

        if ($request->hasFile('image_url')) {
            $oldImagePath = $about->image_url;
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
            $image->storeAs('aboutContent/bg_image', $filename, 'public');

            // Store the new file and update the image_url field in $data
            $data['image_url'] = 'aboutContent/bg_image/' . $filename;
            // dd($data['image_url']);
        } 
        elseif ($request->filled('image_url') === false && $about->image_url) 
        {
            $oldImagePath = $about->image_url;
            
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

        $about = $this->aboutService->updateAboutContent($id, $data);
        
        $aboutResource = new AboutResource($about);
        return $this->successResponse($aboutResource, 'About updated successfully');
    }

    public function contentUpload(Request $request, $about_id)
    {
        // Validate images
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Delete existing contents and files
        $existingContents = Content::where('type_id', $about_id)
            ->where('type', 'App\\Models\\AboutContent')
            ->get();

        foreach ($existingContents as $content) {
            $filePath = str_replace('/storage/', '', $content->path); // Remove /storage/
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $content->delete();
        }

        // Upload and save new contents
        $uploaded = [];
        $order = 1;

        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('aboutContent', $filename, 'public');

            // Create new Content record
            $content = new Content();
            $content->type_id = $about_id;
            $content->type = 'App\\Models\\AboutContent';
            $content->path = '/storage/aboutContent/' . $filename;
            $content->order = $order++;
            $content->save();

            $uploaded[] = $content;
        }

        return $this->successResponse($uploaded, 'Images uploaded and contents updated successfully.');
    }


}
