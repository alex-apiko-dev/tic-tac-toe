<?php

use Game\Presentation\Transformers\CurrentTurn;
use Game\Presentation\Transformers\GameStatus;
use Game\Presentation\Transformers\Types;

return [
    Types::CURRENT_TURN => CurrentTurn::class,
    Types::GAME_STATUS => GameStatus::class,
];
