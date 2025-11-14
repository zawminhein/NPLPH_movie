<?php

namespace App\Services;

use App\Models\ContactContent;
use Illuminate\Support\Facades\Storage;

class ContactService
{
    public function getContactContent()
    {
        $contact = ContactContent::first();
        return $contact;
    }

    public function updateContactContent($contact, $request)
    {
        $data = $request->all();
        $updateData = [
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            'mail' => $data['mail'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'image_url' => $data['image_url'] ?? null,
        ];
        if($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($contact->image_url && Storage::disk('public')->exists($contact->image_url)) {
                Storage::disk('public')->delete($contact->image_url);
            }
            $image = $request->file('image_url');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('contactContent', $fileName, 'public');
            $updateData['image_url'] = 'contactContent/' . $fileName;
        } else {
            unset($updateData['image_url']);
        }
        $contact->update($updateData);
        return $contact;
    }
}