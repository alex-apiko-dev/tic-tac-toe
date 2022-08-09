<?php

namespace Game\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Game\Presentation\Presenters\Contracts\Presenter;
use Game\Presentation\Presenters\ResponseProvider as PresenterImpl;

final class GameServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Presenter::class, PresenterImpl::class);
    }
}
