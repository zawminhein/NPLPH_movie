<?php

namespace App\Services;

use App\Models\AboutContent;
use App\Models\Content;
use Illuminate\Support\Facades\Storage;

class AboutService
{
    public function getAllAboutContent()
    {
        $about = AboutContent::first();
        return $about;
    }
    public function getAboutContent($id)
    {
        $about = AboutContent::find($id);
        // dd($about);
        return $about;
    }

    public function updateAboutContent($about, $request)
    {
        $data = $request->all();
        $updateData = [
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
        ];

        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($about->image_url && Storage::disk('public')->exists($about->image_url)) {
                Storage::disk('public')->delete($about->image_url);
            }

            $image = $request->file('image_url');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('aboutContent/bg_image', $fileName, 'public');
            $updateData['image_url'] = 'aboutContent/bg_image/' . $fileName;
        } elseif ($request->filled('image_url') === false && $about->image_url) {
            Storage::disk('public')->delete($about->image_url);
            $updateData['image_url'] = null;
        } else {
            unset($updateData['image_url']);
        }
        $about->update($updateData);
        return $about;
    }

    public function contentUpload($request, $about_id)
    {
        // Validate images
        $request->validated();

        // Delete existing contents and files
        $existingContents = Content::where('type_id', $about_id)
            ->where('type', AboutContent::class)
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
            $content->type = AboutContent::class;
            $content->path = '/storage/aboutContent/' . $filename;
            $content->order = $order++;
            $content->save();

            $uploaded[] = $content;
        }

        return $uploaded;
    }
}