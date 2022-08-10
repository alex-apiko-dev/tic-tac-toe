<?php

namespace Game\Application\UseCases\Contracts;

use Game\Application\UseCases\Requests\SetPiece as Request;
use Game\Application\UseCases\Responses\SetPiece as Response;

interface SetPiece
{
    public function execute(string $piece, Request $request): Response;
}
