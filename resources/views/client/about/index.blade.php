@extends('client.app.app')
@section('seo_meta')
    {!! \App\Facades\MenuListUtility::getSeoInfo('about')->seo_links !!}
    <meta name="description" content="{{\App\Facades\MenuListUtility::getMenuSeo('about')->meta_description}}" />
    <meta name="keywords" content="{{\App\Facades\MenuListUtility::getMenuSeo('about')->meta_keywords}}" />
    <title>{{\App\Facades\MenuListUtility::getMenuSeo('about')->seo_title}}</title>

@endsection
@section('links')
<style>
.about_text {
    padding-top: 15rem;
    padding-bottom: 12rem;
}

.about_text > p {
    margin-bottom: 0;
}

.about_text > h1 {
    margin-bottom: 0;
}

@media(max-width: 1170px) {
    .about_text {
       padding-top: 6rem;
       padding-bottom: 6rem;
    }
}

@media(max-width: 940px) {
    .about_text {
       padding-top: 9rem;
       padding-bottom: 9rem;
    }

    .about_text > h1 {
        font-size: 36px !important;
    }
}

@media(max-width: 690px) {
    .about_text {
       padding-top: 4rem;
       padding-bottom: 4rem;
    }

    .about_text > h1 {
        max-width: 400px;
    }
}

@media(max-width: 480px) {
    .about_text {
       padding-top: 2rem;
       padding-bottom: 2rem;
    }

    .about_text > h1 {
        font-size: 28px !important;
    }
}

</style>
@endsection
@section('content')
<main id="content" class="wrapper layout-page">
    <section class="position-relative" id="about_introduction">
        @foreach($about->images->where('model_type', 'about_banner') as $image)
            <div class="lazy-bg bg-overlay banner position-absolute z-index-1 w-100 h-100 light-mode-img" data-bg-src="{{asset('storage/'.$image->image_url)}}"></div>
            <div class="lazy-bg bg-overlay banner dark-mode-img position-absolute z-index-1 w-100 h-100" data-bg-src="{{asset('storage/'.$image->image_url)}}"></div>
        @endforeach


        <div class="position-relative z-index-2 container about_text">
            <p class="fw-semibold ls-15 text-uppercase text-body-emphasis">
                {{TranslateUtility::getTranslate('about_page', 'banner_top_string', $lang)}}
            </p>
            <h1 class="fs-56px"> {{TranslateUtility::getTranslate('about_page', 'banner_bottom_string', $lang)}}</h1>
        </div>
    </section>

    <section>
        <div class="container pt-lg-17 pb-lg-20 pt-11 mb-lg-4">
            <div class="text-center pb-lg-17 pb-13 mb-3">
                <!-- <img data-src="./assets/images/shop/image-box-01.png" alt="other-02" class="img-fluid lazy-image m-auto" width="150" height="158" src="#" /> -->
                <h2 class="mw-xl-50 mw-lg-60 mx-lg-auto mb-8">
                    {{$about->getWithLocale($lang)->title_first ?? ""}}
                </h2>
                <p class="mw-xl-60 mw-lg-75 mx-lg-auto mb-0">
                    {{ strip_tags($about->getWithLocale($lang)->text_first ?? "") }}
                </p>
            </div>
            <div class="row mb-lg-18 mb-15 pb-3 align-items-center">
                <div class="col-lg-6 pe-lg-0">
                    <div class="card border-0 hover-zoom-in rounded-0">
                        @foreach($about->images->where('model_type', 'about') as $image)
                        <div class="image-box-4">

                            <img class="lazy-image img-fluid lazy-image w-100" src="#" data-src="{{asset('storage/'.$image->image_url)}}" width="960" height="640" alt="" />
                        </div>
                        @endforeach

                        <div class="d-none"></div>
                    </div>
                </div>
                <div class="col-lg-6 px-lg-12 ps-xl-18 pe-xl-20 mt-12 mt-lg-0">
                    <h3 class="mb-8">{{$about->getWithLocale($lang)->title_second ?? ""}}</h3>
                    <p class="mb-0">
                        {{ strip_tags($about->getWithLocale($lang)->text_second ?? "") }}
                    </p>
                </div>
            </div>

            <div class="container container-xxl">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-5 order-2 order-lg-1 mb-lg-0">
                        <div class="row">
                            <h3 class="fs-3 mb-10">{{$about->getWithLocale($lang)->title_third ?? ""}}</h3>
                                <div class="d-flex align-items-start">
                                    <div class="d-none">
                                        <svg class="icon fs-2">
                                            <use xlink:href="#"></use>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="fs-6 mb-2 pb-4">
                                            <p class="mb-2 pb-4 fs-6">
                                                {{ strip_tags($about->getWithLocale($lang)->text_third ?? "") }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-7 order-1 order-lg-2 mb-12 mb-lg-0 d-flex brand_video">
                        <iframe class="w-100" src="https://www.youtube.com/embed/{{$about->video_link}};" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                        <div class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="with_client_logo_4" class="bg-body-tertiary">
        <div class="container pt-lg-20 pb-lg-19 pt-15 pb-16">
            <div class="row mb-11 mb-lg-15">
                <div class="col-lg-9 offset-lg-1 col-xl-8 offset-xl-2">
                    <div class="main">
                        <div class="text-center">
                            <h4 class="mb-0">
                               {{TranslateUtility::getTranslate('site', 'certificate_section_title',  TranslateUtility::getLang())}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slick-slider" data-slick-options='{&#34;arrows&#34;:true,&#34;centerMode&#34;:true,&#34;centerPadding&#34;:&#34;calc((100% - 1440px) / 2)&#34;,&#34;dots&#34;:true,&#34;infinite&#34;:true,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1200,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:3}},{&#34;breakpoint&#34;:992,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:2}},{&#34;breakpoint&#34;:576,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}}],&#34;slidesToShow&#34;:4}'>
                
                 @foreach($about->images->where('model_type', 'certificate') as $image)
                        <div class="mb-6">
                            <figure class="card-img-top mb-7 overflow-hidden">
                                <a
                                  href="{{ asset('storage/' . $image->image_url) }}"
                                  class="hover-zoom-in d-block"
                                >
                                    <img class="img-fluid lazy-image w-100 light-mode-img" src="#" data-src="{{ asset('storage/' . $image->image_url) }}" width="330" height="440" alt="Certificate" />
                                    <img class="img-fluid lazy-image w-100 dark-mode-img" src="#" data-src="{{ asset('storage/' . $image->image_url) }}" width="330" height="440" alt="Certificate" />
                                </a>
                            </figure>
                        </div>
                 @endforeach
            </div>
        </div>
    </section>

    <!-- <section class="pt-lg-18 pb-lg-16 pt-15 pb-md-13 pb-16 about_me">
      <div class="container">
        @foreach($team as $member)
              <div class="row mb-lg-18 mb-15 pb-3 align-items-center">
              <div class="col-lg-6 pe-lg-0">
                  <div class="card border-0 hover-zoom-in rounded-0 align-items-center">
                      @foreach($member->images->where('model_type', 'team') as $image)
                          <div class="image-box-4 about_img">
                              <img class="lazy-image img-fluid object-fit-contain lazy-image" src="#" data-src="{{asset('storage/'.$image->image_url)}}" width="960" height="640" alt="" />
                          </div>
                      @endforeach
                      <div class="d-none"></div>
                  </div>
              </div>
              <div class="col-lg-6 px-lg-12 ps-xl-18 pe-xl-20 mt-12 mt-lg-0">
                  <h3 class="mb-8">{{$member->getWithLocale($lang)->title}}</h3>
                  <p class="mb-0">
                      {{strip_tags($member->getWithLocale($lang)->text)}}
                  </p>
              </div>
          </div>
        @endforeach
      </div>
  </section> -->
</main>

@endsection
@section('scripts')
    
     {!! \App\Facades\MenuListUtility::getSeoInfo('about')->seo_scripts !!}
@endsection