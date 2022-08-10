<?php

namespace Game\Application\UseCases;

use App\Adapters\DataBase\Contracts\DataBase;
use Game\Application\UseCases\Contracts\SetPiece as SetPieceContract;
use Game\Application\UseCases\Requests\SetPiece as Request;
use Game\Application\UseCases\Responses\SetPiece as Response;
use Game\Domain\Game\Game;
use Game\Domain\Game\Repositories\Queries\LastGame;
use Game\Domain\Game\Repositories\GameRepository;
use Game\Domain\Game\Services\Validation\Contracts\ValidationChainHandler;
use Game\Domain\Game\Services\GameRules\Contracts\BoardHandler;
use Game\Domain\Game\Structures\Coordinate;

final class SetPiece implements SetPieceContract
{
    public function __construct(
        private DataBase $dbAdapter,
        private GameRepository $repository,
        private ValidationChainHandler $validator,
        private BoardHandler $boardHandler
    ) {
    }

    public function execute(string $piece, Request $request): Response
    {
        $game = $this->getGameOrNull();
        $coordinate = new Coordinate($request->getX(), $request->getY());
        $this->validator->handle($game, $piece, $coordinate);
        try {
            $this->dbAdapter->beginTransaction();
            $game = $this->setPiece($game, $piece, $coordinate);
            $game = $this->handleBoardUpdates($game);
            $this->dbAdapter->commit();
        } catch (\Throwable $exception) {
            $this->dbAdapter->rollBack();
            throw $exception;
        }

        return new Response($game);
    }

    private function getGameOrNull(): ?Game
    {
        return $this->repository->findSingle(new LastGame());
    }

    private function setPiece(
        Game $game,
        string $piece,
        Coordinate $coordinate
    ): Game {
        $board = $game->getBoard();
        $board[$coordinate->getX()][$coordinate->getY()] = $piece;

        return $this->repository->update(
            $game,
            [
                Game::BOARD => $board,
                Game::CURRENT_TURN => data_get(Game::NEXT_TURN, $piece),
            ]
        );
    }

    private function handleBoardUpdates(Game $game): Game
    {
        $winner = $this->boardHandler->getWinnerOrNull($game);
        if ($winner) {
            $game = $this->repository->update(
                $game,
                [Game::VICTORY => $winner, ]
            );
        }

        return $game;
    }
}
