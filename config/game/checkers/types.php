<?php

use Game\Domain\Game\Services\GameRules\LineChecker\Contracts\LineCheckerBuilder;
use Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\{
    DiagonalTLBRChecker,
    DiagonalTRBLChecker,
    HorizontalChecker,
    VerticalChecker
};

return [
    LineCheckerBuilder::DIAGONAL_TLBR_TYPE => DiagonalTLBRChecker::class,
    LineCheckerBuilder::DIAGONAL_TRBL_TYPE => DiagonalTRBLChecker::class,
    LineCheckerBuilder::HORIZONTAL_TYPE => HorizontalChecker::class,
    LineCheckerBuilder::VERTICAL_TYPE => VerticalChecker::class,
];
