<?php

namespace App\Repository\Base\Query;

use App\Adapters\Config\Contracts\Config;
use App\Repository\Base\Query\Contracts\CompositeQueryApplicator;
use App\Repository\Base\Query\Contracts\QueryApplicator;
use App\Repository\Base\Query\Exceptions\CannotBuildQueryApplicatorException;

abstract class QueryApplicatorFactory
{
    private const APP_REPOSITORIES_GENERAL = 'app.repositories.general';

    private $schema;

    public function __construct(
        private Config $config
    ) {
        $this->schema = $this->getSchema();
    }

    private function getSchema(): array
    {
        $generalCriteriaConfigPath = self::APP_REPOSITORIES_GENERAL;
        $customCriteriaConfigPath = $this->getContext();
        $generalCriteriaSchema = $this->config->get($generalCriteriaConfigPath) ?? [];
        $customCriteriaSchema = $this->config->get($customCriteriaConfigPath) ?? [];
        $schema = array_merge($generalCriteriaSchema, $customCriteriaSchema);

        return $schema;
    }

    abstract protected function getContext(): string;

    public function buildQueryApplicator(string $alias, $value): QueryApplicator
    {
        try {
            $builtApplicator = $this->proceedBuilding($alias, $value);
            if ($builtApplicator instanceof CompositeQueryApplicator) {
                $builtApplicator = $this->fillComposite($builtApplicator);
            }

            return $builtApplicator;
        } catch (\Throwable $exception) {
            throw CannotBuildQueryApplicatorException::wrongAlias(
                $alias,
                $exception->getMessage()
            );
        }
    }

    private function proceedBuilding(string $alias, $value): QueryApplicator
    {
        return $this->getInstance($this->schema[$alias], $value);
    }

    private function getInstance(string $className, $value): QueryApplicator
    {
        return new $className($value);
    }

    private function fillComposite(
        CompositeQueryApplicator $compositeQueryApplicator
    ): CompositeQueryApplicator {
        $queryItems = $compositeQueryApplicator->getQueryItems();
        foreach ($queryItems as $queryItem) {
            $queryApplicator = $this->buildQueryApplicator(
                $queryItem->getAlias(),
                $queryItem->getValue()
            );
            $compositeQueryApplicator->addQueryApplicator($queryApplicator);
        }

        return $compositeQueryApplicator;
    }
}
