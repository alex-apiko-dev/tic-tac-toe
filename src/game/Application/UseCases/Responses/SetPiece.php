<?php

namespace Game\Application\UseCases\Responses;

final class SetPiece
{
    public function __construct(
        private $game
    ) {
        $this->game = $game;
    }

    public function getGame()
    {
        return $this->game;
    }
}
