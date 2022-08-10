<?php

namespace Game\Presentation\Transformers;

use App\Transformer\Transformer;
use Game\Domain\Game\Game as Model;
use League\Fractal\Resource\Item;

final class CurrentTurn extends Transformer
{
    private const CURRENT_TURN = 'currentTurn';

    protected function proceed($model): array
    {
        return [
            self::CURRENT_TURN => $model->getCurrentTurn(),
        ];
    }

    protected function isSatisfy($model): bool
    {
        return $model instanceof Model;
    }
}
