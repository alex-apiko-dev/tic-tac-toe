<?php

use App\Exceptions\ResponseCodes;
use Game\Domain\Game\Services\Validation\Contracts\ValidationRule;
use Game\Domain\Game\Services\Validation\Rules\{
    ValidateCoordinates,
    ValidateGame,
    ValidatePiece
};

return [
    ValidationRule::INSTANCE => ValidateGame::class,
    ValidationRule::ERROR_MESSAGE => 'errors.no_game',
    ValidationRule::ERROR_CODE => ResponseCodes::NOT_FOUND_CODE,
    ValidationRule::NEXT => [
        ValidationRule::INSTANCE => ValidatePiece::class,
        ValidationRule::ERROR_MESSAGE => 'errors.out_of_turn',
        ValidationRule::ERROR_CODE => ResponseCodes::NOT_ACCEPTABLE_CODE,
        ValidationRule::NEXT => [
            ValidationRule::INSTANCE => ValidateCoordinates::class,
            ValidationRule::ERROR_MESSAGE => 'errors.invalid_coordinates',
            ValidationRule::ERROR_CODE => ResponseCodes::CONFLICT_CODE,
            ValidationRule::NEXT => null,
        ],
    ],
];
