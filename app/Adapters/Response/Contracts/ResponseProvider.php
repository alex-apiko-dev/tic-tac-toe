<?php

namespace App\Adapters\Response\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface ResponseProvider
{
    public function json($data = null, int $code = 200): JsonResponse;

    public function getCollection($items, string $type, string $includes = null);

    public function getItem($item, string $type, string $includes = null);

    public function noContent();

    public function setArraySerializer(): void;
}
