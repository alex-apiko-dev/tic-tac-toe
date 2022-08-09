<?php

namespace App\Exceptions\Custom;

use App\Exceptions\ResponseCodes;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

final class WrongCredentialsException extends \Exception
{
    private const AUTH_FAILED = 'auth.failed';

    public function __construct()
    {
        parent::__construct();

        return new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'error' => [
                        'code' => ResponseCodes::NOT_ACCEPTABLE_CODE,
                        'message' => trans(self::AUTH_FAILED),
                    ],
                ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
