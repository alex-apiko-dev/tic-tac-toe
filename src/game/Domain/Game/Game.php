<?php

namespace Game\Domain\Game;

use Illuminate\Database\Eloquent\Model;

class Game extends Model implements GameMap
{
    public const TABLE_NAME = 'games';

    public const KEY = 'id';
    public const BOARD = 'board';
    public const FIRST_PLAYER_SCORE = 'first_player_score';
    public const SECOND_PLAYER_SCORE = 'second_player_score';
    public const CURRENT_TURN = 'currentTurn';
    public const VICTORY = 'victory';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::BOARD,
        self::FIRST_PLAYER_SCORE,
        self::SECOND_PLAYER_SCORE,
        self::CURRENT_TURN,
        self::VICTORY,
    ];

    protected $casts = [
        self::BOARD => 'array',
    ];

    public function getBoard(): array
    {
        return $this->getAttribute(self::BOARD);
    }

    public function getFirstPlayerScore(): int
    {
        return (int)$this->getAttribute(self::FIRST_PLAYER_SCORE);
    }

    public function getSecondPlayerScore(): int
    {
        return (int)$this->getAttribute(self::SECOND_PLAYER_SCORE);
    }

    public function getCurrentTurn(): string
    {
        return $this->getAttribute(self::CURRENT_TURN);
    }

    public function getVictory(): ?string
    {
        return $this->getAttribute(self::VICTORY);
    }
}
