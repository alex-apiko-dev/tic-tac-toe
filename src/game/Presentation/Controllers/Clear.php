<?php

namespace Game\Presentation\Controllers;

use App\Http\Controller;
use Game\Application\UseCases\Contracts\Clear as ClearCase;
use Game\Presentation\Presenters\Contracts\Presenter;
use Game\Presentation\Transformers\Types;

final class Clear extends Controller
{
    public function __construct(
        private ClearCase $case,
        private Presenter $response
    ) {
    }

    public function __invoke()
    {
        $response = $this->case->execute();

        return $this->response->getItem(
            $response->getGame(),
            Types::CURRENT_TURN
        );
    }
}
