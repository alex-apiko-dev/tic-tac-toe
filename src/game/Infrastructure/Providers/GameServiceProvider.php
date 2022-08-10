<?php

namespace Game\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Game\Domain\Game\Services\GameRules\Contracts\BoardHandler;
use Game\Domain\Game\Services\GameRules\BoardHandler as BoardHandlerImpl;
use Game\Domain\Game\Services\GameRules\LineChecker\Contracts\LineCheckerBuilder;
use Game\Domain\Game\Services\GameRules\LineChecker\LineCheckerBuilder as LineCheckerBuilderImpl;
use Game\Domain\Game\Services\Validation\Contracts\ValidationChainHandler;
use Game\Domain\Game\Services\Validation\ValidationChainHandler as ValidationChainHandlerImpl;
use Game\Presentation\Presenters\Contracts\Presenter;
use Game\Presentation\Presenters\ResponseProvider as PresenterImpl;

final class GameServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BoardHandler::class, BoardHandlerImpl::class);
        $this->app->bind(LineCheckerBuilder::class, LineCheckerBuilderImpl::class);
        $this->app->bind(ValidationChainHandler::class, ValidationChainHandlerImpl::class);
        $this->app->bind(Presenter::class, PresenterImpl::class);
    }
}
