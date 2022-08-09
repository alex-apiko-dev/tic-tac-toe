<?php

namespace Game\Application\UseCases\Contracts;

use Game\Application\UseCases\Responses\GetStatus as Response;

interface GetStatus
{
    public function execute(): Response;
}
