<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Services\ContactService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    use ApiResponseTrait;

    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function show($id)
    {
        $contact = $this->contactService->getContactContent($id);
        $contactResource = new ContactResource($contact);
        return $this->successResponse($contactResource, 'Contact fetched successfully');
    }

    public function update($id, Request $request)
    {
        $contact = $this->contactService->getContactContent($id);
        $data = $request->all();

        if($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($contact->image_url && Storage::disk('public')->exists($contact->image_url)) {
                Storage::disk('public')->delete($contact->image_url);
            }

            $image = $request->file('image_url');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('contactContent', $fileName, 'public');
            $data['image_url'] = 'contactContent/' . $fileName;
        } elseif ($request->filled('image_url') === false && $contact->image_url) {
            if (Storage::disk('public')->exists($contact->image_url)) {
                Storage::disk('public')->delete($contact->image_url);
            }
            $data['image_url'] = null;
        } else {
            unset($data['image_url']);
        }

        $contact = $this->contactService->updateContactContent($id, $data);
        $contactResource = new ContactResource($contact);
        return $this->successResponse($contactResource, 'Contact updated successfully');
    }
}
