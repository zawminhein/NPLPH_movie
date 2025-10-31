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
    public function getAboutContent()
    {
        $about = AboutContent::first();
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

        // dd($request->all());
        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($about->image_url && Storage::disk('public')->exists($about->getRawOriginal('image_url'))) {
                Storage::disk('public')->delete($about->getRawOriginal('image_url'));
            }

            $image = $request->file('image_url');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('aboutContent/bg_image', $fileName, 'public');
            $updateData['image_url'] = 'aboutContent/bg_image/' . $fileName;
        } else {
            unset($updateData['image_url']);
        }
        $about->update($updateData);
        return $about;
    }

    public function updateAboutImages($request)
    {
        // Validate images
        $request->validated();

        $about_id = AboutContent::first()->id;

        // Delete existing contents and files
        $existingContents = Content::where('type_id')
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
        // $order = 1;

        foreach ($request->file('images') as $key => $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('aboutContent', $filename, 'public');

            // Create new Content record
            $content = new Content();
            $content->type_id = $about_id;
            $content->type = AboutContent::class;
            $content->path = '/storage/aboutContent/' . $filename;
            $content->order = $key + 1;
            $content->save();

            $uploaded[] = $content;
        }

        return $uploaded;
    }
}