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
        $boardSize = count($board);
        for ($x = ($boardSize - 1); $x >= 0; $x--) {
            for ($y = 0; $y < $boardSize; $y++) {
                if ($board[$x][$y] !== $playerSign) {
                    $isHasDiagonal = false;
                    break;
                }
            }
        }

        return $isHasDiagonal;
    }
}
