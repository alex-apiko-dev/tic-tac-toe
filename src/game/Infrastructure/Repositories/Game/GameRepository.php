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
}
