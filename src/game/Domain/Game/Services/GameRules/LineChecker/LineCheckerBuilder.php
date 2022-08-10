<?php

namespace Game\Domain\Game\Services\GameRules\LineChecker;

use App\Adapters\Config\Contracts\Config;
use App\Adapters\Container\Contracts\Container;
use App\Adapters\Translator\Contracts\Translator;
use Game\Domain\Game\Services\GameRules\LineChecker\Contracts\LineCheckerBuilder as Contract;
use Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\Contracts\LineChecker;

final class LineCheckerBuilder implements Contract
{
    private const CONFIG = 'game.checkers.types';

    private array $config;

    public function __construct(
        private Container $container,
        private Translator $translator,
        Config $config
    ) {
        $this->config = $config->get(self::CONFIG) ?? [];
    }

    public function getHorizontalLineChecker(): LineChecker
    {
        return $this->buildCheckerByType(Contract::HORIZONTAL_TYPE);
    }

    public function getVerticalLineChecker(): LineChecker
    {
        return $this->buildCheckerByType(Contract::VERTICAL_TYPE);
    }

    public function getDiagonalTLBRLineChecker(): LineChecker
    {
        return $this->buildCheckerByType(Contract::DIAGONAL_TLBR_TYPE);
    }

    public function getDiagonalTRBLLineChecker(): LineChecker
    {
        return $this->buildCheckerByType(Contract::DIAGONAL_TRBL_TYPE);
    }

    private function buildCheckerByType(string $type): LineChecker
    {
        try {
            return $this->buildInstance($this->getClassName($type));
        } catch (\Throwable $exception) {
            throw new \Exception(
                $this->translator->translate('Cannot build line checker.')
            );
        }
    }

    private function getClassName(string $type): string
    {
        return $this->config[$type];
    }

    private function buildInstance(string $className): LineChecker
    {
        return $this->container->make($className);
    }
}
