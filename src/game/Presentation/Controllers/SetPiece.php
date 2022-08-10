<?php

namespace Game\Presentation\Controllers;

use App\Http\Controller;
use Game\Application\UseCases\Contracts\SetPiece as SetPieceCase;
use Game\Application\UseCases\Requests\SetPiece as CaseRequest;
use Game\Presentation\Presenters\Contracts\Presenter;
use Game\Presentation\Requests\SetPiece as Request;
use Game\Presentation\Transformers\Types;

final class SetPiece extends Controller
{
    public function __construct(
        private SetPieceCase $case,
        private Presenter $response
    ) {
    }

    public function __invoke(string $piece, Request $request)
    {
        $response = $this->case->execute(
            $piece,
            new CaseRequest($request->validated())
        );

        return $this->response->getItem(
            $response->getGame(),
            Types::GAME_STATUS
        );
    }
}
