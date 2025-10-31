<?php

use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Response;

function sendSuccessResponse($message = 'successful', $data = null, $status_code = 200): JsonResponse|Response
{
    $response = [
        'status' => 'success',
        'message' => $message,
        'data' => $data,
    ];

    return $status_code !== 204 ? response()->json($response, $status_code) : response()->noContent();
}

function sendFailedResponse($message = 'failed', $errors = null, $status_code = 404, $data = null): JsonResponse
{
    $response = [
        'status' => 'failed',
        'message' => $message,
        'data' => $data,
        'errors' => $errors,
    ];

    if (is_null($data)) {
        unset($response['data']);
    }

    return response()->json($response, $status_code);
}
