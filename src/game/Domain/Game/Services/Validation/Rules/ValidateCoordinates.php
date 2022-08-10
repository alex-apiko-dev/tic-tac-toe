<?php

namespace Game\Domain\Game\Services\Validation\Rules;

use App\Adapters\Translator\Contracts\Translator;
use App\Exceptions\ResponseCodes;
use Game\Domain\Game\Game;
use Game\Domain\Game\GameMap;
use Game\Domain\Game\Services\Validation\Contracts\ValidationRule;
use Game\Domain\Game\Services\Validation\Exceptions\InvalidCoordinatesException;
use Game\Domain\Game\Structures\Coordinate;

final class ValidateCoordinates implements ValidationRule
{
    private const INVALID_COORDINATES_ERROR = 'errors.invalid_coordinates';

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
        $boardPiece = $game->getBoard()[$coordinate->getX()][$coordinate->getY()];
        if ($boardPiece !== GameMap::EMPTY_SIGN) {
            throw new InvalidCoordinatesException(
                $this->translator->translate($this->message ?? self::INVALID_COORDINATES_ERROR),
                $this->code ?? ResponseCodes::CONFLICT_CODE
            );
        }

        return $this->next
            ? $this->next->validate($game, $piece, $coordinate)
            : true;
    }
}
