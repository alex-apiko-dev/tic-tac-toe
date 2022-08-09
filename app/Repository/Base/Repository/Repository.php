<?php

namespace App\Repository\Base\Repository;

use App\Repository\Base\Query\Contracts\Query;
use App\Repository\Base\Query\Contracts\QueryApplicator;
use App\Repository\Base\Query\Contracts\QueryItem;
use App\Repository\Base\Query\QueryApplicatorFactory;
use App\Repository\Base\Repository\Contracts\Repository as Contract;
use App\Repository\Base\Repository\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Repository implements Contract
{
    private $queryBuilder;
    private $queryApplicatorFactory;
    /** @var QueryApplicator[] */
    private $queryApplicators = [];
    protected $model;
    protected $cascadeDelete = [];

    public function __construct(QueryApplicatorFactory $factory, Model $model)
    {
        if (!$this->isSatisfy($model)) {
            throw RepositoryException::incompatibleModel(get_class($$model), get_class($this));
        }

        $this->queryBuilder = $model->newQuery();
        $this->model = $model;
        $this->queryApplicatorFactory = $factory;
    }

    abstract protected function isSatisfy(Model $model): bool;

    public function all(): Collection
    {
        return $this->model->newQuery()->get();
    }

    public function find(Query $query): Collection
    {
        $this->buildQuery($query);

        return $this->queryBuilder->get();
    }

    private function buildQuery(Query $query): void
    {
        $this->refreshBuilder();
        $this->pushQueryApplicators($query);
        $this->apply();
    }

    private function refreshBuilder(): void
    {
        $this->queryBuilder = $this->model->newQuery();
        $this->queryApplicators = [];
    }

    private function pushQueryApplicators(Query $query): void
    {
        $queryItems = $query->getQueryItems();
        foreach ($queryItems as $queryItem) {
            $this->queryApplicators[] = $this->buildQueryApplicator($queryItem);
        }
    }

    private function buildQueryApplicator(QueryItem $queryItem): QueryApplicator
    {
        return $this->queryApplicatorFactory->buildQueryApplicator($queryItem->getAlias(), $queryItem->getValue());
    }

    private function apply(): void
    {
        foreach ($this->queryApplicators as $queryApplicator) {
            $this->queryBuilder = $queryApplicator->apply($this->queryBuilder);
        }
    }

    public function dumpFind(Query $query): void
    {
        $this->buildQuery($query);

        dump(
            $this->queryBuilder->toSql(),
            $this->queryBuilder->getBindings()
        );
    }

    public function findSingle(Query $object): ?Model
    {
        $results = $this->find($object);
        $first = $this->getFirstResult($results);

        return $first;
    }

    private function getFirstResult(Collection $results): ?Model
    {
        return $results->first();
    }

    public function findPaginated(Query $object, ?int $pageNumber = 1, ?int $pageSize = 15): LengthAwarePaginator
    {
        $this->refreshBuilder();
        $this->pushQueryApplicators($object);
        $this->apply();

        return $this->queryBuilder->paginate($pageSize, ['*'], 'page[number]', $pageNumber);
    }

    public function create(array $data): Model
    {
        $model = $this->model->newQuery()->create($data);
        $model->refresh();

        return $model;
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        $model->refresh();

        return $model;
    }

    public function delete(Model $model): void
    {
        foreach ($this->cascadeDelete as $relation) {
            $related = $model->{$relation}();
            $related->delete();
        }
        $model->delete();
    }

    public function save(Model $model, array $relations = []): Model
    {
        $model->save();

        return $model->refresh();
    }

    public function push(Model $model): Model
    {
        $model->push();

        return $model;
    }

    public function count(Query $query): int
    {
        $this->buildQuery($query);

        return $this->queryBuilder->count();
    }

    public function chunk(Query $query, int $count, \Closure $closure)
    {
        $this->buildQuery($query);

        return $this->queryBuilder->chunk($count, $closure);
    }

    public function pluck(Query $query, string $column): \Illuminate\Support\Collection
    {
        $this->buildQuery($query);

        return $this->queryBuilder->pluck($column);
    }

    public function getQueryBuilder(Query $query): Builder
    {
        $this->buildQuery($query);

        return $this->queryBuilder;
    }
}
