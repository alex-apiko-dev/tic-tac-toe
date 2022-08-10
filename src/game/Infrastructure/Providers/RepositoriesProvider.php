<?php

namespace Game\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Game\Domain\Game\Repositories\GameRepository as GameRepositoryContract;
use Game\Infrastructure\Repositories\Game\GameRepository;

final class RepositoriesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GameRepositoryContract::class, GameRepository::class);
    }
}
