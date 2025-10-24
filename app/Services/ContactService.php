<?php

namespace App\Services;

use App\Models\ContactContent;

class ContactService
{
    public function getContactContent($id)
    {
        $contact = ContactContent::find($id);
        return $contact;
    }

    public function updateContactContent($id, $data)
    {
        $updateData = [
            'desc_en' => $data['desc_en'],
            'desc_mm' => $data['desc_mm'],
            'mail' => $data['mail'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'image_url' => $data['image_url'] ?? null,
        ];
        $contact = ContactContent::find($id);
        $contact->update($updateData);
        return $contact;
    }
}