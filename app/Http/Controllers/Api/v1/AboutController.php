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
        $about = $this->aboutService->updateAboutContent($id, $request->all());
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
