
          <div
            class="slick-slider"
            data-slick-options="{&#34;arrows&#34;:true,&#34;centerMode&#34;:true,&#34;centerPadding&#34;:&#34;calc((100% - 1440px) / 2)&#34;,&#34;dots&#34;:true,&#34;infinite&#34;:true,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1200,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:3}},{&#34;breakpoint&#34;:992,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:2}},{&#34;breakpoint&#34;:576,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}}],&#34;slidesToShow&#34;:4}"
          >
            <!-- FOREACH THIS -->
            @foreach($products as $product)

        @if($product->getWithLocale($lang)->slug)
        <div class="mb-6">
              <div class="card card-product grid-2 bg-transparent border-0">
              @foreach($product->images->where('model_type', 'images')->where('is_main', 1) as $image)
                 <figure
                  class="card-img-top position-relative mb-7 overflow-hidden"
                >
                  <a
                    href="{{ route('front.product.details', ['lang' => $lang, 'slug' => $product->getWithLocale($lang)->slug ?? ""]) }}"
                    class="hover-zoom-in d-block"
                    title="$product->getWithLocale($lang)->title ?? """
                  >
                    <img
                      src="#"
                      data-src="{{asset('storage/'.$image->image_url)}}"
                      class="img-fluid lazy-image w-100"
                      alt="{{$product->getWithLocale($lang)->title ?? ""}}"
                      width="330"
                      height="440"
                    />
                  </a>

                  <!-- <div
									class="position-absolute product-flash z-index-2"
								>
									<span
										class="badge badge-product-flash on-sale bg-primary"
									>
										-25%
									</span>
								</div> -->
                </figure>

              @endforeach
             

                <div class="card-body text-center p-0">
                  <!-- <span
									class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6"
								>
									<del class="text-body fw-500 me-4 fs-13px"
										>$40.00</del
									>
									<ins class="text-decoration-none"
										>$30.00</ins
									>
								</span> -->

                  <h4
                    class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"
                  >
                    <a
                      class="text-decoration-none text-reset"
                      href="{{ route('front.product.details', ['lang' => $lang, 'slug' => $product->getWithLocale($lang)->slug ?? ""]) }}"
                    >
                      {{$product->getWithLocale($lang)->title ?? ""}}
                    </a>
                  </h4>
                </div>
              </div>
            </div>
        @endif
              
         
            @endforeach
          </div>