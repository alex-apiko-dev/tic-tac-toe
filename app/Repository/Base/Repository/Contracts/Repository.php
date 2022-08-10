<?php

namespace App\Repository\Base\Repository\Contracts;

use App\Repository\Base\Query\Contracts\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface Repository
{
    public const DEFAULT_PAGE_NUMBER = 1;
    public const DEFAULT_PAGE_SIZE = 15;

    public function all(): Collection;

    public function find(Query $query): Collection;

    public function dumpFind(Query $query): void;

    public function findSingle(Query $object): ?Model;

    public function findPaginated(
        Query $object,
        ?int $pageNumber = self::DEFAULT_PAGE_NUMBER,
        ?int $pageSize = self::DEFAULT_PAGE_SIZE
    ): LengthAwarePaginator;

    public function create(array $data): Model;

    public function update(Model $model, array $data): Model;

    public function delete(Model $model): void;

    public function save(Model $model, array $relations = []): Model;

    public function push(Model $model): Model;

    public function count(Query $query): int;

    public function chunk(Query $query, int $count, \Closure $closure);

    public function pluck(Query $query, string $column): \Illuminate\Support\Collection;

    public function getQueryBuilder(Query $query): Builder;
}
