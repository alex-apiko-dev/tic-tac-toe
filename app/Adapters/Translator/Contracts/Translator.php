<?php

namespace App\Adapters\Translator\Contracts;

interface Translator
{
    public function translate(
        $key,
        array $replace = [],
        $locale = null,
        $fallback = true
    ): string;
}
