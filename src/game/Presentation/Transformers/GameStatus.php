<?php

namespace Game\Presentation\Transformers;

use App\Transformer\Transformer;
use Game\Domain\Game\Game as Model;

final class GameStatus extends Transformer
{
    private const BOARD = 'board';
    private const SCORE = 'score';
    private const CURRENT_TURN = 'currentTurn';
    private const VICTORY = 'victory';

    protected function proceed($model): array
    {
        return [
            self::BOARD => $model->getBoard(),
            self::SCORE => [
                Model::FIRST_PLAYER_SIGN => $model->getFirstPlayerScore(),
                Model::SECOND_PLAYER_SIGN => $model->getSecondPlayerScore(),
            ],
            self::CURRENT_TURN => $model->getCurrentTurn(),
            self::VICTORY => $model->getVictory() ?? '',
        ];
    }

    protected function isSatisfy($model): bool
    {
        return $model instanceof Model;
    }
}
