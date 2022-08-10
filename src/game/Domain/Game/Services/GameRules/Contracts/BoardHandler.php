<?php

namespace Game\Domain\Game\Services\GameRules\Contracts;

use Game\Domain\Game\Game;

interface BoardHandler
{
    public function getWinnerOrNull(Game $game): ?string;
}
