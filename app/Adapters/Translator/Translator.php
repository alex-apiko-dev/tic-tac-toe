<?php

namespace App\Adapters\Translator;

use App\Adapters\Translator\Contracts\Translator as Contract;
use Illuminate\Translation\Translator as LaravelTranslator;

final class Translator implements Contract
{
    public function __construct(
        private LaravelTranslator $translator
    ) {
    }

    public function translate(
        $key,
        array $replace = [],
        $locale = null,
        $fallback = true
    ): string {
        return $this->translator->get($key, $replace, $locale, $fallback);
    }
}
