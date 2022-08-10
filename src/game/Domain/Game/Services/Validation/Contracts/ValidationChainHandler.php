<?php

namespace Game\Domain\Game\Services\Validation\Contracts;

use Game\Domain\Game\Game;
use Game\Domain\Game\Structures\Coordinate;

interface ValidationChainHandler
{
    public function handle(
        ?Game $game = null,
        string $piece,
        Coordinate $coordinate
    ): void;
}
