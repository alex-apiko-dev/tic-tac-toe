<?php

namespace Game\Domain\Game\Services\GameRules;

use Game\Domain\Game\Game;
use Game\Domain\Game\Services\GameRules\Contracts\BoardHandler as Contract;
use Game\Domain\Game\Services\GameRules\LineChecker\Contracts\LineCheckerBuilder;

final class BoardHandler implements Contract
{
    public function __construct(
        private LineCheckerBuilder $lineCheckBuilder
    ) {
    }

    public function getWinnerOrNull(Game $game): ?string
    {
        return $this->checkBoard($game->getBoard());
    }

    private function checkBoard(array $board): ?string
    {
        if ($this->checkIsDraw($board)) {
            return Game::FINISHED;
        }

        $state = null;
        foreach ([Game::FIRST_PLAYER_SIGN, Game::SECOND_PLAYER_SIGN, ] as $playerSign) {
            if ($this->isHasHorizontalLine($playerSign, $board)) {
                $state = $playerSign;
                break;
            }
            if ($this->isHasVerticalLine($playerSign, $board)) {
                $state = $playerSign;
                break;
            }
            if ($this->isHasTLBRDiagonal($playerSign, $board)) {
                $state = $playerSign;
                break;
            }
            if ($this->isHasTRBLDiagonal($playerSign, $board)) {
                $state = $playerSign;
                break;
            }
        }

        return $state;
    }

    private function checkIsDraw(array $board): bool
    {
        $emptyCellCount = 0;
        foreach ($board as $line) {
            foreach ($line as $item) {
                if ($item === Game::EMPTY_SIGN) {
                    $emptyCellCount++;
                }
            }
        }

        return ($emptyCellCount === 0);
    }

    private function isHasHorizontalLine(
        string $playerSign,
        array $board
    ): bool {
        return $this->lineCheckBuilder
            ->getHorizontalLineChecker()
            ->isHasLine($playerSign, $board);
    }

    private function isHasVerticalLine(
        string $playerSign,
        array $board
    ): bool {
        return $this->lineCheckBuilder
            ->getVerticalLineChecker()
            ->isHasLine($playerSign, $board);
    }

    private function isHasTLBRDiagonal(
        string $playerSign,
        array $board
    ): bool {
        return $this->lineCheckBuilder
            ->getDiagonalTLBRLineChecker()
            ->isHasLine($playerSign, $board);
    }

    private function isHasTRBLDiagonal(
        string $playerSign,
        array $board
    ): bool {
        return $this->lineCheckBuilder
            ->getDiagonalTRBLLineChecker()
            ->isHasLine($playerSign, $board);
    }
}
