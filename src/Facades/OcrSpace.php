<?php

namespace Tdwesten\OcrSpace\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tdwesten\OcrSpace\OcrSpace
 *
 *  */
class OcrSpace extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Tdwesten\OcrSpace\OcrSpace::class;
    }
}
