<div class="row gy-11">
    @foreach($products as $product)
        @php
        $localeProduct = $product->getWithLocale($lang);
        @endphp

        @if($localeProduct && $localeProduct->slug)
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div
                class="card card-product grid-2 bg-transparent border-0"
                data-animate="fadeInUp"
            >
                @php
                if($product->colorSchemes) {
                    $images = $product->images->where('model_type', 'images')->where('is_main', 1);
                } else {
                    $images = $product->images->where('model_type', 'images');
                }
                @endphp

                @foreach($images as $image)
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        @php
                        $currentUrl = url()->current(); // Get the current URL
                        $queryParams = request()->query(); // Get existing query parameters
                        $queryParams['color'] = $localeProduct->slug ?? ""; // Add new parameter
                        $newUrl = $currentUrl . '?' . http_build_query($queryParams); // Create new URL
                        @endphp

                        @if($product->colorSchemes)
                        <a href="{{ route('front.product.details', ['lang' => $lang, 'slug' => $localeProduct->slug ?? ""]) }}"
                           class="hover-zoom-in d-block"
                           title="{{$localeProduct->title ?? ""}}">
                        @endif

                        @if($product->products)
                        <a href="{{ $newUrl }}"
                           class="hover-zoom-in d-block"
                           title="{{$localeProduct->title ?? ""}}">
                        @endif

                            <img
                                src="#"
                                data-src="{{asset('storage/'.$image->image_url)}}"
                                class="img-fluid lazy-image w-100"
                                alt="{{$localeProduct->title ?? ""}}"
                                width="330"
                                height="440"
                            />
                        </a>

                        @if($product->colorSchemes && $product->brand_id == 4)
                            @foreach($product->images->where('model_type', 'color_image') as $image)
                                <img src="#" alt="" data-src="{{asset('storage/'.$image->image_url)}}" class="img-fluid lazy-image position-absolute color_palet_img"/>
                            @endforeach
                        @endif
                    </figure>
                @endforeach

                <div class="card-body text-center p-0">
                    <h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                        @if($product->colorSchemes)
                        <a style="text-decoration: none"
                           href="{{ route('front.product.details', ['lang' => $lang, 'slug' => $localeProduct->slug ?? ""]) }}">
                            {{$localeProduct->title ?? ""}}
                        </a>
                        @endif

                        @if($product->products)
                        <a style="text-decoration: none"
                           href="{{ $newUrl }}">
                            {{$localeProduct->title ?? ""}}
                        </a>
                        @endif
                    </h4>
                    <div class="d-flex align-items-center fs-12px justify-content-center">
                        <span class="reviews ms-4 pt-3 fs-14px">
                           {{$localeProduct->subtitle ?? ""}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>
