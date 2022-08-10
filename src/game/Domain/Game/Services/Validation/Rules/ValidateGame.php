<?php

namespace Game\Domain\Game\Services\Validation\Rules;

use App\Adapters\Translator\Contracts\Translator;
use App\Exceptions\ResponseCodes;
use Game\Domain\Game\Game;
use Game\Domain\Game\Services\Validation\Contracts\ValidationRule;
use Game\Domain\Game\Services\Validation\Exceptions\GameNotFoundException;
use Game\Domain\Game\Structures\Coordinate;

final class ValidateGame implements ValidationRule
{
    private const NO_GAME_ERROR = 'errors.no_game';

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
        if (!$game) {
            throw new GameNotFoundException(
                $this->translator->translate($this->message ?? self::NO_GAME_ERROR),
                $this->code ?? ResponseCodes::NOT_FOUND_CODE
            );
        }

        return $this->next
            ? $this->next->validate($game, $piece, $coordinate)
            : true;
    }
}
