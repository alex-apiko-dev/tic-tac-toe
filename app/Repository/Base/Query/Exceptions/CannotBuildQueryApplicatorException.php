<?php

namespace App\Repository\Base\Query\Exceptions;

final class CannotBuildQueryApplicatorException extends \Exception
{
    public static function wrongAlias(string $alias, $message): self
    {
        return new self(
            sprintf(
                'Cannot build query applicator by given alias - %s, %s',
                $alias,
                $message
            )
        );
    }
}
