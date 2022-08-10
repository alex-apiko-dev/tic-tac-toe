<?php

namespace App\Exceptions\Custom;

use App\Exceptions\ResponseCodes;

final class ResourceNotFoundException extends \Exception
{
    protected $message = 'exceptions.resource.not_found';
    protected $code = ResponseCodes::NOT_FOUND_CODE;
}
