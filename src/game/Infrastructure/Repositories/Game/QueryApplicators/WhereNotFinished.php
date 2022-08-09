<?php

namespace Game\Infrastructure\Repositories\Game\QueryApplicators;

use App\Repository\Base\Query\Contracts\QueryApplicator;
use Illuminate\Database\Eloquent\Builder;
use Game\Domain\Game\Game;

final class WhereNotFinished implements QueryApplicator
{
    public function __construct(
        private $value
    ) {
    }

    public function apply(Builder $query): Builder
    {
        return $query->whereNull(sprintf('%s.%s', Game::TABLE_NAME, Game::VICTORY));
    }
}
