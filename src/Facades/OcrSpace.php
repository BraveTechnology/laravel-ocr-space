<?php

namespace Tdwesten\OcrSpace\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tdwesten\OcrSpace\OcrSpace
 *
 *  */
class OcrSpace extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return \Tdwesten\OcrSpace\OcrSpace::class;
    }
}
