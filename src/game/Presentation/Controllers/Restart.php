<?php

namespace Game\Presentation\Controllers;

use App\Http\Controller;
use Game\Application\UseCases\Contracts\Restart as RestartCase;
use Game\Presentation\Presenters\Contracts\Presenter;
use Game\Presentation\Transformers\Types;

final class Restart extends Controller
{
    public function __construct(
        private RestartCase $case,
        private Presenter $response
    ) {
    }

    public function __invoke()
    {
        $response = $this->case->execute();

        return $this->response->getItem(
            $response->getGame(),
            Types::GAME_STATUS
        );
    }
}
