<?php

namespace Game\Presentation\Presenters;

use App\Adapters\Response\ResponseProvider as AppResponseProvider;
use App\Transformer\Contracts\Transformer;
use Illuminate\Routing\ResponseFactory;
use Game\Presentation\Presenters\Contracts\Presenter;

final class ResponseProvider extends AppResponseProvider implements Presenter
{
    public function __construct(
        ResponseFactory $responseFactory,
        Transformer $transformer,
        TransformerFactory $factory
    ) {
        parent::__construct($responseFactory, $transformer, $factory);
    }
}
