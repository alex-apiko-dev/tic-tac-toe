<?php

namespace Game\Domain\Game\Repositories\Queries;

use App\Repository\Base\Query\Contracts\Query;
use App\Repository\Base\Query\Contracts\QueryItem;

final class LastGame implements Query
{
    public function getQueryItems(): array
    {
        return [
            new QueryItem(Dictionary::SORT_BY_CREATED_AT, 'desc'),
        ];
    }
}
