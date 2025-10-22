<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * Success response
     */
    protected function successResponse($data = null, string $message = 'Success', int $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Error response
     */
    protected function errorResponse(string $message = 'Error', int $status = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status);
    }

    protected function paginationResponse($paginator, string $message = 'Success')
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $paginator->items(),
            // 'meta' => [
            //     'current_page' => $paginator->currentPage(),
            //     'per_page' => $paginator->perPage(),
            //     'total' => $paginator->total(),
            //     'last_page' => $paginator->lastPage(),
            // ]
        ]);
    }

    /**
     * Paginated response (optional)
     */
    // protected function paginatedResponse($paginator, string $message = 'Success')
    // {
    //     return response()->json([
    //         'success' => true,
    //         'message' => $message,
    //         'data' => $paginator->items(),
    //         'meta' => [
    //             'current_page' => $paginator->currentPage(),
    //             'per_page' => $paginator->perPage(),
    //             'total' => $paginator->total(),
    //             'last_page' => $paginator->lastPage(),
    //         ]
    //     ]);
    // }
}
