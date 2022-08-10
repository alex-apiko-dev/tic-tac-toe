<?php

namespace Game\Domain\Game\Services\Validation;

use App\Adapters\Config\Contracts\Config;
use App\Adapters\Container\Contracts\Container;
use App\Adapters\Translator\Contracts\Translator;
use Game\Domain\Game\Game;
use Game\Domain\Game\Services\Validation\Contracts\ValidationChainHandler as Contract;
use Game\Domain\Game\Services\Validation\Contracts\ValidationRule;
use Game\Domain\Game\Structures\Coordinate;

final class ValidationChainHandler implements Contract
{
    private const CONFIG = 'game.validation.rules';

    private ValidationRule $validationRule;

    public function __construct(
        private Container $container,
        private Translator $translator,
        Config $config
    ) {
        $validationScenarioConfig = $config->get(self::CONFIG);
        $this->validationRule = $this->initRule($validationScenarioConfig);
    }

    public function handle(
        ?Game $game = null,
        string $piece,
        Coordinate $coordinate
    ): void {
        $this->validationRule->validate($game, $piece, $coordinate);
    }

    private function initRule(?array $validationScenario = null): ?ValidationRule
    {
        $rule = null;
        if (empty($validationScenario)) {
            return $rule;
        }

        $instanceName = data_get($validationScenario, ValidationRule::INSTANCE);
        if ($instanceName) {
            $nextRule = $this->initRule(data_get($validationScenario, ValidationRule::NEXT));
            $rule = $this->container->make(
                $instanceName,
                [
                    'translator' => $this->translator,
                    'message' => data_get($validationScenario, ValidationRule::ERROR_MESSAGE),
                    'code' => data_get($validationScenario, ValidationRule::ERROR_CODE),
                    'next' => $nextRule,
                ]
            );
        }

        return $rule;
    }
}
