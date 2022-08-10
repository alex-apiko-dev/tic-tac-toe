<?php

namespace App\Repository\Base\Query\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface QueryApplicator
{
    public function apply(Builder $query): Builder;
}
