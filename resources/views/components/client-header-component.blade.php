    <header id="header" class="header header-sticky header-sticky-smart disable-transition-all z-index-5">
        <!-- <div class="topbar bg-primary">
            <div class="container-wide container">
                <p class="mb-0 text-white text-center p-4 fs-15px fw-bold ls-1 text-uppercase">
                    Free shipping on all U.S. orders $50+
                </p>
            </div>
        </div> -->
        <div class="sticky-area">
            <div class="main-header nav navbar bg-body navbar-light navbar-expand-xl py-6 py-xl-0">
                <div class="container-xxl container">
                    <div class="d-flex d-xl-none w-100">
                        <div class="w-72px d-flex d-xl-none">
                            <button class="navbar-toggler align-self-center border-0 shadow-none px-0 canvas-toggle p-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasNavBar" aria-controls="offCanvasNavBar" aria-expanded="false" aria-label="Toggle Navigation">
                                <span class="fs-24 toggle-icon"></span>
                            </button>
                        </div>

                        <div class="d-flex mx-auto">
                            <a href="./" class="d-block logo">
                                @foreach($settings->images->where('model_type', 'settings_dark') as $image)
                                <img class="light-mode-img object-fit-cover w-100 h-100" src="{{asset('storage/'.$image->image_url)}}" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates" />
                                @endforeach
                                @foreach($settings->images->where('model_type', 'settings_light') as $image)
                                <img class="dark-mode-img object-fit-cover w-100 h-100" src="{{asset('storage/'.$image->image_url)}}" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates" />
                                @endforeach

                            </a>
                        </div>
                        <div class="icons-actions d-flex justify-content-end align-items-center w-xl-50 fs-28px text-body-emphasis w-72px">
                            <div class="px-xl-5 d-inline-block">
                                <a class="lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="offcanvas" data-bs-target="#searchModal" aria-controls="searchModal" aria-expanded="false">
                                    <svg class="icon icon-magnifying-glass-light">
                                        <use xlink:href="#icon-magnifying-glass-light"></use>
                                    </svg>
                                </a>
                            </div>

                            <div class="color-modes position-relative ps-5">
                                <a class="bd-theme btn btn-link nav-link dropdown-toggle d-inline-flex align-items-center justify-content-center text-primary p-0 position-relative rounded-circle" href="#" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (light)">
                                    <svg class="bi my-1 theme-icon-active">
                                        <use href="#sun-fill"></use>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end fs-14px" data-bs-popper="static">
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#sun-fill"></use>
                                            </svg>
                                            Light
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#moon-stars-fill"></use>
                                            </svg>
                                            Dark
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#circle-half"></use>
                                            </svg>
                                            Auto
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-xl-flex flex-column flex-xl-row w-100">
                        <div class="w-auto w-xl-50 d-flex align-items-center">
                            <div class="icons-actions d-flex justify-content-end w-xl-50 fs-28px text-body-emphasis">
                                <form action="{{route('front.site.search', ['lang' => $lang])}}" method="get" class="search-box-2 w-60">
                                    <div class="position-relative">
                                        <input type="text" name="s" class="form-control form-control bg-transparent pe-12 lh-1 py-5" placeholder="{{TranslateUtility::getTranslate('site', 'search_results', $lang)}}" />
                                        <button class="position-absolute pos-fixed-right-center bg-transparent border-0 px-0 fs-4 px-6 top-0 bottom-0 end-0 my-auto z-index-3 text-body-emphasis" type="submit">
                                            <svg class="icon fs-18px mt-n3">
                                                <use xlink:href="#search"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <ul class="navbar-nav w-100 w-xl-auto">
{{--                                <li class="nav-item pageLinks transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover dropdown-fullwidth">--}}
{{--                                    <a class="nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px" href="./index.html" data-bs-toggle="dropdown" id="menu-item-home" aria-haspopup="true" aria-expanded="false">{{TranslateUtility::getTranslate('navbar_menu', 'home', $lang)}}</a>--}}
{{--                                </li>--}}

                                <li class="nav-item pageLinks transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover dropdown-fullwidth position-static">
                                    <a class="my-navbar nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px" href="{{ route('front.about.index', ['lang' => $lang]) }}" id="menu-item-shop">
                                        {{ TranslateUtility::getTranslate('navbar_menu', 'about', $lang) }}
                                    </a>
                                </li>

                                <li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover">
                                    <a class="my-navbar nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px" href="{{ route('front.product.index', ['lang' => $lang]) }}" id="menu-item-shop">
                                        {{TranslateUtility::getTranslate('navbar_menu', 'shop', $lang)}}
                                    </a>
{{--                                    <ul class="dropdown-menu py-6" aria-labelledby="menu-item-pages">--}}
{{--                                        <li class="dropend dropdown-hover" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            <a class="dropdown-item pe-6 dropdown-toggle d-flex justify-content-between border-hover" href="#" data-bs-toggle="dropdown" id="menu-item-blog">--}}
{{--                                                <span class="border-hover-target"> Blog </span>--}}
{{--                                            </a>--}}
{{--                                            <ul class="dropdown-menu py-6" aria-labelledby="menu-item-blog" data-bs-popper="none">--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./blog/grid.html">--}}
{{--                                                        <span class="border-hover-target">Blog Grid</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./blog/grid-sidebar.html">--}}
{{--                                                        <span class="border-hover-target">Blog Grid Sidebar</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./blog/masonry.html">--}}
{{--                                                        <span class="border-hover-target">Blog Masonsy</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./blog/list.html">--}}
{{--                                                        <span class="border-hover-target">Blog List</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./blog/classic.html">--}}
{{--                                                        <span class="border-hover-target">Blog Classic</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li class="dropdown-divider"></li>--}}

{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./blog/details-01.html">--}}
{{--                                                        <span class="border-hover-target">Blog Details 01</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./blog/details-02.html">--}}
{{--                                                        <span class="border-hover-target">Blog Details 02</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="dropdown-divider"></li>--}}
{{--                                        <li class="dropend dropdown-hover" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            <a class="dropdown-item pe-6 dropdown-toggle d-flex justify-content-between border-hover" href="#" data-bs-toggle="dropdown" id="menu-item-about-us">--}}
{{--                                                <span class="border-hover-target"> About Us </span>--}}
{{--                                            </a>--}}
{{--                                            <ul class="dropdown-menu py-6" aria-labelledby="menu-item-about-us" data-bs-popper="none">--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./about-us-01.html">--}}
{{--                                                        <span class="border-hover-target">About Us 01</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./about-us-02.html">--}}
{{--                                                        <span class="border-hover-target">About Us 02</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="dropend dropdown-hover" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            <a class="dropdown-item pe-6 dropdown-toggle d-flex justify-content-between border-hover" href="#" data-bs-toggle="dropdown" id="menu-item-contact-us">--}}
{{--                                                <span class="border-hover-target"> Contact us </span>--}}
{{--                                            </a>--}}
{{--                                            <ul class="dropdown-menu py-6" aria-labelledby="menu-item-contact-us" data-bs-popper="none">--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./contact-us-01.html">--}}
{{--                                                        <span class="border-hover-target">Contact Us 01</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./contact-us-02.html">--}}
{{--                                                        <span class="border-hover-target">Contact Us 02</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="dropend dropdown-hover" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            <a class="dropdown-item pe-6 dropdown-toggle d-flex justify-content-between border-hover" href="./dashboard/dashboard.html" data-bs-toggle="dropdown" id="menu-item-dashboard">--}}
{{--                                                <span class="border-hover-target"> Dashboard </span>--}}
{{--                                            </a>--}}
{{--                                            <ul class="dropdown-menu py-6" aria-labelledby="menu-item-dashboard" data-bs-popper="none">--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/dashboard.html">--}}
{{--                                                        <span class="border-hover-target">Dashboard</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/product-grid.html">--}}
{{--                                                        <span class="border-hover-target">Products</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/order-list.html">--}}
{{--                                                        <span class="border-hover-target">Orders</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/sellers-cards.html">--}}
{{--                                                        <span class="border-hover-target">Sellers</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/add-product-1.html">--}}
{{--                                                        <span class="border-hover-target">Add Product</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/transactions-1.html">--}}
{{--                                                        <span class="border-hover-target">Transaction</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/reviews.html">--}}
{{--                                                        <span class="border-hover-target">Reviews</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/brands.html">--}}
{{--                                                        <span class="border-hover-target">Brands</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item border-hover" href="./dashboard/profile-settings.html">--}}
{{--                                                        <span class="border-hover-target">Settings</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item pe-6 border-hover" href="./faqs.html">--}}
{{--                                                <span class="border-hover-target"> FAQs </span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item pe-6 border-hover" href="./find-a-store.html">--}}
{{--                                                <span class="border-hover-target"> Store </span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item pe-6 border-hover" href="./404.html">--}}
{{--                                                <span class="border-hover-target"> 404 </span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
                                </li>
                            </ul>
                        </div>
                        <div class="d-none d-xl-flex align-items-center">
                            <a href="{{route('front.index', ['lang' => $lang])}}" class="d-block logo">
                                @foreach($settings->images->where('model_type', 'settings_dark') as $image)
                                <img class="light-mode-img object-fit-cover w-100 h-100" src="{{asset('storage/'.$image->image_url)}}" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates" />
                                @endforeach
                                @foreach($settings->images->where('model_type', 'settings_light') as $image)
                                <img class="dark-mode-img object-fit-cover w-100 h-100" src="{{asset('storage/'.$image->image_url)}}" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates" />
                                @endforeach</a>
                        </div>
                        <div class="w-auto w-xl-50 d-flex align-items-center">
                            <ul class="navbar-nav w-100 w-xl-auto">
                                <li class="nav-item pageLinks transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover dropdown-fullwidth position-static">
                                    <a class="my-navbar nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px" href="{{ route('front.blog.index', ['lang' => $lang]) }}" id="menu-item-shop">
                                        {{ TranslateUtility::getTranslate('navbar_menu', 'blogs', $lang) }}
                                    </a>
                                </li>

                                <li class="nav-item pageLinks transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover dropdown-fullwidth position-static">
                                    <a class="my-navbar nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px" href="{{ route('front.contact.index', ['lang' => $lang]) }}" id="menu-item-shop">
                                        {{ TranslateUtility::getTranslate('navbar_menu', 'contact', $lang) }}
                                    </a>
                                </li>
                            </ul>
                            <div class="w-50 d-flex">
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="dropdown me-10">
                                        <button class="btn btn-link dropdown-toggle fw-semibold text-uppercase ls-1 p-0 dropdown-menu-end fs-13px" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{TranslateUtility::getLang()}}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end py-5" style="min-width: unset">
                                            <!-- FORAECH THIS -->
                                            @foreach($main_langs as $language)
                                            <a href="{{LangChangeUtility::changeLanguage($lang, $language->code)}}" class="dropdown-item py-1" href="#">{{$language->code}}</a>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- <div class="dropdown">
											<button
												class="btn btn-link dropdown-toggle fw-semibold text-uppercase ls-1 p-0 dropdown-menu-end fs-15px"
												type="button"
												data-bs-toggle="dropdown"
												aria-expanded="false"
											>
												USD
											</button>
											<div
												class="dropdown-menu dropdown-menu-end py-5"
												style="min-width: unset"
											>
												<a
													class="dropdown-item py-1"
													href="#"
													>EUR</a
												>
												<a
													class="dropdown-item py-1"
													href="#"
													>GBP</a
												>
												<a
													class="dropdown-item py-1"
													href="#"
													>JPY</a
												>
												<a
													class="dropdown-item py-1"
													href="#"
													>AUD</a
												>
											</div>
										</div> -->
                                </div>
                                <div class="color-modes position-relative ps-5 d-none d-xl-inline-block">
                                    <a class="bd-theme btn btn-link nav-link dropdown-toggle d-inline-flex align-items-center justify-content-center text-primary p-0 position-relative rounded-circle" href="#" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (light)">
                                        <svg class="bi my-1 theme-icon-active">
                                            <use href="#sun-fill"></use>
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end fs-14px" data-bs-popper="static">
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                                                <svg class="bi me-4 opacity-50 theme-icon">
                                                    <use href="#sun-fill"></use>
                                                </svg>
                                                Light
                                                <svg class="bi ms-auto d-none">
                                                    <use href="#check2"></use>
                                                </svg>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                                <svg class="bi me-4 opacity-50 theme-icon">
                                                    <use href="#moon-stars-fill"></use>
                                                </svg>
                                                Dark
                                                <svg class="bi ms-auto d-none">
                                                    <use href="#check2"></use>
                                                </svg>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                                                <svg class="bi me-4 opacity-50 theme-icon">
                                                    <use href="#circle-half"></use>
                                                </svg>
                                                Auto
                                                <svg class="bi ms-auto d-none">
                                                    <use href="#check2"></use>
                                                </svg>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="searchModal" data-bs-scroll="false" class="offcanvas offcanvas-top" style="--bs-offcanvas-height: auto">
        <div class="container-wide container-xxl">
            <nav class="navbar navbar-expand-xl px-0 py-6 py-xl-12 row align-items-start">
                <div class="col-xl-3 d-flex justify-content-center justify-content-xl-start">
                    <a href="./" class="d-lg-inline-block logo">
                        @foreach($settings->images->where('model_type', 'settings_dark') as $image)
                        <img class="light-mode-img object-fit-cover w-100 h-100" src="{{asset('storage/'.$image->image_url)}}" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates" />
                        @endforeach
                        @foreach($settings->images->where('model_type', 'settings_light') as $image)
                        <img class="dark-mode-img object-fit-cover w-100 h-100" src="{{asset('storage/'.$image->image_url)}}" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates" />
                        @endforeach
                    </a>
                </div>
                <div class="col-xl-6 d-flex justify-content-center">
                    <form action="{{route('front.site.search', ['lang' => $lang])}}" class="w-xl-100 w-sm-75 w-100 mt-6 mt-xl-0 px-6 px-xl-0" name="searchbox" id="searchbox">
                        <div class="input-group mx-auto">
                            <input type="text" id="search_text" name="s" class="form-control form-control bg-transparent border-primary" placeholder="Search product" />
                            <div class="form-control-append position-absolute end-0 top-0 bottom-0 d-flex align-items-center">
                                <button class="input-group-text bg-transparent border-0 px-0 me-6" type="submit" id="searchbox_btn" name="searchbox_btn">
                                    <i class="far fa-search fs-5"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="icons-actions col-xl-3 d-flex justify-content-end fs-28px text-body-emphasis">
                    <div class="px-5 d-none d-xl-inline-block">
                        <a class="lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#signInModal">
                            <svg class="icon icon-user-light">
                                <use xlink:href="#icon-user-light"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="px-5 d-none d-xl-inline-block">
                        <a class="position-relative lh-1 color-inherit text-decoration-none" href="./shop/wishlist.html">
                            <svg class="icon icon-star-light">
                                <use xlink:href="#icon-star-light"></use>
                            </svg>
                            <span class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-4 rounded-circle fs-13px p-0 square" style="--square-size: 18px">3</span>
                        </a>
                    </div>
                    <div class="px-5 d-none d-xl-inline-block">
                        <a class="position-relative lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart" aria-controls="shoppingCart" aria-expanded="false">
                            <svg class="icon icon-star-light">
                                <use xlink:href="#icon-shopping-bag-open-light"></use>
                            </svg>
                            <span class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-4 rounded-circle fs-13px p-0 square" style="--square-size: 18px">3</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Mobile Navbar -->
    <div class="navbar position-relative">
        <div id="offCanvasNavBar" class="offcanvas offcanvas-start" style="--bs-offcanvas-width: 310px">
            <div class="d-block logo mx-auto">
                @foreach($settings->images->where('model_type', 'settings_dark') as $image)
                    <img class="light-mode-img object-fit-cover w-100 h-100" src="{{asset('storage/'.$image->image_url)}}" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates" />
                @endforeach
                @foreach($settings->images->where('model_type', 'settings_light') as $image)
                    <img class="dark-mode-img object-fit-cover w-100 h-100" src="{{asset('storage/'.$image->image_url)}}" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates" />
                @endforeach
                <button type="button" class="btn-close btn_close position-absolute" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <hr class="mt-0" />
            <div class="offcanvas-body pt-0 mb-2">
                <ul class="navbar-nav">
                    <li class="nav-item transition-all-xl-1 py-0">
                        <a class="pageLinks nav-link d-flex justify-content-between position-relative text-uppercase fw-semibold ls-1 fs-15px" href="{{ route('front.index', ['lang' => $lang]) }}" data-bs-toggle="dropdown" id="menu-item-home-canvas" aria-haspopup="true" aria-expanded="false"> {{ TranslateUtility::getTranslate('navbar_menu', 'home', $lang) }}</a>
                    </li>
                    <li class="nav-item transition-all-xl-1 py-0 position-static">
                        <a class="pageLinks nav-link d-flex justify-content-between position-relative text-uppercase fw-semibold ls-1 fs-15px" href="{{ route('front.about.index', ['lang' => $lang]) }}" data-bs-toggle="dropdown" id="menu-item-shop-canvas" aria-haspopup="true" aria-expanded="false"> {{ TranslateUtility::getTranslate('navbar_menu', 'about', $lang) }}</a>
                    </li>
                    <li class="nav-item transition-all-xl-1 py-0 position-static">
                        <a class="pageLinks nav-link d-flex justify-content-between position-relative text-uppercase fw-semibold ls-1 fs-15px" href="{{ route('front.product.index', ['lang' => $lang]) }}" data-bs-toggle="dropdown" id="menu-item-shop-canvas" aria-haspopup="true" aria-expanded="false"> {{TranslateUtility::getTranslate('navbar_menu', 'shop', $lang)}}</a>
                    </li>
                    <li class="nav-item transition-all-xl-1 py-0">
                        <a class="pageLinks nav-link d-flex justify-content-between position-relative text-uppercase fw-semibold ls-1 fs-15px" href="{{ route('front.blog.index', ['lang' => $lang]) }}" data-bs-toggle="dropdown" id="menu-item-pages-canvas" aria-haspopup="true" aria-expanded="false"> {{ TranslateUtility::getTranslate('navbar_menu', 'blogs', $lang) }}</a>
                    </li>
                    <li class="nav-item transition-all-xl-1 py-0">
                        <a class="pageLinks nav-link d-flex justify-content-between position-relative text-uppercase fw-semibold ls-1 fs-15px" href="{{ route('front.contact.index', ['lang' => $lang]) }}" data-bs-toggle="dropdown" id="menu-item-blocks-canvas" aria-haspopup="true" aria-expanded="false"> {{ TranslateUtility::getTranslate('navbar_menu', 'contact', $lang) }}</a>
                    </li>
                  
                </ul>
                <div class="w-50 d-flex mob_lang">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="dropdown me-10">
                            <button class="btn btn-link dropdown-toggle fw-semibold text-uppercase ls-1 p-0 dropdown-menu-end fs-13px" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{TranslateUtility::getLang()}}
                            </button>
                            <div class="dropdown-menu dropdown-menu-end py-5" style="min-width: unset">
                                @foreach($main_langs as $language)
                                <a href="{{LangChangeUtility::changeLanguage($lang, $language->code)}}" class="dropdown-item py-1" href="#">{{$language->code}}</a>
                                @endforeach
                            </div>
                        </div>

                        <!-- <div class="dropdown">
								<button
									class="btn btn-link dropdown-toggle fw-semibold text-uppercase ls-1 p-0 dropdown-menu-end fs-15px"
									type="button"
									data-bs-toggle="dropdown"
									aria-expanded="false"
								>
									USD
								</button>
								<div
									class="dropdown-menu dropdown-menu-end py-5"
									style="min-width: unset"
								>
									<a
										class="dropdown-item py-1"
										href="#"
										>EUR</a
									>
									<a
										class="dropdown-item py-1"
										href="#"
										>GBP</a
									>
									<a
										class="dropdown-item py-1"
										href="#"
										>JPY</a
									>
									<a
										class="dropdown-item py-1"
										href="#"
										>AUD</a
									>
								</div>
							</div> -->
                    </div>
                </div>
            </div>
            <hr class="mb-0" />
        
        </div>
    </div>

