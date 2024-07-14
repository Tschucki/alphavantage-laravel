<?php

namespace Tschucki\Alphavantage\Resources\Intelligence;

use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Tschucki\Alphavantage\Concerns\InteractsWithAlphavantageApi;
use Tschucki\Alphavantage\Exceptions\ApiVolumeReached;

class Intelligence
{
    use InteractsWithAlphavantageApi;

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function news(array $tickers, array $topics = [], ?Carbon $timeFrom = null, ?Carbon $timeTo = null, string $sort = 'LATEST', int $limit = 10000): array
    {
        if (! in_array($sort, ['LATEST', 'EARLIEST', 'RELEVANCE'])) {
            throw new \InvalidArgumentException("Invalid sort provided. Must be 'LATEST' or 'EARLIEST' or 'RELEVANCE'");
        }

        $timeFromFormatted = $timeFrom?->format('Ymd\THi');

        $timeToFormatted = $timeTo?->format('Ymd\THi');

        $tickersString = count($tickers) > 0 ? implode(',', $tickers) : null;
        $topicsString = count($topics) > 0 ? implode(',', $topics) : null;

        return $this->get('NEWS_SENTIMENT', [
            'tickers' => $tickersString,
            'topics' => $topicsString,
            'from' => $timeFromFormatted,
            'to' => $timeToFormatted,
            'sort' => $sort,
            'limit' => $limit,
        ]);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function gainersAndLosers(): array
    {
        return $this->get('TOP_GAINERS_LOSERS');
    }
}
