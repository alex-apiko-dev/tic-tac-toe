<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler implements ResponseCodes
{
    private const UNAUTHORIZED = 'Unauthorized';

    public function report(\Throwable $e)
    {
        parent::report($e);
    }

    public function render($request, \Throwable $e)
    {
        if ($e instanceof \InvalidArgumentException) {
            return $this->getExceptionResponse(
                $e->getCode(),
                $e->getMessage(),
                self::BAD_REQUEST_CODE
            );
        }

        return $this->getExceptionResponse(
            $e->getCode(),
            $e->getMessage(),
            $e->getCode() != 0 ? $e->getCode() : self::INTERNAL_ERROR_CODE
        );
    }

    private function getExceptionResponse(
        string $code,
        string $message,
        string $status
    ): JsonResponse {
        return response()->json(
            [
                'success' => false,
                'error' => [
                    'code' => $code,
                    'message' => trans($message),
                ],
            ],
            $status
        );
    }
}
