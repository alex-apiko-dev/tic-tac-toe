<?php

namespace Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes;

use Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\Contracts\LineChecker;

final class HorizontalChecker implements LineChecker
{
    public function isHasLine(
        string $playerSign,
        array $board
    ): bool {
        $result = false;
        foreach ($board as $x => $line) {
            $isHasHorizontal = true;
            foreach ($line as $y => $item) {
                if ($item !== $playerSign) {
                    $isHasHorizontal = false;
                    break;
                }
            }

            if ($isHasHorizontal) {
                $result = $isHasHorizontal;
                break;
            }
        }

        return $result;
    }
}
