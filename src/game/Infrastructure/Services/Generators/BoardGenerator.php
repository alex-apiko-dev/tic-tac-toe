<?php

namespace Game\Infrastructure\Services\Generators;

use Game\Domain\Game\Game as EntityModel;

final class BoardGenerator
{
    public static function generateEmptyBoard(int $boardSize): array
    {
        $board = [];
        for ($xIndex = 0; $xIndex < $boardSize; $xIndex++) {
            $line = [];
            for ($yIndex = 0; $yIndex < $boardSize; $yIndex++) {
                $line[$yIndex] = EntityModel::EMPTY_SIGN;
            }

            $board[$xIndex] = $line;
        }

        return $board;
    }
}
