<?php

namespace Game\Domain\Game\Services\Validation\Contracts;

use Game\Domain\Game\Game;
use Game\Domain\Game\Structures\Coordinate;

interface ValidationRule
{
    public const INSTANCE = 'instance';
    public const ERROR_MESSAGE = 'error_message';
    public const ERROR_CODE = 'error_code';
    public const NEXT = 'next';

    public function validate(
        ?Game $game = null,
        string $piece,
        Coordinate $coordinate
    ): bool;
}
