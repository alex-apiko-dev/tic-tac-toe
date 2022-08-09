<?php

namespace App\Repository\Base\Query\General;

use App\Repository\Base\Query\Contracts\CompositeQueryApplicator;
use Illuminate\Database\Eloquent\Builder;

final class OrQueryApplicator extends BaseApplicator implements CompositeQueryApplicator
{
    public function apply(Builder $query): Builder
    {
        $query->where(function (Builder $query) {
            foreach ($this->queryApplicators as $applicator) {
                $query->orWhere(function (Builder $query) use ($applicator) {
                    $applicator->apply($query);
                });
            }
        });

        return $query;
    }
}
