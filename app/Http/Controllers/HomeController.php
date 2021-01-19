<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Traits\GuardianApi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    use GuardianApi;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     *
     * Returns the home page and handles the searching of news.
     */
    public function index(Request $request)
    {
        $searchString = isset($request->search)?$request->search:"";
        $news=$this->searchResultsOnGuardian($searchString);
        $pinnedNews = auth()->user()->news()->get();
        $data = array(
            'news'=>$news,
            'pinnedNews'=>$pinnedNews
        );
        return view("home")->with($data);
    }

    /**
    * Pins the article for later reading for a user
    */
    public function pin(Request $request)
    {
        $news_article = News::find($request->id);
        // if the article is not yet persisted
        if (!$news_article) {
            $news = new News();
            $news->id = $request->id;
            $news->title = $request->title;
            $news->url = $request->url;
            $news->publication_date = Carbon::parse($request->publication_date);
            $news->save();
            // pinning the article
            $news->users()->attach(Auth::user()->id);
        } else {
            if ($news_article->users()->get()->contains(Auth::user()->id)) {
                // unpinning the article
                $news_article->users()->detach(Auth::user()->id);
            } else {
                // pinning the article
                $news_article->users()->attach(Auth::user()->id);
            }
        }
        
        return $this->index($request);
    }
}
