<?php

namespace App\Adapters\Config;

use App\Adapters\Config\Contracts\Config as ConfigInterface;
use Illuminate\Contracts\Config\Repository as LaravelConfig;

final class Config implements ConfigInterface
{
    public function __construct(
        private LaravelConfig $config
    ) {
    }

    public function get(string $alias)
    {
        return $this->config->get($alias);
    }
}
