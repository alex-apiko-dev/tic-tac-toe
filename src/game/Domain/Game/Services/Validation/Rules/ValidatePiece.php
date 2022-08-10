<?php

namespace Game\Domain\Game\Services\Validation\Rules;

use App\Adapters\Translator\Contracts\Translator;
use App\Exceptions\ResponseCodes;
use Game\Domain\Game\Game;
use Game\Domain\Game\GameMap;
use Game\Domain\Game\Services\Validation\Contracts\ValidationRule;
use Game\Domain\Game\Services\Validation\Exceptions\OutOfTurnException;
use Game\Domain\Game\Structures\Coordinate;

final class ValidatePiece implements ValidationRule
{
    private const OUT_OF_TURN_ERROR = 'errors.out_of_turn';
    private const CORRECT_PIECE_VALUES = [
        GameMap::FIRST_PLAYER_SIGN,
        GameMap::SECOND_PLAYER_SIGN,
    ];

    public function __construct(
        private Translator $translator,
        private ?string $message,
        private ?string $code,
        private ?ValidationRule $next
    ) {
    }

    public function validate(
        ?Game $game = null,
        string $piece,
        Coordinate $coordinate
    ): bool {
        $isCorrectPieceValue = in_array($piece, self::CORRECT_PIECE_VALUES);
        if (!$isCorrectPieceValue || $game->getCurrentTurn() !== $piece) {
            throw new OutOfTurnException(
                $this->translator->translate($this->message ?? self::OUT_OF_TURN_ERROR),
                $this->code ?? ResponseCodes::NOT_ACCEPTABLE_CODE
            );
        }

        return $this->next
            ? $this->next->validate($game, $piece, $coordinate)
            : true;
    }
}
