<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>News-App George</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
        </style>
    <script src="{{ asset('js/app.js') }}" defer></script>
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased" >
        <div id="app" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block bg-white text-right pr-5">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        @endauth
                </div>
            @endif
            <div class="container mt-5">
                <form action="{{ route('welcome') }}" method="GET">
                    <div class="input-group mb-4">
                        <input name="search" required type="text" class="form-control" placeholder="Search for news">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                            <svg style="fill:white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                            </button>
                        </div>
                    </div>
                </form>
                @foreach($news as $newsItem)
                    <div class="card p-4">
                        <a href="{{$newsItem['webUrl']}}" target="blanc"><h5>{{$newsItem["webTitle"]}}</h5></a>
                        <p class="text-black-50">{{date('j/m/Y', strtotime($newsItem["webPublicationDate"]))}}</p>
                        
                        <form action="/pin" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $newsItem['id'] }}">
                            <input type="hidden" name="title" value="{{ $newsItem['webTitle'] }}">
                            <input type="hidden" name="url" value="{{ $newsItem['webUrl'] }}">
                            <input type="hidden" name="publication_date" value="{{ $newsItem['webPublicationDate'] }}">
                            <button type="submit" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"/></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
                @if(count($pinnedNews) > 0)
                <h4 class="py-4">Saved for later</h4>
                @endif
                @foreach($pinnedNews as $pinnedNewsItem)
                    <div class="card p-4">
                        <a href="{{$pinnedNewsItem['url']}}" target="blanc"><h5>{{$pinnedNewsItem['title']}}</h5></a>
                        <p class="text-black-50">{{date('j/m/Y', strtotime($pinnedNewsItem['publication_date']))}}</p>
                        <form action="/pin" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $pinnedNewsItem['id'] }}">
                            <input type="hidden" name="title" value="{{ $pinnedNewsItem['title'] }}">
                            <input type="hidden" name="url" value="{{ $pinnedNewsItem['url'] }}">
                            <input type="hidden" name="publication_date" value="{{ $pinnedNewsItem['publication_date'] }}">
                            <button type="submit" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
        </div>
    </body>
</html>
