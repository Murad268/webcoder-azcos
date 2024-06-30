@extends('client.app.app')

@section('links')
    <style>
        .pagination .page-item .page-link {
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .pagination .page-item.active .page-link {
            background-color: #000000;
            color: #fff;
            border: none;
        }

        .search_header {
            padding: 20px;
        }
        header {
            color: white;
            text-align: center;
        }

        .search-form {
            gap: 20px;
        }

        main {
            padding: 20px;
        }
        .results-list {
            list-style-type: none;
            padding: 0;
        }
        .result-item {
            background-color: white;
            padding: 20px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .result-item h2 {
            margin: 0 0 10px 0;
        }
        .result-item p {
            margin: 0 0 10px 0;
        }
        .result-url a {
            color: #4CAF50;
            text-decoration: none;
        }
        .result-url a:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <header class="search_header">
        <h1>{{TranslateUtility::getTranslate('site', 'search_results', $lang)}}</h1>
        <form action="{{route('front.site.search', ['lang' => $lang])}}" method="GET" class="search-form search-box-2 d-flex justify-content-center">
            <input type="text" name="s" placeholder="Search..." class="form-control bg-transparent w-60" value="{{$q?$q:""}}">
            <button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11">{{TranslateUtility::getTranslate('admin_form', 'search', $lang)}}</button>
        </form>
    </header>
    <main>
        <ul class="results-list">
            @foreach($paginatedResults as $result)
            @if($result->getWithLocale($lang)->slug)
               <li class="result-item">
                    <h2>
                        @if($result->type == 'category')
                            <a href="{{ route('front.brand.details', ['lang' => $lang, 'slug' =>  $result->getWithLocale($lang)->slug ?? '']) }}">
                               {{ $result->getWithLocale($lang)->title ?? "" }}
                            </a>
                        @elseif($result->type == 'product')
                            <a href="{{ route('front.product.details', ['lang' => $lang, 'slug' => $result->getWithLocale($lang) ? $result->getWithLocale($lang)->slug ?? '' : '']) }}">
                                {{ $result->getWithLocale($lang)->title ?? "" }}
                            </a>
                        @elseif($result->type == 'brand')
                            <a href="{{ route('front.site.showHairColors', ['lang' => $lang, 'slug' => $result->getWithLocale($lang) ? $result->getWithLocale($lang)->slug ?? '' : '']) }}">
                                {{ $result->getWithLocale($lang)->title ?? "" }}
                            </a>
                        @elseif($result->type == 'color')
                            <a href="{{ route('front.site.showColors', ['lang' => $lang, 'slug' => $result->getWithLocale($lang) ? $result->getWithLocale($lang)->slug ?? '' : '']) }}">
                                {{ $result->getWithLocale($lang)->title ?? "" }}
                            </a>
                        @elseif($result->type == 'blog')
                            <a href="{{ route('front.blogs.details', ['lang' => $lang, 'slug' =>  $result->getWithLocale($lang)->slug ?? '']) }}">
                                {{ $result->getWithLocale($lang)->title ?? "" }}
                            </a>
                        @endif
                    </h2>
                    <p>
                        @if($result->type == 'category')
                            {{ TranslateUtility::getTranslate('type', 'category', $lang) }}
                        @elseif($result->type == 'product')
                            {{ TranslateUtility::getTranslate('type', 'product', $lang) }}
                        @elseif($result->type == 'brand')
                            {{ TranslateUtility::getTranslate('type', 'brand', $lang) }}
                        @elseif($result->type == 'color')
                            {{ TranslateUtility::getTranslate('type', 'color', $lang) }}
                        @elseif($result->type == 'blog')
                            {{ TranslateUtility::getTranslate('type', 'blog', $lang) }}
                        @endif
                    </p>
                    <p class="result-url">
                        @if($result->type == 'category')
                            <a href="{{ route('front.brand.details', ['lang' => $lang, 'slug' =>  $result->getWithLocale($lang)->slug ?? '']) }}">
                                {{ TranslateUtility::getTranslate('site', 'go_to', $lang) }}
                            </a>
                        @elseif($result->type == 'product')
                            <a href="{{ route('front.product.details', ['lang' => $lang, 'slug' => $result->getWithLocale($lang) ? $result->getWithLocale($lang)->slug ?? '' : '']) }}">
                                {{ TranslateUtility::getTranslate('site', 'go_to', $lang) }}
                            </a>
                        @elseif($result->type == 'brand')
                            <a href="{{ route('front.site.showHairColors', ['lang' => $lang, 'slug' => $result->getWithLocale($lang) ? $result->getWithLocale($lang)->slug ?? '' : '']) }}">
                                {{ TranslateUtility::getTranslate('site', 'go_to', $lang) }}
                            </a>
                        @elseif($result->type == 'color')
                            <a href="{{ route('front.site.showColors', ['lang' => $lang, 'slug' => $result->getWithLocale($lang) ? $result->getWithLocale($lang)->slug ?? '' : '']) }}">
                                {{ TranslateUtility::getTranslate('site', 'go_to', $lang) }}
                            </a>
                        @elseif($result->type == 'blog')
                            <a href="{{ route('front.blogs.details', ['lang' => $lang, 'slug' =>  $result->getWithLocale($lang)->slug ?? '']) }}">
                                {{ TranslateUtility::getTranslate('site', 'go_to', $lang) }}
                            </a>
                        @endif
                    </p>
                </li>
            @endif
             
            @endforeach
        </ul>

        <!-- Pagination links -->
        {{ $paginatedResults->links() }}
    </main>
@endsection

