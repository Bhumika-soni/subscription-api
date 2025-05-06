<?php

namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Success Response
     */
    protected function successResponse($data = [], $message = 'Success', $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Error Response
     */
    protected function errorResponse($message = 'Error', $errors = [], $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }

    /**
     * Validation Error Response
     */
    protected function validationErrorResponse($errors)
    {
        return response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Not Found Response
     */
    protected function notFoundResponse($message = 'Resource not found')
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => ['resource' => ['The requested resource was not found']]
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Unauthorized Response
     */
    protected function unauthorizedResponse($message = 'Unauthorized')
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => ['auth' => ['Please login to continue']]
        ], Response::HTTP_UNAUTHORIZED);
    }
}
