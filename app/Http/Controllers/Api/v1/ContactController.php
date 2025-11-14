<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
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

    public function show()
    {
        $contact = $this->contactService->getContactContent();
        $contactResource = new ContactResource($contact);
        return $this->successResponse($contactResource, 'Contact fetched successfully');
    }

    public function update( ContactRequest $request)
    {
        $contact = $this->contactService->getContactContent();
        $contact = $this->contactService->updateContactContent($contact, $request);
        $contactResource = new ContactResource($contact);
        return $this->successResponse($contactResource, 'Contact updated successfully');
    }
}
