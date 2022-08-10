<?php

namespace Game\Domain\Game\Structures;

final class Coordinate
{
    public function __construct(
        private int $x,
        private int $y
    ) {
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
