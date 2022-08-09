<?php

namespace App\Repository\Base\Query\General;

use App\Repository\Base\Query\Contracts\QueryApplicator;
use Illuminate\Database\Eloquent\Builder;

final class WithRelation implements QueryApplicator
{
    public function __construct(
        private array $relations
    ) {
    }

    public function apply(Builder $query): Builder
    {
        return $query->with($this->relations);
    }
}
