<?php

namespace Game\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Game\Application\UseCases\Contracts\GetStatus;
use Game\Application\UseCases\GetStatus as GetStatusCase;
use Game\Application\UseCases\Contracts\SetPiece;
use Game\Application\UseCases\SetPiece as SetPieceCase;

final class UseCasesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GetStatus::class, GetStatusCase::class);
        $this->app->bind(SetPiece::class, SetPieceCase::class);
    }
}
