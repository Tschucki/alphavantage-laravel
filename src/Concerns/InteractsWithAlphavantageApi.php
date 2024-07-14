<?php

namespace Tschucki\Alphavantage\Concerns;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Tschucki\Alphavantage\Exceptions\ApiVolumeReached;

trait InteractsWithAlphavantageApi
{
    private string $apiUrl;

    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('alphavantage.key') ?? 'demo';
        $this->apiUrl = 'https://www.alphavantage.co/query';
    }

    /**
     * @throws ConnectionException|ApiVolumeReached
     */
    public function get(string $function, array $queryParams = [], $acceptJson = true, $acceptCsv = false): array
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];
        if ($acceptJson) {
            $headers['Accept'] = 'application/json';
        }

        $response = Http::withQueryParameters([
            'function' => $function,
            ...$queryParams,
            'apikey' => $this->apiKey,
        ])->withHeaders($headers)->timeout(60 * 3)->get($this->apiUrl);

        //dd($response->effectiveUri());
        return $this->serializeResults($response, $acceptJson, $acceptCsv);
    }

    /**
     * @throws ApiVolumeReached
     */
    private function serializeResults(Response $response, $wantsJson, $wantsCsv): array
    {
        if ($response->json('Information')) {
            if ($response->json('Information') === 'Thank you for using Alpha Vantage! Please contact premium@alphavantage.co if you are targeting a higher API call volume.') {
                Cache::put(
                    'alphavantage-api-limit',
                    now()->addSeconds(60)->timestamp
                );
                throw new ApiVolumeReached($response->json('Information'));
            }

            throw new RuntimeException($response->json('Information'));
        }

        if ($response->json('Error Message')) {
            throw new RuntimeException($response->json('Error Message').' URL: '.$response->effectiveUri());
        }

        if ($wantsJson) {
            return $this->serializeJsonResponse($response);
        }

        if ($wantsCsv) {
            return $this->serializeCsvResponse($response);
        }

        return [];
    }

    private function serializeJsonResponse(Response $response): array
    {
        return $response->json();
    }

    private function serializeCsvResponse(Response $response): array
    {
        $lines = explode(PHP_EOL, $response->body());
        $data = [];

        $header = explode(',', $lines[0]);
        unset($lines[0]);
        foreach ($lines as $index => $line) {
            $values = explode(',', $line);
            $rowData = [];
            foreach ($values as $i => $value) {
                $headerValue = str_replace("\r", '', $header[$i]);
                $rowData[$headerValue] = str_replace("\r", '', $value);
            }
            $data[] = $rowData;
        }

        return $data;
    }
}
