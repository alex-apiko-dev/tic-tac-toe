<?php

namespace App\Transformer;

use App\Adapters\Config\Contracts\Config;
use App\Adapters\Container\Contracts\Container;
use App\Transformer\Contracts\TransformerItem;
use App\Transformer\Exceptions\TransformerBuildException;

abstract class TransformerFactory
{
    private $schema;

    public function __construct(
        private Container $container,
        private Config $configRepository
    ) {
        $this->schema = $this->getSchema();
    }

    abstract protected function getContext(): string;

    private function getSchema()
    {
        $configPath = $this->getContext();
        $schema = $this->configRepository->get($configPath);

        return $schema ?: [];
    }

    public function buildTransformer(string $alias): TransformerItem
    {
        try {
            return $this->proceedBuilding($alias);
        } catch (\Throwable $exception) {
            throw new TransformerBuildException(
                sprintf(
                    'Cannot build transformer by given alias - %s, %s',
                    $alias,
                    $exception->getMessage()
                )
            );
        }
    }

    private function proceedBuilding(string $alias)
    {
        return $this->getInstance($this->schema[$alias]);
    }

    private function getInstance(string $className): TransformerItem
    {
        return $this->container->make($className);
    }
}
