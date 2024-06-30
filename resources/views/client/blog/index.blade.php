@extends('client.app.app')
@section('seo_meta')
      {!! \App\Facades\MenuListUtility::getSeoInfo('blogs')->seo_links !!}
    <meta name="description" content="{{\App\Facades\MenuListUtility::getMenuSeo('blogs')->meta_description}}" />
    <meta name="keywords" content="{{\App\Facades\MenuListUtility::getMenuSeo('blogs')->meta_keywords}}" />
    <title>{{\App\Facades\MenuListUtility::getMenuSeo('blogs')->seo_title}}</title>
@endsection
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

    </style>
@endsection
@section('content')
    <main id="content" class="wrapper layout-page">
        <section class="page-title z-index-2 position-relative">
            <div class="bg-body-secondary">
                <div class="container">
                    <nav class="py-4 lh-30px" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center py-1">
                            <li class="breadcrumb-item">
                                <a href=""> {{TranslateUtility::getTranslate('breadcrumb', 'home', $lang)}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{TranslateUtility::getTranslate('breadcrumb', 'blogs', $lang)}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            
        </section>

       <section class="blogs py-15">
            <div class="text-center">
                <div class="container">
                    <h2 class="mb-0"> {{TranslateUtility::getTranslate('blogs_page', 'title', $lang)}}</h2>
                </div>
            </div>
            <div class="container mt-15">
              @include('client.app.partials._blogs')

              <!-- PAGINATION -->
              <nav class="d-flex mt-13 pt-3 justify-content-center" aria-label="pagination" data-animate="fadeInUp">
                {{ $blogs->links() }}
              </nav>
            </div>
       </section>
    </main>
@endsection
@section('scripts')
    
     {!! \App\Facades\MenuListUtility::getSeoInfo('blogs')->seo_scripts !!}
@endsection