<?php

namespace Game\Application\UseCases\Contracts;

use Game\Application\UseCases\Responses\Clear as Response;

interface Clear
{
    public function execute(): Response;
}
