<?php

namespace Game\Presentation\Presenters;

final class TransformerFactory extends \App\Transformer\TransformerFactory
{
    private const RESPONSES_TRANSFORMERS = 'game.responses.transformers';

    protected function getContext(): string
    {
        return self::RESPONSES_TRANSFORMERS;
    }
}
