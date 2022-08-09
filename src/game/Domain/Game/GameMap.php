<?php

namespace Game\Domain\Game;

interface GameMap
{
    public const BOARD_SIZE = 3;

    public const FIRST_PLAYER_SIGN = 'x';
    public const SECOND_PLAYER_SIGN = 'o';
    public const EMPTY_SIGN = '';
}
