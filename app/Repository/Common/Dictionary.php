<?php

namespace App\Repository\Common;

interface Dictionary
{
    public const AND_APPLICATOR = 'and';
    public const OR_APPLICATOR = 'or';
    public const WITH_RELATION_APPLICATOR = 'with_relation';

    public const COMPOSITE_APPLICATORS = [
        self::AND_APPLICATOR,
        self::OR_APPLICATOR,
    ];
}
