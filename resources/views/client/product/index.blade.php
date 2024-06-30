@extends('client.app.app')
@section('seo_meta')
  {!! \App\Facades\MenuListUtility::getSeoInfo('products')->seo_links !!}
    <meta name="description" content="{{\App\Facades\MenuListUtility::getMenuSeo('products')->meta_description}}" />
    <meta name="keywords" content="{{\App\Facades\MenuListUtility::getMenuSeo('products')->meta_keywords}}" />
    <title>{{\App\Facades\MenuListUtility::getMenuSeo('products')->seo_title}}</title>
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
                                <a href="../index.html">{{TranslateUtility::getTranslate('breadcrumb', 'home', $lang)}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{TranslateUtility::getTranslate('breadcrumb', 'products', $lang)}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- <section class="container container-xxl">
      <div
        class="tool-bar mb-11 align-items-center justify-content-between d-lg-flex"
      >
        <div class="tool-bar-left mb-6 mb-lg-0 fs-18px">
          We found
          <span class="text-body-emphasis fw-semibold">95</span>
          products available for you
        </div>
        <div class="tool-bar-right align-items-center d-flex">
          <ul
            class="list-unstyled d-flex align-items-center list-inline me-lg-7 me-0 mb-0"
          >
            <li class="list-inline-item me-7">
              <a
                class="fs-32px text-body-emphasis-hovertext-body-emphasis"
                href="#"
              >
                <svg class="icon icon-squares-four">
                  <use xlink:href="#icon-squares-four"></use>
                </svg>
              </a>
            </li>
            <li class="list-inline-item me-0">
              <a
                class="fs-32px text-body-emphasis-hover text-muted"
                href="../shop/shop-layout-v5.html"
              >
                <svg class="icon icon-list">
                  <use xlink:href="#icon-list"></use>
                </svg>
              </a>
            </li>
          </ul>
          <ul
            class="list-unstyled d-flex align-items-center list-inline mb-0 ms-auto"
          >
            <li class="list-inline-item me-0">
              <select class="form-select" name="orderby">
                <option selected="selected">Default sorting</option>
                <option value="popularity">Sort by popularity</option>
                <option value="rating">Sort by average rating</option>
                <option value="date">Sort by latest</option>
                <option value="price">Sort by price: low to high</option>
                <option value="price-desc">Sort by price: high to low</option>
              </select>
            </li>
          </ul>
        </div>
      </div>
    </section> -->

        <section class="products py-15">
          <div class="text-center py-13">
                <div class="container">
                    <h2 class="mb-0">{{TranslateUtility::getTranslate('products_page', 'title', $lang)}}</h2>
                </div>
          </div>
          <div class="container container-xxl pb-16 pb-lg-18">
            <div class="row">
                <div class="col-lg-9 order-lg-1">
                    @include('client.app.partials._products', ['products' => $products])

                    <!-- PAGINATION -->
                    <div class="d-flex mt-13 pt-3 justify-content-center" aria-label="pagination" data-animate="fadeInUp">
                            {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
                <div class="col-lg-3 d-lg-block d-none">
                    <div class="position-sticky top-0">
                        <aside
                            class="primary-sidebar pe-xl-9 me-xl-2 mt-12 pt-2 mt-lg-0 pt-lg-0"
                        >
                            <div class="widget widget-product-category">
                                <h4 class="widget-title fs-5 mb-6">{{TranslateUtility::getTranslate('product_page', 'brands_title', $lang)}}</h4>
                                <ul
                                    class="navbar-nav navbar-nav-cate"
                                    id="widget_product_category"
                                >

                                    @foreach($brands as $brand)

                                        <li class="nav-item">
                                            <!-- add active class to this a tag when it's selected -->

                                            <a
                                                title={{$brand->getWithLocale($lang)->title ?? ""}}"
                                                class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center text-uppercase fs-14px fw-semibold letter-spacing-5 active"
                                            >
                                                <span class="text-hover-underline">{{$brand->getWithLocale($lang)->title ?? ""}} </span>
                                                <span
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#cat_skin-care"
                                                    class="caret flex-grow-1 d-flex align-items-center justify-content-end collapsed"
                                                >
                          <svg class="icon">
                            <use xlink:href="#icon-plus"></use>
                          </svg>
                        </span>
                                            </a>
                                            <div
                                                id="categories"
                                                class="collapse"
                                                data-bs-parent="#widget_product_category"
                                            >
                                                <ul class="navbar-nav nav-submenu ps-8">
                                                    @foreach($brand->product_types as $type)
                                                        <li class="nav-item">
                                                            <a
                                                                title="{{$type->getWithLocale($lang)->slug ?? ""}}"
                                                                class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center sub_cat"
                                                                href=""
                                                                data-link = "{{$brand->getWithLocale($lang)->slug ?? ""}}"
                                                            >
                                                                <span class="text-hover-underline">{{$type->getWithLocale($lang)->title ?? ""}}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach


                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach



                                </ul>
                            </div>
                            <!-- <div class="widget widget-product-hightlight">
                                        <h4 class="widget-title fs-5 mb-6">
                                            Hightlight
                                        </h4>
                                        <ul
                                            class="navbar-nav navbar-nav-cate"
                                            id="widget_product_hightlight"
                                        >
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Best Seller"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >Best Seller</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="New Arrivals"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >New Arrivals</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Sale"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >Sale</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Hot Items"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >Hot Items</span
                                                    ></a
                                                >
                                            </li>
                                        </ul>
                                    </div> -->

                            <!-- <div class="widget widget-product-price">
                                        <h4 class="widget-title fs-5 mb-6">
                                            Price
                                        </h4>
                                        <ul
                                            class="navbar-nav navbar-nav-cate"
                                            id="widget_product_price"
                                        >
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="All"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >All</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="$10 - $50"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >$10 - $50</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="$50 - $100"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >$50 - $100</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="$100 - $200"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >$100 - $200</span
                                                    ></a
                                                >
                                            </li>
                                        </ul>
                                    </div> -->

                            <!-- <div class="widget widget-product-size">
                                        <h4 class="widget-title fs-5 mb-6">Size</h4>
                                        <ul
                                            class="navbar-nav navbar-nav-cate"
                                            id="widget_product_size"
                                        >
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Single"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >Single</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="5 Pack"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >5 Pack</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Full size"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >Full size</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Mini size"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="text-hover-underline"
                                                        >Mini size</span
                                                    ></a
                                                >
                                            </li>
                                        </ul>
                                    </div> -->

                            <!-- <div class="widget widget-product_colors">
                                        <h4 class="widget-title fs-5 mb-6">
                                            Colors
                                        </h4>
                                        <ul
                                            class="navbar-nav navbar-nav-cate"
                                            id="widget_product_colors"
                                        >
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Black"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="square rounded-circle me-4"
                                                        style="
                                                            background-color: #000000;
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-hover-underline"
                                                        >Black</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="White"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="square rounded-circle me-4"
                                                        style="
                                                            background-color: #ffffff;
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-hover-underline"
                                                        >White</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Pink"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="square rounded-circle me-4"
                                                        style="
                                                            background-color: #0e328e;
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-hover-underline"
                                                        >Pink</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Maroon"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="square rounded-circle me-4"
                                                        style="
                                                            background-color: #672612;
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-hover-underline"
                                                        >Maroon</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Red"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="square rounded-circle me-4"
                                                        style="
                                                            background-color: #c71818;
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-hover-underline"
                                                        >Red</span
                                                    ></a
                                                >
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    href="#"
                                                    title="Dark Heathe"
                                                    class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                    ><span
                                                        class="square rounded-circle me-4"
                                                        style="
                                                            background-color: #5e5e5e;
                                                        "
                                                    ></span>
                                                    <span
                                                        class="text-hover-underline"
                                                        >Dark Heathe</span
                                                    ></a
                                                >
                                            </li>
                                        </ul>
                                    </div> -->

                            <div class="widget widget-{{TranslateUtility::getTranslate('site', 'tags', $lang)}}">
                                <h4 class="widget-title fs-5 mb-6">{{TranslateUtility::getTranslate('site', 'tags', $lang)}}</h4>
                                <ul class="w-100 mt-n4 list-unstyled d-flex flex-wrap mb-0">
                                    @foreach($tags as $tag)
                                        <li class="me-6 mt-4">
                                            <a
                                                href="{{route('front.product.index', ['lang' => $lang, 'tag' => $tag->getWithLocale($lang)->slug ?? "" ])}}"
                                                title="Cleansing"
                                                class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline"
                                            >#{{$tag->getWithLocale($lang)->tag ?? ""}}</a
                                            >
                                        </li>

                                    @endforeach


                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
          </div>
        </section>
    </main>
@endsection

@section('scripts')

<script>
    document.querySelectorAll('.sub_cat').forEach(item => {
        item.addEventListener('click', (e) => {
            let currentUrl = new URL(window.location.href);

            // `color` sorğusunu sil
            if (currentUrl.searchParams.has('color')) {
                currentUrl.searchParams.delete('color');
            }

            // `page` sorğusunu sil
            if (currentUrl.searchParams.has('page')) {
                currentUrl.searchParams.delete('page');
            }

            currentUrl.searchParams.set('brand', item.getAttribute('data-link'));
            window.location.href = currentUrl.href;
        });
    });
</script>


@endsection
@section('scripts')
    
     {!! \App\Facades\MenuListUtility::getSeoInfo('products')->seo_scripts !!}
@endsection