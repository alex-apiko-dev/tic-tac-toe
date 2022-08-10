<?php

namespace Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes;

use Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\Contracts\LineChecker;

final class VerticalChecker implements LineChecker
{
    public function isHasLine(
        string $playerSign,
        array $board
    ): bool {
        $result = false;
        $boardSize = count($board);
        for ($y = 0; $y < $boardSize; $y++) {
            $isHasVertical = true;
            for ($x = 0; $x < $boardSize; $x++) {
                if ($board[$x][$y] !== $playerSign) {
                    $isHasVertical = false;
                    break;
                }
            }

            if ($isHasVertical) {
                $result = $isHasVertical;
                break;
            }
        }

        return $result;
    }
}
