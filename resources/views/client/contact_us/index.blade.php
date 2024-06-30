@extends('client.app.app')
@section('seo_meta')
  {!! \App\Facades\MenuListUtility::getSeoInfo('contact')->seo_links !!}
    <meta name="description" content="{{\App\Facades\MenuListUtility::getMenuSeo('contact')->meta_description}}" />
    <meta name="keywords" content="{{\App\Facades\MenuListUtility::getMenuSeo('contact')->meta_keywords}}" />
    <title>{{\App\Facades\MenuListUtility::getMenuSeo('contact')->seo_title}}</title>
@endsection
@section('content')
    <main id="content" class="wrapper layout-page">
        <section>
            <div class="bg-body-secondary py-5">
                <nav aria-label="breadcrumb">
                    <ol
                        class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center"
                    >
                        <li class="breadcrumb-item">
                            <a
                                class="text-decoration-none text-body"
                                href="#"
                            >{{TranslateUtility::getTranslate('breadcrumb', 'home', $lang)}}</a
                            >
                        </li>
                        <li
                            class="breadcrumb-item active pl-0 d-flex align-items-center"
                            aria-current="page"
                        >
                            {{TranslateUtility::getTranslate('breadcrumb', 'contact', $lang)}}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="text-center pt-13 mb-13 mb-lg-15">
                    <div class="text-center">
                        <h2 class="fs-36px mb-7"> {{TranslateUtility::getTranslate('contact_page', 'title', $lang)}}</h2>
                        <p
                            class="fs-18px mb-0 w-lg-60 w-xl-50 mx-md-13 mx-lg-auto"
                        >
                            {{TranslateUtility::getTranslate('contact_page', 'subtitle', $lang)}}
                        </p>
                    </div>
                </div>
                <div
                    id="map"
                    class="w-100"
                >
                {!! $settings->map !!}
                </div>
            </div>
        </section>

        @include('client.app.partials._contact_form')
    </main>

@endsection
@section('scripts')
    
     {!! \App\Facades\MenuListUtility::getSeoInfo('contact')->seo_scripts !!}
@endsection