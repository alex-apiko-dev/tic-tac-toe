<?php

namespace Game\Domain\Game\Services\GameRules\LineChecker\Contracts;

use Game\Domain\Game\Services\GameRules\LineChecker\Contracts\LineCheckerBuilder as Contract;
use Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\Contracts\LineChecker;

interface LineCheckerBuilder
{
    public const HORIZONTAL_TYPE = 'horizontal';
    public const VERTICAL_TYPE = 'vertical';
    public const DIAGONAL_TLBR_TYPE = 'diagonal_tlbr';
    public const DIAGONAL_TRBL_TYPE = 'diagonal_trbl';

    public function getHorizontalLineChecker(): LineChecker;
    public function getVerticalLineChecker(): LineChecker;
    public function getDiagonalTLBRLineChecker(): LineChecker;
    public function getDiagonalTRBLLineChecker(): LineChecker;
}
