<?php

namespace Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes;

use Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\Contracts\LineChecker;

final class DiagonalTLBRChecker implements LineChecker
{
    public function isHasLine(
        string $playerSign,
        array $board
    ): bool {
        $isHasDiagonal = true;
        $boardSize = count($board);
        for ($x = 0; $x < $boardSize; $x++) {
            if ($board[$x][$x] !== $playerSign) {
                $isHasDiagonal = false;
                break;
            }
        }

        return $isHasDiagonal;
    }
}
