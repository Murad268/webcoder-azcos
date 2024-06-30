@extends('client.app.app')
@section('seo_meta')
    {!! $brand->seo_links !!}
    <meta name="description" content="{{$brand->getWithLocale($lang)->meta_description ?? ""}}" />
    <meta name="keywords" content="{{$brand->getWithLocale($lang)->meta_keywords ?? ""}}" />
    <title>{{$brand->getWithLocale($lang)->seo_title ?? ""}}</title>
@endsection
@section('content')
    <main id="content" class="wrapper layout-page">
        <section class="mb-13 mb-lg-15 mb-xl-19">
            <div class="bg-body-secondary py-5 mb-13">
                <nav aria-label="breadcrumb">
                    <ol
                        class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center"
                    >
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none text-body" href="#"> {{TranslateUtility::getTranslate('breadcrumb', 'home', $lang)}}</a>
                        </li>
                        <li
                            class="breadcrumb-item active pl-0 d-flex align-items-center"
                            aria-current="page"
                        >
                            {{$brand->getWithLocale($lang)->title ?? ''}}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="container container-xxl">
                <div class="text-center">
                    <div class="text-center">
                        <h1 class="fs-36px mb-7">{{$brand->getWithLocale($lang)->title ?? ''}}</h1>
                        <p class="fs-18px mb-6 w-lg-60 w-xl-40 mx-md-13 mx-lg-auto">
                            {{$brand->getWithLocale($lang)->subtitle ?? ''}}
                        </p>
                    </div>
                </div>
                <div class="row mt-15 d-flex align-items-center">
                    <div class="col-lg-7 col-xl-6 mb-12 mb-lg-0">
                        <div class="card border-0 hover-zoom-in">
                            @foreach($brand->images->where('model_type', 'images') as $image)

                                <div class="image-box-4">
                                    <img
                                        class="lazy-image img-fluid lazy-image rounded-0"
                                        src="#"
                                        data-src="{{asset('storage/'.$image->image_url)}}"
                                        width="960"
                                        height="640"
                                        alt="{{$brand->getWithLocale($lang)->title ?? ""}}"
                                    />
                                </div>
                            @endforeach

                            <div class=""></div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-xl-6 ps-lg-10 ps-xl-16">
                        <div class="row">
                            <h2 class="fs-3 mb-10 mb-md-11">{{$brand->getWithLocale($lang)->title_first ?? ''}}</h2>
                            <div class="mb-11">
                                <div class="d-flex align-items-start">
                                    <div class="d-none">
                                        <svg class="icon fs-2">
                                            <use xlink:href="#"></use>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="fs-6 mb-2 pb-4">
                                            <p class="mb-2 pb-4 fs-6">
                                                {!! $brand->getWithLocale($lang)->text_first ?? '' !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 row">{!! $brand->getWithLocale($lang)->text_center ?? '' !!}</div>
            </div>
        </section>

        <section class="mb-lg-17">
            <div class="container container-xxl">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-5 order-2 order-lg-1 mb-15 mb-lg-0">
                        <div class="row">
                            <h2 class="fs-3 mb-10">{{$brand->getWithLocale($lang)->title_second ?? ''}}</h2>
                            <div class="mb-12 mb-13">
                                <div class="d-flex align-items-start">
                                    <div class="d-none">
                                        <svg class="icon fs-2">
                                            <use xlink:href="#"></use>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="fs-6 mb-2 pb-4">
                                            <p class="mb-2 pb-4 fs-6">
                                                {!! $brand->getWithLocale($lang)->text_second ?? '' !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-lg-7 order-1 order-lg-2 mb-12 mb-lg-0 d-flex brand_video"
                    >

                        <iframe
                            class="w-100"
                            src="https://www.youtube.com/embed/{{$brand->video_link}}"
                            title="{{$brand->getWithLocale($lang)->title ?? ""}}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen
                        ></iframe>

                        <div class=""></div>
                    </div>
                </div>
            </div>
        </section>
        <div class="border-top w-100 h-1px"></div>
        <section class="container pt-15 pb-12 pt-lg-17 pb-lg-20">
            <div class="collapse-tabs">
                <ul
                    class="nav nav-tabs border-0 justify-content-center pb-12 d-none d-md-flex"
                    id="productTabs"
                    role="tablist"
                >
                    <!-- FOREACH THIS -->
                    @foreach($brand->product_types as $type)
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link m-auto fw-semibold py-0 px-8 fs-5 border-0 text-body-emphasis active"
                                id="{{$type->id}}-details-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#product{{$type->id}}"
                                type="button"
                                role="tab"
                                aria-controls="{{$type->id}}"
                                aria-selected="true"
                            >
                                {{$type->getWithLocale($lang)->title ?? ""}}
                            </button>
                        </li>
                    @endforeach


                </ul>
                <div class="tab-content">
                    <div class="tab-inner">
                        <!-- FOREACH THIS -->
                        <div
                            class="tab-pane fade active show"
                            id="{{$type->id}}"
                            role="tabpanel"
                            aria-labelledby="{{$type->id}}-tab"
                            tabindex="0"
                        >
                            <div class="card border-0 bg-transparent">
                                <div
                                    class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none"
                                >
                                    <h5 class="mb-0">
                                        <button
                                            class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{$type->id}}"
                                            aria-expanded="false"
                                            aria-controls="collapse-{{$type->id}}"
                                        >
                                            Hair color
                                        </button>
                                    </h5>
                                </div>
                                <div
                                    class="collapse show border-md-0 border p-md-0 p-6"
                                    id="collapse-{{$type->id}}"
                                >
                                    <div class="row gy-11">
                                        @include('client.app.partials._products', ['products' => $products, 'check' => 0])

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


@endsection
@section('scripts')
    
     {!! $brand->seo_scripts !!}
@endsection