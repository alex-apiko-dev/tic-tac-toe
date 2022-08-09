<?php

namespace Game\Infrastructure\Repositories\Game;

use App\Repository\Base\Query\QueryApplicatorFactory as BaseQueryApplicatorFactory;

final class QueryApplicatorFactory extends BaseQueryApplicatorFactory
{
    public const CONTEXT = 'game.repositories.game';

    protected function getContext(): string
    {
        return self::CONTEXT;
    }
}
