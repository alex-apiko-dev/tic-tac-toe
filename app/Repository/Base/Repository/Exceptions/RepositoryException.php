<?php

namespace App\Repository\Base\Repository\Exceptions;

final class RepositoryException extends \Exception
{
    public static function incompatibleModel(string $model, string $repository): self
    {
        return new self(
            sprintf("Given model (%s) is not satisfy repository (%s)", $model, $repository)
        );
    }
}
