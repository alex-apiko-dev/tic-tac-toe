<?php

namespace App\Transformer;

use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\Serializer as SerializerAbstract;

final class CustomResourcesSerializer extends DataArraySerializer implements SerializerAbstract
{
    public function item(?string $resourceKey, array $data): array
    {
        return ($data);
    }
}
