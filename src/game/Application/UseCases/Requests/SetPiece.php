<?php

namespace Game\Application\UseCases\Requests;

final class SetPiece
{
    public const X = 'x';
    public const Y = 'y';

    private int $x;
    private int $y;

    public function __construct(
        array $data
    ) {
        $this->x = data_get($data, self::X) ?? -1;
        $this->y = data_get($data, self::Y) ?? -1;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}
