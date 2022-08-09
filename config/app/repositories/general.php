<?php

use App\Repository\Base\Query\General\AndQueryApplicator as BaseAndQueryApplicator;
use App\Repository\Base\Query\General\OrQueryApplicator as BaseOrQueryApplicator;
use App\Repository\Base\Query\General\WithRelation as BaseWithRelation;
use App\Repository\Common\Dictionary;

return [
    Dictionary::AND_APPLICATOR => BaseAndQueryApplicator::class,
    Dictionary::OR_APPLICATOR => BaseOrQueryApplicator::class,
    Dictionary::WITH_RELATION_APPLICATOR => BaseWithRelation::class,
];
