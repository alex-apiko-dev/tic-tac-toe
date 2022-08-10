<?php

namespace App\Repository\Base\Query\General;

use App\Repository\Base\Query\Contracts\CompositeQueryApplicator;
use Illuminate\Database\Eloquent\Builder;

final class AndQueryApplicator extends BaseApplicator implements CompositeQueryApplicator
{
    public function apply(Builder $query): Builder
    {
        foreach ($this->queryApplicators as $applicator) {
            $query = $applicator->apply($query);
        }

        $query->where(function (Builder $query) {
            return $query;
        });

        return $query;
    }
}
