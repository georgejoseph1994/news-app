<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index()
    {
        try {
            $client = new Client();
            $apiRequest = $client->request('GET', env('GUARDIAN_SEARCH_URL').'api-key='.env('GUARDIAN_NEWS_API_KEY'));
            $news = json_decode($apiRequest->getBody()->getContents(), true)['response']['results'];
            // return json_decode($apiRequest->getBody()->getContents(), true);
        } catch (RequestException $e) {
            //For handling exception
            Log::error($e->getRequest());
            if ($e->hasResponse()) {
                Log::error($e->getResponse());
            }
        }
        // $news=$apiRequest->getBody()->getContents();
        $data = array(
            'news'=>$news
        );
        Log::debug($news);
        return view("welcome")->with($data);
    }
}
