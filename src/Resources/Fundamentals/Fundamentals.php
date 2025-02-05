<?php

namespace Tschucki\Alphavantage\Resources\Fundamentals;

use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use InvalidArgumentException;
use Tschucki\Alphavantage\Concerns\InteractsWithAlphavantageApi;
use Tschucki\Alphavantage\Exceptions\ApiVolumeReached;

class Fundamentals
{
    use InteractsWithAlphavantageApi;

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function overview(string $symbol): array
    {
        return $this->get('OVERVIEW', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function etfProfile(string $symbol): array
    {
        return $this->get('ETF_PROFILE', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function incomeState(string $symbol): array
    {
        return $this->get('INCOME_STATEMENT', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function balanceSheet(string $symbol): array
    {
        return $this->get('BALANCE_SHEET', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function cashFlow(string $symbol): array
    {
        return $this->get('CASH_FLOW', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function earnings(string $symbol): array
    {
        return $this->get('EARNINGS', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function listingStatus(?Carbon $date = null, string $state = 'active'): array
    {
        if (! in_array($state, ['active', 'delisted'])) {
            throw new InvalidArgumentException("Invalid state provided. Must be 'active' or 'delisted'");
        }

        return $this->get('LISTING_STATUS', [
            'date' => $date?->format('Y-m-d'),
            'state' => $state,
        ], acceptJson: false, acceptCsv: true);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function earningsCalendar(?string $symbol, int $months = 3): array
    {
        $horizon = $months.'month';

        return $this->get('EARNINGS_CALENDAR', [
            'symbol' => $symbol,
            'horizon' => $horizon,
        ], acceptJson: false, acceptCsv: true);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function ipoCalendar(): array
    {
        return $this->get('IPO_CALENDAR', acceptJson: false, acceptCsv: true);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function dividends(string $symbol): array
    {
        return $this->get('DIVIDENDS', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * @throws ApiVolumeReached
     * @throws ConnectionException
     */
    public function splits(string $symbol): array
    {
        return $this->get('SPLITS', [
            'symbol' => $symbol,
        ]);
    }
}
