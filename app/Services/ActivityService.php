<?php

namespace App\Services;

use App\Models\Activity;

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

    public function createActivity($data)
    {
        $createData = [
            'title_en' => $data['title_en'],
            'title_mm' => $data['title_mm'],
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            'image_url' => $data['image_url'] ?? null,
        ];
        $activity = Activity::create($createData);
        return $activity;
    }

    public function updateActivity($id, $data)
    {
        $updateData = [
            'title_en' => $data['title_en'],
            'title_mm' => $data['title_mm'],
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            'image_url' => $data['image_url'] ?? null,
        ];
        $activity = Activity::find($id);
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