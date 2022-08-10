<?php

namespace App\Repository\Base\Query\General;

use App\Repository\Base\Query\Contracts\CompositeQueryApplicator;
use App\Repository\Base\Query\Contracts\QueryApplicator;
use App\Repository\Base\Query\Contracts\QueryItem;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseApplicator implements CompositeQueryApplicator
{
    protected array $queryItems;
    protected array $queryApplicators = [];

    public function __construct(array $queryApplicators)
    {
        if (!$this->isValidValues($queryApplicators)) {
            throw new \Exception(sprintf('Invalid values in %s.', self::class));
        }

        $this->queryItems = $queryApplicators;
    }

    private function isValidValues(array $value): bool
    {
        return empty(array_filter($value, function ($value) {
            return !$value instanceof QueryItem;
        }));
    }

    public function getQueryItems(): array
    {
        return $this->queryItems;
    }

    public function addQueryApplicator(QueryApplicator $applicator): void
    {
        $this->queryApplicators[] = $applicator;
    }

    abstract public function apply(Builder $query): Builder;
}
