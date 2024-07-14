<?php

namespace Tschucki\Alphavantage\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tschucki\Alphavantage\Alphavantage
 */
class Alphavantage extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Tschucki\Alphavantage\Alphavantage::class;
    }
}
