<?php

namespace Tschucki\Alphavantage\Resources\Indicators;

use Illuminate\Http\Client\ConnectionException;
use Tschucki\Alphavantage\Concerns\InteractsWithAlphavantageApi;
use Tschucki\Alphavantage\Exceptions\ApiVolumeReached;

class Indicators
{
    use InteractsWithAlphavantageApi;

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    private function getIndicator(string $function, string $symbol, string $interval, int $timePeriod, string $seriesType, ?string $month = null, string $dataType = 'json'): array
    {
        if (! in_array($interval, ['1min', '5min', '15min', '30min', '60min', 'daily', 'weekly', 'monthly'])) {
            throw new \InvalidArgumentException("Invalid interval provided. Must be '1min', '5min', '15min', '30min', '60min', 'daily', 'weekly', 'monthly'");
        }
        if ($month && ! in_array($interval, ['1min', '5min', '15min', '30min', '60min'])) {
            throw new \InvalidArgumentException("Invalid interval provided. Must be '1min', '5min', '15min', '30min', '60min' for month parameter");
        }
        if (! in_array($seriesType, ['close', 'open', 'high', 'low'])) {
            throw new \InvalidArgumentException("Invalid series type provided. Must be one of: 'close', 'open', 'high', 'low'");
        }
        if (! in_array($dataType, ['json', 'csv'])) {
            throw new \InvalidArgumentException("Invalid data type provided. Must be 'json' or 'csv'");
        }

        $acceptJson = false;
        $acceptCsv = false;
        if ($dataType === 'json') {
            $acceptJson = true;
        }
        if ($dataType === 'csv') {
            $acceptCsv = true;
        }

        return $this->get($function, [
            'symbol' => $symbol,
            'interval' => $interval,
            'month' => $month,
            'time_period' => $timePeriod,
            'series_type' => $seriesType,
            //TODO: Enable with correct API Token
            //'datatype' => $dataType
        ], acceptJson: $acceptJson, acceptCsv: $acceptCsv);
    }

    /**
     * Simple Moving Average (SMA)
     *
     * @throws ConnectionException|ApiVolumeReached
     */
    public function sma(string $symbol, string $interval, int $timePeriod, string $seriesType, ?string $month = null, string $dataType = 'json'): array
    {
        return $this->getIndicator(
            'SMA',
            $symbol,
            $interval,
            $timePeriod,
            $seriesType,
            $month,
            $dataType
        );
    }
}
