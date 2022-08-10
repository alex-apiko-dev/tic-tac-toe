<?php

namespace App\Adapters\Config\Contracts;

interface Config
{
    public function get(string $alias);
}
