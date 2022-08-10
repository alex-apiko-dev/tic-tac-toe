<?php

namespace App\Transformer;

use App\Transformer\Contracts\TransformerItem;
use App\Transformer\Exceptions\NotAllowedModelTransformingException;
use League\Fractal\TransformerAbstract;

abstract class Transformer extends TransformerAbstract implements TransformerItem
{
    public function transform($model)
    {
        if ($this->isSatisfy($model)) {
            return $this->proceed($model);
        }

        throw new NotAllowedModelTransformingException();
    }

    abstract protected function proceed($model);
    abstract protected function isSatisfy($model): bool;
}
