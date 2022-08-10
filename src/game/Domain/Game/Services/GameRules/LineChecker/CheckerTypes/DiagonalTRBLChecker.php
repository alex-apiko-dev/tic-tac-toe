<?php

namespace Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes;

use Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\Contracts\LineChecker;

final class DiagonalTRBLChecker implements LineChecker
{
    public function isHasLine(
        string $playerSign,
        array $board
    ): bool {
        $isHasDiagonal = true;
        $boardSize = count($board) - 1;
        for ($x = $boardSize; $x >= 0; $x--) {
            if ($board[$x][$boardSize - $x] !== $playerSign) {
                $isHasDiagonal = false;
                break;
            }
        }

        return $isHasDiagonal;
    }
}
