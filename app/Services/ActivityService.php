<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class ActivityService
{
    public function getActivities()
    {
        $activities = Activity::orderBy('updated_at', 'desc')->paginate(10);
        return $activities;
    }
    public function getActivity($id)
    {
        $activity = Activity::find($id);
        return $activity;
    }

    public function createActivity($request)
    {
        // dd($request->all());
        $data = $request->all();
        $createData = [
            'title_en' => $data['title_en'],
            'title_mm' => $data['title_mm'],
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            // 'image_url' => $data['image_url'] ?? null,
            // 'bg_image_url' => $data['bg_image_url'] ?? null,
        ];

        // dd($request->hasFile('image_url'));
        if($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('activityContent', $filename, 'public');

            // Store the new file and update the image_url field in $data
            $createData['image_url'] = 'activityContent/' . $filename;
        } elseif ($request->filled('image_url') === false) {
            $createData['image_url'] = null;
        }else {
            $createData['image_url'] = null;
        }
        $activity = Activity::create($createData);
        return $activity;
    }

    public function updateActivity($id, $request)
    {
        $activity = Activity::find($id);
        $data = $request->all();
        $updateData = [
            'title_en' => $data['title_en'],
            'title_mm' => $data['title_mm'],
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            'image_url' => $data['image_url'] ?? null,
            // 'bg_image_url' => $data['bg_image_url'] ?? null,
        ];

        // dd($request->hasFile('image_url'));
        if($request->hasFile('image_url')) {
            // Delete old image if exists
            // dd($activity);
            if ($activity->image_url && Storage::disk('public')->exists($activity->image_url)) {
                Storage::disk('public')->delete($activity->image_url);
            }
            // dd($request->file('image_url'));
            $image = $request->file('image_url');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store on public disk
            $image->storeAs('activityContent', $filename, 'public');

            // Store the new file and update the image_url field in $data
            $updateData['image_url'] = 'activityContent/' . $filename;
            // dd($data['image_url']);
        } else {
            unset($updateData['image_url']); 
        }

        $activity->update($updateData);
        return $activity;
    }

    public function deleteActivity($id)
    {
        $activity = Activity::find($id);
        $activity->delete();
        return $activity;
    }
}