<?php

namespace Game\Application\UseCases\Contracts;

use Game\Application\UseCases\Responses\Restart as Response;

interface Restart
{
    public function execute(): Response;
}
