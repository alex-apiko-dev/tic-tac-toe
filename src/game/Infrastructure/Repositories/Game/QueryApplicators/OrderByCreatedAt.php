<?php

namespace Game\Infrastructure\Repositories\Game\QueryApplicators;

use App\Repository\Base\Query\Contracts\QueryApplicator;
use Illuminate\Database\Eloquent\Builder;
use Game\Domain\Game\Game;

final class OrderByCreatedAt implements QueryApplicator
{
    public function __construct(
        private string $direction
    ) {
    }

    public function apply(Builder $query): Builder
    {
        return $query->orderBy(
            sprintf('%s.%s', Game::TABLE_NAME, Game::CREATED_AT),
            $this->direction
        );
    }
}
