<?php

namespace Game\Application\UseCases;

use App\Adapters\DataBase\Contracts\DataBase;
use App\Exceptions\Custom\ResourceNotFoundException;
use Game\Application\UseCases\Contracts\Restart as RestartContract;
use Game\Application\UseCases\Responses\Restart as Response;
use Game\Domain\Game\Game;
use Game\Domain\Game\Repositories\Queries\LastGame;
use Game\Domain\Game\Repositories\GameRepository;

final class Restart implements RestartContract
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
            $game = $this->handleScore($game);
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

    private function handleScore(Game $game): Game
    {
        $victory = $game->getVictory();
        if (!empty($victory)) {
            $game = $this->repository->resetVictory($game);
            switch ($victory) {
                case Game::FIRST_PLAYER_SIGN:
                    $game = $this->repository->incrementFirstPlayerScore($game);
                    break;
                case Game::SECOND_PLAYER_SIGN:
                    $game = $this->repository->incrementSecondPlayerScore($game);
                    break;
            }
        }

        return $game;
    }
}
