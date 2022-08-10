<?php

namespace App\Exceptions\Custom;

use App\Exceptions\ResponseCodes;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class AccessDenied extends \Exception
{
    private const ACCESS_DENIED = 'exceptions.forbidden.access_denied';

    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            $message ?? self::ACCESS_DENIED,
            ResponseCodes::ACCESS_DENIED_CODE,
            $previous
        );
    }
}
