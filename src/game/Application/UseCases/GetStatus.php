<?php

namespace Game\Application\UseCases;

use Game\Application\UseCases\Contracts\GetStatus as GetStatusContract;
use Game\Application\UseCases\Responses\GetStatus as Response;
use Game\Domain\Game\Game;
use Game\Domain\Game\Repositories\Queries\LastGame;
use Game\Domain\Game\Repositories\GameRepository;

final class GetStatus implements GetStatusContract
{
    public function __construct(
        private GameRepository $repository
    ) {
    }

    public function execute(): Response
    {
        return new Response($this->resolveGame());
    }

    private function resolveGame(): Game
    {
        $game = $this->repository->findSingle(new LastGame());
        if (!$game) {
            $game = $this->repository->initNewGame();
        }

        return $game;
    }
}
