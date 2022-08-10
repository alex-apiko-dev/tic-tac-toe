<?php

namespace Game\Application\UseCases;

use App\Adapters\DataBase\Contracts\DataBase;
use App\Exceptions\Custom\ResourceNotFoundException;
use Game\Application\UseCases\Contracts\Clear as ClearContract;
use Game\Application\UseCases\Responses\Clear as Response;
use Game\Domain\Game\Game;
use Game\Domain\Game\Repositories\Queries\LastGame;
use Game\Domain\Game\Repositories\GameRepository;

final class Clear implements ClearContract
{
    public function __construct(
        private DataBase $dbAdapter,
        private GameRepository $repository
    ) {
    }

    public function execute(): Response
    {
        $game = $this->getGame();
        try {
            $this->dbAdapter->beginTransaction();
            $game = $this->repository->resetVictory($game);
            $game = $this->repository->resetScore($game);
            $game = $this->repository->resetBoard($game);
            $this->dbAdapter->commit();
        } catch (\Throwable $exception) {
            $this->dbAdapter->rollBack();
            throw $exception;
        }

        return new Response($game);
    }

    private function getGame(): Game
    {
        $game = $this->repository->findSingle(new LastGame());
        if (!$game) {
            throw new ResourceNotFoundException();
        }

        return $game;
    }
}
