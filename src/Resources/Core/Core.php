<?php

namespace Tschucki\Alphavantage\Resources\Core;

use Illuminate\Http\Client\ConnectionException;
use Tschucki\Alphavantage\Concerns\InteractsWithAlphavantageApi;
use Tschucki\Alphavantage\Exceptions\ApiVolumeReached;

class Core
{
    use InteractsWithAlphavantageApi;

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function quoteEndpoint(string $symbol): array
    {
        return $this->get('GLOBAL_QUOTE', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function search(string $keywords): array
    {
        return $this->get('SYMBOL_SEARCH', [
            'keywords' => $keywords,
        ]);
    }
}
