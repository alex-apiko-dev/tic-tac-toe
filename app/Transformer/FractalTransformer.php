<?php

namespace App\Transformer;

use App\Transformer\Contracts\Transformer as TransformerInterface;
use App\Transformer\Contracts\TransformerItem;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;

class FractalTransformer implements TransformerInterface
{
    public function __construct(
        private Manager $manager
    ) {
        $this->manager->setSerializer(new CustomResourcesSerializer());
    }

    public function transformItem($item, TransformerItem $transformer, $resourceKey)
    {
        return new Item($item, $transformer, $resourceKey);
    }

    public function transformCollection(
        $collection,
        TransformerItem $transformer,
        $resourceKey
    ) {
        $resources = new Collection($collection, $transformer, $resourceKey);
        if ($collection instanceof LengthAwarePaginator) {
            $resources->setPaginator(new IlluminatePaginatorAdapter($collection));
        }

        return $resources;
    }

    public function createData($data, string $includes = null): array
    {
        if ($includes) {
            $this->manager->parseIncludes($includes);
        }

        return $this->manager->createData($data)->toArray();
    }

    public function setDictionarySerializer(): void
    {
        $this->manager->setSerializer(new CustomDictionarySerializer());
    }
}
