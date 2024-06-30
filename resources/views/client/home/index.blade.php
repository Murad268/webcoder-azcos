@extends('client.app.app')
@section('seo_meta')
    <meta name="description" content="{{\App\Facades\MenuListUtility::getMenuSeo('home')->meta_description}}" />
    <meta name="keywords" content="{{\App\Facades\MenuListUtility::getMenuSeo('home')->meta_keywords}}" />
    <title>{{\App\Facades\MenuListUtility::getMenuSeo('home')->seo_title}}</title>
     {!! \App\Facades\MenuListUtility::getSeoInfo('home')->seo_links !!}
@endsection

@section('content')
<main id="content" class="wrapper layout-page">
    <section class="brand_slider">
        <div class="slick-slider hero hero-header-05 slick-slider-dots-inside" data-slick-options="{&#34;arrows&#34;:false,&#34;autoplay&#34;:true,&#34;cssEase&#34;:&#34;ease-in-out&#34;,&#34;dots&#34;:false,&#34;fade&#34;:true,&#34;infinite&#34;:true,&#34;slidesToShow&#34;:1,&#34;speed&#34;:600}">
            @foreach($brands as $brand)
            <div class="vh-100 d-flex align-items-center">
                <div class="z-index-2 container container-xxl py-21 pt-xl-10 pb-xl-11">
                    <div class="hero-content text-start">
                        <div data-animate="fadeInDown">
                            <p class="text-primary mb-8 fw-semibold fs-4 brand_text">
                                {{$brand->getWithLocale($lang)->subtitle ?? ""}}
                            </p>
                            <h1 class="mb-11 hero-title-5">
                                {{$brand->getWithLocale($lang)->title ?? ""}}
                            </h1>
                        </div>
                    </div>
                </div>
                @if($brand->images->where('model_type', 'banners')->count()>0)
                    @foreach($brand->images->where('model_type', 'banners') as $image)
                    <div class="lazy-bg brand_bg bg-overlay position-absolute z-index-1 w-100 h-100 light-mode-img" data-bg-src="{{asset('storage/'.$image->image_url)}}"></div>
                    @endforeach
                    @foreach($brand->images->where('model_type', 'banners') as $image)
                        <div class="lazy-bg brand_bg bg-overlay position-absolute z-index-1 w-100 h-100 dark-mode-img" data-bg-src="{{asset('storage/'.$image->image_url)}}"></div>
                    @endforeach
                @else
                    @foreach($brand->images->where('model_type', 'images') as $image)
                    <div class="lazy-bg bg-overlay brand_bg position-absolute z-index-1 w-100 h-100 light-mode-img" data-bg-src="{{asset('storage/'.$image->image_url)}}"></div>
                    @endforeach
                    @foreach($brand->images->where('model_type', 'images') as $image)
                        <div class="lazy-bg bg-overlay brand_bg position-absolute z-index-1 w-100 h-100 dark-mode-img" data-bg-src="{{asset('storage/'.$image->image_url)}}"></div>
                    @endforeach
                @endif
             
            </div>
            @endforeach
        </div>
    </section>

    <section class="py-lg-17" id="about">
        <div class="mb-13 text-center" data-animate="fadeInUp">
            <h2 class="mb-5">{{TranslateUtility::getTranslate('home_page', 'about_section_top_title', $lang)}}</h2>
            <p class="fs-18px mb-0 fs-18px mb-0 mw-xl-35 mw-lg-50 mw-md-75 ms-auto me-auto px-xl-5">
                {{TranslateUtility::getTranslate('home_page', 'about_section_top_subtitle', $lang)}}
            </p>
        </div>
        <div class="container pt-11 mb-lg-4">
            <div class="row pb-3 align-items-center">
                <div class="col-lg-6 pe-lg-0">
                    <div class="card border-0 hover-zoom-in rounded-0">
                        @foreach($about->images->where('model_type', 'about') as $image)
                        <div class="image_block" style="position: relative; ">
                            <a href="{{ route('admin.about.delete_image', ['id' => $image->id]) }}" class="delete_image" style="position: absolute; top: 5px; right: 5px; color: red; text-decoration: none;">
                                &#x2715;
                            </a>
                            <a target="_blank" href="{{ asset('storage/' . $image->image_url) }}">
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . $image->image_url) }}" />
                            </a>
                        </div>
                        @endforeach

                        <div class="d-none"></div>
                    </div>
                </div>
                <div class="col-lg-6 px-lg-12 ps-xl-18 pe-xl-20 mt-12 mt-lg-0">
                    <h3 class="mb-8"> {{$about->getWithLocale($lang)->title_second ?? ""}}</h3>
                    <div class="mb-9">
                        {{ strip_tags($about->getWithLocale($lang)->text_second ?? "") }}
                    </div>
                    <a href="{{ route('front.about.index', ['lang' => $lang]) }}" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11">
                        {{TranslateUtility::getTranslate('site', 'read_more', $lang)}}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="brands py-15">
        <div class="container container-xxl">
            <div class="mb-13 text-center" data-animate="fadeInUp">
                <h2 class="mb-5">{{TranslateUtility::getTranslate('home_page', 'our_brands_section_title', $lang)}}</h2>
                <p class="fs-18px mb-0 fs-18px mb-0 mw-xl-35 mw-lg-50 mw-md-75 ms-auto me-auto px-xl-5">
                    {{TranslateUtility::getTranslate('home_page', 'our_brands_section_subtitle', $lang)}}
                </p>
            </div>
            <div class="row gy-30px">
                @foreach($brands as $brand)
                <div class="col-lg-6" data-animate="fadeInUp">
                    <div class="card border-0 rounded-0 banner-01 hover-zoom-in hover-shine">
                        @foreach($brand->images->where('model_type', 'images') as $image)
                        <img class="lazy-image object-fit-cover card-img light-mode-img" src="#" data-src="{{asset('storage/'.$image->image_url)}}" width="690" height="420" alt="Mountain Pine Bath Oil" />
                        <img class="lazy-image dark-mode-img object-fit-cover card-img" src="#" data-src=".{{asset('storage/'.$image->image_url)}}" width="690" height="420" alt="Mountain Pine Bath Oil" />
                        @endforeach


                        <div class="card-img-overlay d-inline-flex flex-column p-md-12 m-md-2 p-8">
                            <h6 class="card-subtitle ls-1 fs-15px mb-5 fw-semibold text-body-emphasis">
                                {{$brand->getWithLocale($lang)->title ?? ""}}
                            </h6>
                            <h3 class="card-title lh-45px mw-75 pe-xl-25 pe-lg-0 pe-md-25 fs-3 pe-5">
                                {{$brand->getWithLocale($lang)->subtitle ?? ""}}
                            </h3>
                            <div class="mt-7">
                                <a href="{{route('front.brand.details', ['lang' => $lang, 'slug' =>  $brand->getWithLocale($lang)->slug ?? ''])}}" class="btn btn btn-white">{{TranslateUtility::getTranslate('site', 'go_to', $lang)}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <section class="container mb-lg-18 mb-15 pb-3 py-lg-17">
        <div class="mb-13 text-center" data-animate="fadeInUp">
            <h2 class="mb-5">{{TranslateUtility::getTranslate('home_page', 'our_blogs_section_title', $lang)}}</h2>
            <p class="fs-18px mb-0 fs-18px mb-0 mw-xl-35 mw-lg-50 mw-md-75 ms-auto me-auto px-xl-5">
                {{TranslateUtility::getTranslate('home_page', 'our_blogs_section_subtitle', $lang)}}
            </p>
        </div>
        @include('client.app.partials._blogs', ['blogs' => $blogs])

    </section>

   @include('client.app.partials._contact_form')
</main>
@endsection


@section('scripts')
    
     {!! \App\Facades\MenuListUtility::getSeoInfo('home')->seo_scripts !!}
@endsection