<?php

namespace Game\Domain\Game\Services\Validation\Exceptions;

use App\Exceptions\ResponseCodes;

final class InvalidCoordinatesException extends \Exception
{
    protected $message = 'errors.invalid_coordinates';
    protected $code = ResponseCodes::CONFLICT_CODE;
}
