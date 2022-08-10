<?php

namespace Game\Domain\Game\Services\Validation\Exceptions;

use App\Exceptions\ResponseCodes;

final class GameNotFoundException extends \Exception
{
    protected $message = 'errors.no_game';
    protected $code = ResponseCodes::NOT_FOUND_CODE;
}
