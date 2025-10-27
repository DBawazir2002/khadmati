<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogicException extends Exception
{
    public function __construct($message = 'error', $statusCode = 400)
    {
        parent::__construct($message, $statusCode);
    }

    public function render(Request $request): JsonResponse
    {
        return sendFailedResponse(message: $this->message, status_code: $this->code);
    }
}
