<?php

use Game\Domain\Game\Repositories\Queries\Dictionary;
use Game\Infrastructure\Repositories\Game\QueryApplicators\WhereNotFinished;
use Game\Infrastructure\Repositories\Game\QueryApplicators\OrderByCreatedAt;

return [
    Dictionary::WHERE_NOT_FINISHED => WhereNotFinished::class,
    Dictionary::SORT_BY_CREATED_AT => OrderByCreatedAt::class,
];
