<?php

namespace Game\Domain\Game\Repositories;

use App\Repository\Base\Repository\Contracts\Repository;
use Game\Domain\Game\Game as EntityModel;

interface GameRepository extends Repository
{
    public function initNewGame(): EntityModel;
}
