<?php

namespace Game\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Game\Application\UseCases\Contracts\GetStatus;
use Game\Application\UseCases\GetStatus as GetStatusCase;

final class UseCasesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GetStatus::class, GetStatusCase::class);
    }
}
