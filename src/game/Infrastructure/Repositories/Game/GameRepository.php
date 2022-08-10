<?php

namespace Game\Infrastructure\Repositories\Game;

use App\Repository\Base\Repository\Repository;
use Illuminate\Database\Eloquent\Model;
use Game\Domain\Game\Repositories\GameRepository as Contract;
use Game\Domain\Game\Game as EntityModel;
use Game\Infrastructure\Services\Generators\BoardGenerator;

final class GameRepository extends Repository implements Contract
{
    public function __construct(
        QueryApplicatorFactory $factory,
        EntityModel $model
    ) {
        parent::__construct($factory, $model);
    }

    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof EntityModel;
    }

    public function initNewGame(): EntityModel
    {
        $board = BoardGenerator::generateEmptyBoard(EntityModel::BOARD_SIZE);
        $game = $this->model
            ->newQuery()
            ->create([EntityModel::BOARD => $board, ]);

        return $game->fresh();
    }

    public function resetBoard(EntityModel $model): EntityModel
    {
        $board = BoardGenerator::generateEmptyBoard(EntityModel::BOARD_SIZE);
        $game = $this->update(
            $model,
            [
                EntityModel::BOARD => $board,
                EntityModel::CURRENT_TURN => EntityModel::FIRST_PLAYER_SIGN,
            ]
        );

        return $game->fresh();
    }

    public function resetVictory(EntityModel $model): EntityModel
    {
        $game = $this->update($model, [EntityModel::VICTORY => null, ]);

        return $game->fresh();
    }

    public function resetScore(EntityModel $model): EntityModel
    {
        $game = $this->update(
            $model,
            [
                EntityModel::FIRST_PLAYER_SCORE => 0,
                EntityModel::SECOND_PLAYER_SCORE => 0,
            ]
        );

        return $game->fresh();
    }

    public function incrementFirstPlayerScore(EntityModel $model): EntityModel
    {
        $score = $model->getFirstPlayerScore();
        $game = $this->update(
            $model,
            [EntityModel::FIRST_PLAYER_SCORE => ($score + 1), ]
        );

        return $game->fresh();
    }

    public function incrementSecondPlayerScore(EntityModel $model): EntityModel
    {
        $score = $model->getSecondPlayerScore();
        $game = $this->update(
            $model,
            [EntityModel::SECOND_PLAYER_SCORE => ($score + 1), ]
        );

        return $game->fresh();
    }
}
