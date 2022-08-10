<?php

namespace App\Repository\Base\Query\Contracts;

interface CompositeQueryApplicator extends QueryApplicator
{
    public function getQueryItems(): array;
    public function addQueryApplicator(QueryApplicator $applicator);
}
