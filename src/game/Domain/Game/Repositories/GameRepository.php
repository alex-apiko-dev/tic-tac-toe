<?php

namespace Game\Domain\Game\Repositories;

use App\Repository\Base\Repository\Contracts\Repository;
use Game\Domain\Game\Game as EntityModel;

interface GameRepository extends Repository
{
    public function initNewGame(): EntityModel;
    public function resetBoard(EntityModel $model): EntityModel;
    public function resetVictory(EntityModel $model): EntityModel;
    public function resetScore(EntityModel $model): EntityModel;
    public function incrementFirstPlayerScore(EntityModel $model): EntityModel;
    public function incrementSecondPlayerScore(EntityModel $model): EntityModel;
}
