<?php

namespace App\Transformer\Contracts;

interface Transformer
{
    public function createData($data, string $includes = null): array;
    public function transformItem($item, TransformerItem $transformer, $resourceKey);
    public function transformCollection($collection, TransformerItem $transformer, $resourceKey);
    public function setDictionarySerializer(): void;
}
