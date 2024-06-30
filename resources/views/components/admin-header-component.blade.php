@section('links')
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .nav-link-text {
            color: red !important;
        }
    </style>
@endsection

<nav class="navbar navbar-vertical navbar-expand-lg">
    <script>
        var navbarStyle = window.config.config.phoenixNavbarStyle;
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        @if (!request()->routeIs('admin.lang*'))
            <div class="d-flex">
                @foreach($main_langs as $language)
                    <a class="btn btn-light" href="{{ LangChangeUtility::changeLanguageInAdmin($lang, $language->code) }}" class="dropdown-item py-1">{{ $language->code }}</a>
                @endforeach
            </div>
        @endif

        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-home" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-home">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon">
                                    <span class="fas fa-caret-right"></span>
                                </div>
                                <span class="nav-link-icon">
                                    <span data-feather="globe"></span>
                                </span>

                                <span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'lang_and_translates', $lang)}}</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-home">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.lang.index') ? 'active' : '' }}" href="{{route('admin.lang.index')}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'langs', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.translates.index') ? 'active' : '' }}" href="{{route('admin.translates.index', $lang)}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'translates', $lang)}}</span></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-seo" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-seo">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon">
                                    <span class="fas fa-caret-right"></span>
                                </div>
                                <span class="nav-link-icon">
                                    <span data-feather="search"></span>
                                </span>
                                <span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'seo', $lang)}}</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-seo">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.menu.index') ? 'active' : '' }}" href="{{route('admin.menu.index', $lang)}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'menu', $lang)}}</span></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-products" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-products">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon">
                                    <span class="fas fa-caret-right"></span>
                                </div>
                                <span class="nav-link-icon">
                                       <span data-feather="package"></span>
                                </span>
                                <span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'products', $lang)}}</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-products">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index', $lang) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'brands', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.brands.index') ? 'active' : '' }}" href="{{route('admin.brands.index', $lang)}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'product_types', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{route('admin.products.index', $lang)}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'products', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.color_schemes.index') ? 'active' : '' }}" href="{{route('admin.color_schemes.index', $lang)}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'color_tones', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.tag.index') ? 'active' : '' }}" href="{{route('admin.tag.index', $lang)}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'product_tags', $lang)}}</span></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-info" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-info">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon">
                                    <span class="fas fa-caret-right"></span>
                                </div>
                                <span class="nav-link-icon">
                                     <span data-feather="info"></span>
                                </span>
                                <span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'info', $lang)}}</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-info">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.about.edit') ? 'active' : '' }}" href="{{ route('admin.about.edit', ['lang' => $lang, 'about' => 1]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'about', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.team.index') ? 'active' : '' }}" href="{{ route('admin.team.index', ['lang' => $lang]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'our_team', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.edit') ? 'active' : '' }}" href="{{ route('admin.settings.edit', ['lang' => $lang, 'setting' => 1]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'parameters', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.faq.index') ? 'active' : '' }}" href="{{ route('admin.faq.index', ['lang' => $lang]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'faq', $lang)}}</span></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-contact" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-contact">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon">
                                    <span class="fas fa-caret-right"></span>
                                </div>
                                <span class="nav-link-icon">
                                    <span data-feather="mail"></span>
                                </span>
                                <span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'contact', $lang)}}</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-contact">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.number.index') ? 'active' : '' }}" href="{{ route('admin.number.index', ['lang' => $lang]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'phone_numbers', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.email.index') ? 'active' : '' }}" href="{{ route('admin.email.index', ['lang' => $lang]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'emails', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.address.index') ? 'active' : '' }}" href="{{ route('admin.address.index', ['lang' => $lang]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'addresses', $lang)}}</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.socials.edit') ? 'active' : '' }}" href="{{ route('admin.socials.edit', ['lang' => $lang, 'social' => 1]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'social_networks', $lang)}}</span></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-blog" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-blog">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon">
                                    <span class="fas fa-caret-right"></span>
                                </div>
                                <span class="nav-link-icon">
                                     <span data-feather="file-text"></span>
                                </span>
                                <span class="nav-link-text">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'blogs', $lang)}}</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-blog">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.blog_category.index') ? 'active' : '' }}" href="{{ route('admin.blog_category.index', ['lang' => $lang]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Bloq kateqoriyaları</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.blog_tag.index') ? 'active' : '' }}" href="{{ route('admin.blog_tag.index', ['lang' => $lang]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Bloq teqləri</span></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.blogs.index') ? 'active' : '' }}" href="{{ route('admin.blogs.index', ['lang' => $lang]) }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Bloqlar</span></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <a href="{{route('admin.auth.logout')}}" style="height: 2rem" class="navbar-vertical-footer"><button class="btn border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center">
            <span class="uil uil-left-arrow-to-left fs-8"></span>
            <span class="uil uil-arrow-from-right fs-8"></span>
            <span class="navbar-vertical-footer-text ms-2">{{TranslateUtility::getTranslate('admin_panel_sidebar', 'logout', $lang)}} et</span>
        </button></a>
</nav>
<nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">
            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="index-1.html">
                <div class="d-flex align-items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="73" height="42" viewBox="0 0 73 42">
                                    <g fill="none" fill-rule="evenodd">
                                        <path fill="#FAAF3A" d="M.144 21.169h17.77v2.197H.144z"></path>
                                        <path fill="#8BC540" d="M53.563 5.197l1.546-1.553 17.76 17.853-1.545 1.553z"></path>
                                        <path fill="#8BC540" d="M53.545 21.492l17.76-17.854 1.546 1.554L55.09 23.045z"></path>
                                        <g fill="#000">
                                            <path d="M4.635 41.759H3.53L1.273 35.53c-.192-.531-.36-.869-.505-1.014a.95.95 0 0 0-.624-.29v-.724H4.13v.725c-.288 0-.48.048-.6.12-.12.073-.168.17-.168.314v.193c0 .048.024.097.024.145l1.44 4.031 1.153-3.403c-.12-.507-.24-.845-.408-1.038a.967.967 0 0 0-.696-.338l-.024-.724h4.034v.724c-.312 0-.552.048-.672.12-.145.073-.193.17-.193.338v.121c0 .048.024.097.024.169l1.201 3.934 1.297-3.62a3.05 3.05 0 0 1 .072-.242c.024-.072.024-.144.024-.217a.488.488 0 0 0-.216-.434c-.144-.097-.385-.145-.72-.17v-.723h2.833v.724c-.264.048-.504.145-.672.314-.169.168-.337.458-.48.844L9.004 41.76H7.852l-1.465-4.997-1.752 4.997z"></path>
                                            <path fill-rule="nonzero" d="M20.291 37.366h-4.827v.579c0 1.014.145 1.762.409 2.245.288.482.72.724 1.296.724.457 0 .889-.145 1.297-.459.408-.314.745-.748 1.033-1.327l.72.265c-.312.797-.768 1.376-1.369 1.786-.6.387-1.344.604-2.209.604-.504 0-.984-.097-1.44-.266-.457-.169-.841-.434-1.201-.772a4.078 4.078 0 0 1-.937-1.424c-.216-.555-.312-1.135-.312-1.787 0-1.255.36-2.293 1.08-3.09.721-.796 1.657-1.182 2.81-1.182 1.105 0 1.97.362 2.642 1.086.672.724 1.008 1.714 1.008 2.921v.097zm-4.827-.7h2.306v-.145c0-.918-.096-1.593-.264-1.98-.169-.386-.48-.579-.889-.579-.408 0-.696.193-.864.58-.168.361-.265 1.086-.289 2.124zM22.476 41.759h-.624V31.693c0-.362-.072-.603-.192-.724-.12-.12-.36-.193-.672-.217v-.7c.456 0 .96-.049 1.488-.097a18.288 18.288 0 0 0 1.753-.265v4.755c.288-.41.625-.7.985-.893.36-.193.744-.29 1.176-.29.985 0 1.801.386 2.402 1.183.6.796.912 1.81.912 3.09 0 1.279-.312 2.293-.936 3.09-.625.772-1.441 1.158-2.474 1.158-.48 0-.936-.097-1.32-.314a4.088 4.088 0 0 1-1.129-.966l-1.369 1.256zm3.194-.99c.456 0 .817-.29 1.057-.845.24-.555.36-1.376.36-2.462 0-1.086-.12-1.907-.36-2.462-.24-.555-.6-.845-1.057-.845-.456 0-.816.29-1.057.845-.24.555-.36 1.376-.36 2.438 0 1.086.12 1.907.36 2.462.24.603.577.869 1.057.869z"></path>
                                            <path d="M37.917 39.755c-.408.652-.913 1.159-1.489 1.497-.576.338-1.225.507-1.945.507-1.153 0-2.09-.387-2.81-1.159-.72-.772-1.08-1.786-1.08-3.041 0-1.304.384-2.342 1.152-3.138.769-.797 1.777-1.183 3.026-1.183.889 0 1.609.217 2.185.652.577.434.865.99.865 1.641 0 .386-.12.676-.336.917-.24.218-.529.338-.913.338-.336 0-.6-.096-.816-.29a.92.92 0 0 1-.313-.724c0-.169.024-.313.096-.458.073-.145.169-.29.313-.41l.264-.242c.048-.024.072-.072.096-.12.024-.049.024-.097.024-.121 0-.121-.12-.218-.336-.314a1.896 1.896 0 0 0-.769-.17c-.648 0-1.104.266-1.393.797-.288.532-.456 1.352-.456 2.487 0 1.182.168 2.051.48 2.63.313.58.817.846 1.49.846.36 0 .72-.121 1.08-.338.36-.218.72-.556 1.08-1.014l.505.41z"></path>
                                            <path fill-rule="nonzero" d="M42.503 41.759a3.928 3.928 0 0 1-1.44-.266 3.273 3.273 0 0 1-1.201-.796 3.816 3.816 0 0 1-.913-1.4c-.216-.531-.312-1.135-.312-1.763 0-1.255.36-2.293 1.08-3.09.721-.796 1.658-1.182 2.81-1.182 1.153 0 2.09.386 2.81 1.183.72.796 1.08 1.81 1.08 3.09 0 .627-.096 1.23-.312 1.762a4.312 4.312 0 0 1-.936 1.424c-.36.362-.769.627-1.2.796a4.778 4.778 0 0 1-1.466.242zm0-.725c.457 0 .769-.24.96-.724.193-.482.265-1.424.265-2.8s-.096-2.317-.264-2.8c-.192-.482-.504-.748-.96-.748-.457 0-.793.241-.961.748-.192.483-.264 1.424-.264 2.8s.096 2.293.264 2.8c.192.483.504.724.96.724zM51.388 29.98c.625 0 1.249-.049 1.897-.097a16.651 16.651 0 0 0 1.873-.266v10.21c0 .387.048.628.168.725.096.12.337.169.673.169h.216v.748c-.553 0-1.105.024-1.61.097a8.21 8.21 0 0 0-1.416.265v-1.859c-.336.58-.696 1.038-1.128 1.304-.409.29-.889.434-1.441.434-.985 0-1.801-.386-2.402-1.158-.624-.773-.912-1.81-.912-3.09 0-1.255.312-2.293.936-3.09.625-.796 1.417-1.182 2.402-1.182.504 0 .96.096 1.344.313.385.218.673.507.84.894v-2.8c0-.363-.071-.604-.24-.749-.167-.12-.503-.193-1.008-.193h-.144l-.048-.676zm-.072 10.813c.456 0 .817-.29 1.057-.845.24-.555.36-1.376.36-2.462 0-1.086-.12-1.907-.36-2.462-.24-.555-.577-.845-1.057-.845-.456 0-.816.29-1.056.845-.24.555-.36 1.376-.36 2.462 0 1.062.12 1.883.36 2.438.24.58.6.87 1.056.87zM64.307 37.366h-4.826v.579c0 1.014.144 1.762.408 2.245.288.482.72.724 1.297.724.456 0 .888-.145 1.296-.459.408-.314.745-.748 1.033-1.327l.72.265c-.312.797-.768 1.376-1.369 1.786-.6.387-1.344.604-2.209.604-.504 0-.984-.097-1.44-.266-.457-.169-.841-.434-1.201-.772a4.078 4.078 0 0 1-.937-1.424c-.216-.555-.312-1.135-.312-1.787 0-1.255.36-2.293 1.08-3.09.721-.796 1.658-1.182 2.81-1.182 1.105 0 1.97.362 2.642 1.086.672.724 1.008 1.714 1.008 2.921v.097zm-4.826-.7h2.305v-.145c0-.918-.096-1.593-.264-1.98-.168-.386-.48-.579-.889-.579-.408 0-.696.193-.864.58-.168.361-.264 1.086-.288 2.124z"></path>
                                            <path d="M65.316 41.493v-.7c.312-.048.528-.145.648-.29.096-.144.168-.41.168-.796V35.12c0-.387-.048-.652-.168-.749-.096-.096-.336-.169-.696-.169v-.724a27.714 27.714 0 0 0 1.609-.12c.504-.049.96-.097 1.416-.145v1.858c.265-.579.6-1.013.96-1.303a1.92 1.92 0 0 1 1.25-.435c.48 0 .864.145 1.152.41.312.29.457.628.457 1.063 0 .362-.12.652-.337.893-.216.217-.528.338-.888.338-.288 0-.528-.072-.72-.241a.767.767 0 0 1-.289-.604v-.096c0-.025.024-.073.024-.121l.072-.314v-.048-.073a.22.22 0 0 0-.072-.169c-.048-.048-.12-.048-.192-.048-.312 0-.576.29-.84.893-.264.604-.384 1.328-.384 2.22v2.27c0 .41.072.676.192.845.12.169.336.241.624.241h.384v.7h-4.37z"></path>
                                        </g>
                                        <g fill="#EC1E79" fill-rule="nonzero">
                                            <path d="M44.064 23.848H24.11V3.79h19.955v20.058zm-17.746-2.22h15.56V5.986h-15.56v15.642z"></path>
                                            <path d="M47.882 20.083H41.88V6.01H27.927V.024h19.955v20.059zm-3.818-2.22h1.633V2.22h-15.56V3.79h13.951v14.072h-.024z"></path>
                                        </g>
                                    </g>
                                </svg>
                </div>
            </a>
        </div>
    </div>
</nav>

@section('scripts')
    <script>
        document.querySelector('.navbar-vertical-footer').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action

            Swal.fire({
                title: 'Çıxış etmək istədiyinizə əminsiniz?',
                text: "Bu əməliyyatı geri qaytarmaq mümkün deyil!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, çıxış et',
                cancelButtonText: 'Xeyr, ləğv et'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the logout route
                    window.location.href = "{{ route('admin.auth.logout') }}";
                }
            });
        });
    </script>
@endsection
