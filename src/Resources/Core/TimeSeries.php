<?php

namespace Tschucki\Alphavantage\Resources\Core;

use Illuminate\Http\Client\ConnectionException;
use Tschucki\Alphavantage\Concerns\InteractsWithAlphavantageApi;
use Tschucki\Alphavantage\Exceptions\ApiVolumeReached;

class TimeSeries
{
    use InteractsWithAlphavantageApi;

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function daily(string $symbol, string $outputSize = 'compact'): array
    {
        return $this->get('TIME_SERIES_DAILY', [
            'symbol' => $symbol,
            'outputsize' => $outputSize,
        ]);
    }

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function dailyAdjusted(string $symbol, string $outputSize = 'compact'): array
    {
        return $this->get('TIME_SERIES_DAILY_ADJUSTED', [
            'symbol' => $symbol,
            'outputsize' => $outputSize,
        ]);
    }

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function weekly(string $symbol): array
    {
        return $this->get('TIME_SERIES_WEEKLY', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function weeklyAdjusted(string $symbol, string $outputSize = 'compact'): array
    {
        return $this->get('TIME_SERIES_WEEKLY_ADJUSTED', [
            'symbol' => $symbol,
            'outputsize' => $outputSize,
        ]);
    }

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function monthly(string $symbol): array
    {
        return $this->get('TIME_SERIES_MONTHLY', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function monthlyAdjusted(string $symbol, string $outputSize = 'compact'): array
    {
        return $this->get('TIME_SERIES_MONTHLY_ADJUSTED', [
            'symbol' => $symbol,
            'outputsize' => $outputSize,
        ]);
    }
}
