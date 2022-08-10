<?php

namespace App\Transformer\Contracts;

interface TransformerItem
{
    public function transform($model);
}
