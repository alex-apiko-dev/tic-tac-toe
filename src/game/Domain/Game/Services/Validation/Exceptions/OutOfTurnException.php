<?php

namespace Game\Domain\Game\Services\Validation\Exceptions;

use App\Exceptions\ResponseCodes;

final class OutOfTurnException extends \Exception
{
    protected $message = 'errors.out_of_turn';
    protected $code = ResponseCodes::NOT_ACCEPTABLE_CODE;
}
