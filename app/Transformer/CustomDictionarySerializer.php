<?php

namespace App\Transformer;

use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\Serializer as SerializerAbstract;

final class CustomDictionarySerializer extends DataArraySerializer implements SerializerAbstract
{
    public function collection(?string $resourceKey, array $data): array
    {
        return $data;
    }

    public function item(?string $resourceKey, array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[] = [$key => $value];
        }

        return $result;
    }
}
