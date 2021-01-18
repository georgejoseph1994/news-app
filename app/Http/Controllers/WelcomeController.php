<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Traits\GuardianApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    use GuardianApi;
    
    /**
     * Returns the home page and handles the searching of news.
     */
    public function index(Request $request)
    {
        $searchString = isset($request->search)?$request->search:"";
        $news=$this->searchResultsOnGuardian($searchString);
        $pinnedNews=[];
        if (Auth::check()) {
            $pinnedNews = auth()->user()->news()->get();
        }
        $data = array(
            'news'=>$news,
            'pinnedNews'=>$pinnedNews
        );
        return view("welcome")->with($data);
    }
}
