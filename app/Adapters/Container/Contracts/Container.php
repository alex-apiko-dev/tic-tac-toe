<?php

namespace App\Adapters\Container\Contracts;

interface Container
{
    public function make(string $className, array $parameters = []);
}
