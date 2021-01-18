<?php // Code in app/Traits/MyTrait.php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

trait GuardianApi
{
    /**
     * Returns the results of search from Guardians API.
     *
     * @param String $searchString - Eg "politcs"
     *
     * @return mixed $news
     */
    protected function searchResultsOnGuardian(string $searchString)
    {
        try {
            $url_params = rawurlencode($searchString);
            $client = new Client();
            $apiRequest = $client->request('GET', env('GUARDIAN_SEARCH_URL').$url_params.'&api-key='.env('GUARDIAN_NEWS_API_KEY'));
            $news = json_decode($apiRequest->getBody()->getContents(), true)['response']['results'];
            log::debug($url_params);
        } catch (RequestException $e) {
            //For handling exception
            Log::error($e->getRequest());
            if ($e->hasResponse()) {
                Log::error($e->getResponse());
            }
        }
        return $news;
    }
}
