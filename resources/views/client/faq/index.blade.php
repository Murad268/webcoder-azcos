@extends('client.app.app')
@section('seo_meta')
      {!! \App\Facades\MenuListUtility::getSeoInfo('faq')->seo_links !!}
    <meta name="description" content="{{\App\Facades\MenuListUtility::getMenuSeo('faq')->meta_description}}" />
    <meta name="keywords" content="{{\App\Facades\MenuListUtility::getMenuSeo('faq')->meta_keywords}}" />
    <title>{{\App\Facades\MenuListUtility::getMenuSeo('faq')->seo_title}}</title>
@endsection
@section('content')
    <main id="content" class="wrapper layout-page">
        <section class="pb-16 pb-lg-18">
            <div class="bg-body-secondary py-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none text-body" href="#">
                                {{ TranslateUtility::getTranslate('breadcrumb', 'home', $lang) }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">
                            {{ TranslateUtility::getTranslate('breadcrumb', 'faq', $lang) }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="container">
                <div class="card border-0 hover-zoom-in">
                    <div class="image-box-4">
                        <img data-src="./assets/images/banner/banner-35.jpg" class="img-fluid lazy-image" alt="" src="#" />
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="pt-15 pt-lg-18">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-9">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($faq as $item)
                                    <div class="accordion-item pb-5 pt-11 pt-md-0">
                                        <h2 class="accordion-header" id="flush-heading{{ $loop->index }}">
                                            <a class="product-info-accordion text-decoration-none" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $loop->index }}" aria-expanded="false" aria-controls="flush-collapse{{ $loop->index }}">
                                                <span class="fs-18px">{{ $item->getWithLocale($lang)->question ?? "" }}</span>
                                            </a>
                                        </h2>
                                    </div>
                                    <div id="flush-collapse{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="flush-heading{{ $loop->index }}" data-bs-parent="#accordionFlushExample">
                                        <div class="py-8">
                                            <p>{{ strip_tags($item->getWithLocale($lang)->question ?? "") }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
    
     {!! \App\Facades\MenuListUtility::getSeoInfo('faq')->seo_scripts !!}
@endsection