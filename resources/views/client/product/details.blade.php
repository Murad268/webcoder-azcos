@extends('client.app.app')
@section('seo_meta')
    {!! $product->seo_links !!}
    <meta name="description" content="{{$product->getWithLocale($lang)->meta_description ?? ""}}" />
    <meta name="keywords" content="{{$product->getWithLocale($lang)->meta_keywords ?? ""}}" />
    <title>{{$product->getWithLocale($lang)->seo_title ?? ""}}</title>
@endsection
@section('content')
    <main id="content" class="wrapper layout-page">
        <section class="z-index-2 position-relative pb-2 mb-12">
            <div class="bg-body-secondary mb-3">
                <div class="container">
                    <nav class="py-4 lh-30px" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center py-1 mb-0">
                            <li class="breadcrumb-item">
                                <a title="Home" href="../index.html">{{TranslateUtility::getTranslate('breadcrumb', 'home', $lang)}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a title="Shop" href="../shop/shop-layout-v2.html">{{TranslateUtility::getTranslate('breadcrumb', 'products', $lang)}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{$product->getWithLocale($lang)->title ?? ""}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section class="container pt-6 pb-14 pb-lg-20">
            <div class="row">
                <div class="col-md-6 pe-lg-13">
                    <div class="position-relative">
                        <div class="position-relative">
                            <div
                                class="position-absolute z-index-2 w-100 d-flex justify-content-end align-items-center"
                            >
                                <div class="p-6">
                                    <a
                                        href="https://www.youtube.com/watch?v={{$product->video_link}}"
                                        class="view-video d-flex align-items-center justify-content-center mt-5 product-gallery-action rounded-circle"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="left"
                                        data-bs-title="Play Video"
                                    >
                                        <svg class="icon fs-4">
                                            <use xlink:href="#icon-Play"></use>
                                        </svg>
                                    </a>
                                </div>
                                @foreach($product->images->where('model_type', 'color_image') as $image)
                                    <img src="#" alt="" data-src="{{asset('storage/'.$image->image_url)}}" class="img-fluid lazy-image color_palet_img" style="width: 85px !important; height: 85px !important;"/>
                                @endforeach
                            </div>
                        </div>
                        <div
                            id="slider"
                            class="slick-slider slick-slider-arrow-inside slick-slider-dots-inside slick-slider-dots-light g-0"
                            data-slick-options="{&#34;arrows&#34;:false,&#34;asNavFor&#34;:&#34;#slider-thumb&#34;,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}"
                        >
                            @foreach($product->images->where('model_type', 'images') as $image)
                                <a
                                    href="{{asset('storage/'.$image->image_url)}}"
                                    data-gallery="gallery1"
                                    class="position-relative"
                                ><img
                                        src="#"
                                        data-src="{{asset('storage/'.$image->image_url)}}"
                                        class="h-auto lazy-image"
                                        width="540"
                                        height="720"
                                        alt=" {{$product->getWithLocale($lang)->title ?? ""}}"
                                    />
                                    </a>
                            @endforeach


                        </div>
                    </div>
                    <div class="mt-6">
                        <div
                            id="slider-thumb"
                            class="slick-slider slick-slider-thumb ps-1 ms-n3 me-n4"
                            data-slick-options="{&#34;arrows&#34;:false,&#34;asNavFor&#34;:&#34;#slider&#34;,&#34;dots&#34;:false,&#34;focusOnSelect&#34;:true,&#34;slidesToShow&#34;:5,&#34;vertical&#34;:false}"
                        >
                            @foreach($product->images->where('model_type', 'images') as $image)
                                <img
                                    src="#"
                                    data-src="{{asset('storage/'.$image->image_url)}}"
                                    class="mx-3 px-0 h-auto cursor-pointer lazy-image"
                                    width="75"
                                    height="100"
                                    alt="{{$product->getWithLocale($lang)->title ?? ""}}"
                                />
                            @endforeach


                        </div>
                    </div>
                </div>
                <div class="col-md-6 pt-md-0 pt-10">
                    <!-- <p class="d-flex align-items-center mb-6">
                                <span class="text-decoration-line-through"
                                    >39.00</span
                                >
                                <span
                                    class="fs-18px text-body-emphasis ps-6 fw-bold"
                                    >29.00</span
                                >
                                <span
                                    class="badge text-bg-primary fs-6 fw-semibold ms-7 px-6 py-3"
                                    >20%</span
                                >
                            </p> -->
                    <h1 class="mb-4 pb-2 fs-4">{{$product->getWithLocale($lang)->title ?? ""}}</h1>
                      <!-- <div class="d-flex align-items-center fs-15px mb-6">
                                <p class="mb-0 fw-semibold text-body-emphasis">
                                    4.86
                                </p>
                                <div
                                    class="d-flex align-items-center fs-12px justify-content-center mb-0 px-6 rating-result"
                                >
                                    <div class="rating">
                                        <div class="empty-stars">
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                        </div>
                                        <div
                                            class="filled-stars"
                                            style="width: 100%"
                                        >
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="border-start ps-6 text-body">
                                    Read 2947 reviews
                                </a>
                            </div> -->
                    <p class="fs-15px">
                        {{$product->getWithLocale($lang)->subtitle ?? ""}}
                    </p>
                
                    <p class="mb-4 pb-2">
                        <span class="text-body-emphasis">
                            <svg class="icon fs-5 me-4 pe-2 align-text-bottom">
                                <use xlink:href="#icon-eye-light"></use>
                            </svg>

                           
                            {{$product->views_count}}
                        </span>
                            {{TranslateUtility::getTranslate('product_page', 'people_viewed', $lang)}}
                    </p>

                    <ul class="single-product-meta list-unstyled border-top pt-7 mt-7">
                        <li class="d-flex mb-4 pb-2 align-items-center">
                            <span class="text-body-emphasis fw-semibold fs-14px">{{TranslateUtility::getTranslate('product_page', 'product_code', $lang)}}:</span>
                            <span class="ps-4">{{$product->product_code}}</span>
                        </li>
                        <li class="d-flex mb-4 pb-2 align-items-center">
                            <span class="text-body-emphasis fw-semibold fs-14px">{{TranslateUtility::getTranslate('product_page', 'brands', $lang)}}:</span>
                            <span class="ps-4">{{$product->brand->getWithLocale($lang)->title ?? ""}}</span>
                        </li>
                    </ul>
                            <span class="text-body-emphasis fw-semibold fs-14px">{{TranslateUtility::getTranslate('product_page', 'product_details', $lang)}}:</span>
                             <div class="mt-4">
                                {!! $product->getWithLocale($lang)->product_detail_text ?? "" !!}
                            </div>
                            <div class="mt-10">
                                {!! $product->getWithLocale($lang)->text ?? "" !!}
                            </div>
                      
                       <!-- <ul
                                class="list-inline d-flex justify-content-start mb-0 fs-6"
                            >
                                <li class="list-inline-item">
                                    <a
                                        class="text-body text-decoration-none product-info-share product-info-share"
                                        href="#"
                                        ><i class="fab fa-facebook-f me-4"></i>
                                        Facebook</a
                                    >
                                </li>
                                <li class="list-inline-item ms-7">
                                    <a
                                        class="text-body text-decoration-none product-info-share product-info-share"
                                        href="#"
                                        ><i class="fab fa-instagram me-4"></i>
                                        Instagram</a
                                    >
                                </li>
                                <li class="list-inline-item ms-7">
                                    <a
                                        class="text-body text-decoration-none product-info-share product-info-share"
                                        href="#"
                                        ><i class="fab fa-youtube me-4"></i>
                                        Youtube</a
                                    >
                                </li>
                            </ul> -->
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
                    <li class="nav-item" role="presentation">
                       {{-- <button
                            class="nav-link m-auto fw-semibold py-0 px-8 fs-4 fs-lg-3 border-0 text-body-emphasis active"
                            id="product-details-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#product-details"
                            type="button"
                            role="tab"
                            aria-controls="product-details"
                            aria-selected="true"
                        >
                        
                            {{TranslateUtility::getTranslate('product_page', 'product_desc', $lang)}}
                        </button> --}}
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link m-auto fw-semibold py-0 px-8 fs-4 fs-lg-3 border-0 text-body-emphasis active"
                            id="how-to-use-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#how-to-use"
                            type="button"
                            role="tab"
                            aria-controls="how-to-use"
                            aria-selected="true"
                        >
                            {{TranslateUtility::getTranslate('product_page', 'how_to_use', $lang)}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link m-auto fw-semibold py-0 px-8 fs-4 fs-lg-3 border-0 text-body-emphasis"
                            id="ingredients-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#ingredients"
                            type="button"
                            role="tab"
                            aria-controls="ingredients"
                            aria-selected="false"
                            tabindex="-1"
                        >
                            {{TranslateUtility::getTranslate('product_page', 'ingredients', $lang)}}
                      </button>
                  </li>
              </ul>
              <div class="tab-content">
                  <div class="tab-inner">
                      <div
                          class="tab-pane fade active show"
                          id="product-details"
                          role="tabpanel"
                          aria-labelledby="product-details-tab"
                          tabindex="0"
                        >
                         {{--    <div class="card border-0 bg-transparent">
                              <div
                                  class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none"
                              >
                                  <h5 class="mb-0">
                                      <button
                                          class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary"
                                          type="button"
                                          data-bs-toggle="collapse"
                                          data-bs-target="#collapse-product-detail"
                                          aria-expanded="false"
                                          aria-controls="collapse-product-detail"
                                      >
                                          {{TranslateUtility::getTranslate('product_page', 'product_details', $lang)}}
                                        </button>
                                    </h5>
                                </div>
                               <div
                                    class="collapse show border-md-0 border p-md-0 p-6"
                                    id="collapse-product-detail"
                                >
                                    <div class="pb-3">
                                        {!! $product->getWithLocale($lang)->text ?? "" !!}
                                    </div>
                                </div> 
                            </div> --}}
                        </div>
                        <div
                            class="tab-pane fade active show"
                            id="how-to-use"
                            role="tabpanel"
                            aria-labelledby="how-to-use-tab"
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
                                            data-bs-target="#collapse-to-use"
                                            aria-expanded="false"
                                            aria-controls="collapse-to-use"
                                        >
                                            {{TranslateUtility::getTranslate('product_page', 'how_to_use', $lang)}}
                                        </button>
                                    </h5>
                                </div>
                                <div
                                    class="collapse border-md-0 border p-md-0 p-6 show"
                                    id="collapse-to-use"
                                >
                                    <div class="d-flex justify-content-between w-100" style="gap: 10px;">
                                        @foreach($product->images->where('model_type', 'product_details_images') as $image)
                                            <div class="d-block" style="flex: 1;">
                                                <img
                                                    src="#"
                                                    data-src="{{asset('storage/'.$image->image_url)}}"
                                                    class="w-100 h-100 object-fit-cover lazy-image"
                                                    alt="{{$product->getWithLocale($lang)->title ?? ""}}"
                                                    width="470"
                                                    height="540"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="pb-3 mt-8 pt-12 pt-lg-0 howToUse">
                                        {!! $product->getWithLocale($lang)->how_to_use ?? "" !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="ingredients"
                            role="tabpanel"
                            aria-labelledby="ingredients-tab"
                            tabindex="0"
                        >
                            <div
                                class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none"
                            >
                                <h5 class="mb-0">
                                    <button
                                        class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-ingredients"
                                        aria-expanded="false"
                                        aria-controls="collapse-ingredients"
                                    >
                                        {{TranslateUtility::getTranslate('product_page', 'ingredients', $lang)}}
                                    </button>
                                </h5>
                            </div>
                            <div
                                class="collapse border-md-0 border p-md-0 p-6"
                                id="collapse-ingredients"
                            >
                                <div class="pb-3">
                                    {!! $product->getWithLocale($lang)->ingredients ?? "" !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="border-top w-100 h-1px"></div>
        <section class="container pt-15 pb-15">
{{--            <div--}}
{{--                class="flex-grow-1 flex-shrink-1 flex-basis-0 img-magnifier-container"--}}
{{--            >--}}
{{--                <img--}}
{{--                    data-src="./assets/images/products/color-palet.png"--}}
{{--                    width="1170"--}}
{{--                    height="700"--}}
{{--                    id="colorPalet"--}}
{{--                    alt=""--}}
{{--                    class="lazy-image w-100 h-100 d-block object-fit-cover"--}}
{{--                    src="#"--}}
{{--                />--}}
{{--            </div>--}}
            <div class="container pt-15 pt-lg-17">
                <div class="text-center">
                    <h2 class="mb-12"> {{TranslateUtility::getTranslate('product_page', 'related_products_title', $lang)}}</h2>
                </div>

               @include('client.app.partials._related_products')
            </div>
        </section>
    </main>
@endsection
@section('scripts')
    
     {!! $product->seo_scripts !!}
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var productId = {{ $product->id }};
            
            $.ajax({
                url: "{{ route('products.increment_views') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId
                },
                success: function(response) {
                        console.log(response)

                   
                },
                error: function(response) {
                        console.log(response)

                }
            });
        });
    </script>
@endsection