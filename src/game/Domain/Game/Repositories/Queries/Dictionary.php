<?php

namespace Game\Domain\Game\Repositories\Queries;

use App\Repository\Common\Dictionary as CommonDictionary;

interface Dictionary extends CommonDictionary
{
    public const WHERE_NOT_FINISHED = 'not_finished';
    public const SORT_BY_CREATED_AT = 'order_created_at';
}
