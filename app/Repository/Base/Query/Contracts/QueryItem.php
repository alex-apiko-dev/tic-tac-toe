<?php

namespace App\Repository\Base\Query\Contracts;

final class QueryItem
{
    public function __construct(
        private string $alias,
        private $value = null
    ) {
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getValue()
    {
        return $this->value;
    }
}
