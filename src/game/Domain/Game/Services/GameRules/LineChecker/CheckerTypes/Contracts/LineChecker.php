<?php

namespace Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\Contracts;

interface LineChecker
{
    public function isHasLine(string $playerSign, array $board): bool;
}
