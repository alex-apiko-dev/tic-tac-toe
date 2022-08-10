<?php

namespace Game\Application\UseCases\Responses;

final class Restart
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
