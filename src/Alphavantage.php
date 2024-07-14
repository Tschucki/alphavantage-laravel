<?php

namespace Tschucki\Alphavantage;

use Tschucki\Alphavantage\Resources\Core\Core;
use Tschucki\Alphavantage\Resources\Core\TimeSeries;
use Tschucki\Alphavantage\Resources\Fundamentals\Fundamentals;
use Tschucki\Alphavantage\Resources\Indicators\Indicators;
use Tschucki\Alphavantage\Resources\Intelligence\Intelligence;

class Alphavantage
{
    public static function fundamentals(): Fundamentals
    {
        return new Fundamentals();
    }

    public static function indicators(): Indicators
    {
        return new Indicators();
    }

    public static function timeSeries(): TimeSeries
    {
        return new TimeSeries();
    }

    public static function core(): Core
    {
        return new Core();
    }

    public static function intelligence(): Intelligence
    {
        return new Intelligence();
    }
}
