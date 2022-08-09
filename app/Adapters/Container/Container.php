<?php

namespace App\Adapters\Container;

use App\Adapters\Container\Contracts\Container as ContainerInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container as LaravelContainer;

final class Container implements ContainerInterface
{
    public function __construct(
        private LaravelContainer $container
    ) {
    }

    public function make(string $className, array $parameters = [])
    {
        return $this->container->make($className, $parameters);
    }
}
