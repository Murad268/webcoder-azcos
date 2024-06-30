@extends('admin.app.app')
@section('links')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .file_inp {
            position: relative;
        }

        .file_icon {
            padding: 3rem 2rem;
            border: 1px dashed var(--phoenix-border-color);
            border-radius: .5rem;
            cursor: pointer;
        }

        input[type="file"] {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
        }

        .drop_file img {
            width: 80px;
            height: 80px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .form-row>.col-md-6,
        .form-row>.col-md-12 {
            padding-right: 15px;
            padding-left: 15px;
        }
    </style>
@endsection
@section('content')

    <div class="p-4 code-to-copy">

        <form enctype="multipart/form-data" method="post" action="{{route('admin.products.store', $lang)}}">
            @csrf
            <div style="column-gap: 10px; align-items: center;">
                <div style="flex:6;">
                    <div class="tab-content">
                        <div class=" " role="tabpanel" aria-labelledby="tab-">
                            <div class="mb-6 mt-6 input_group_second">
                                <select name="tags" placeholder="{{TranslateUtility::getTranslate('admin_form', 'select_product_tags', $lang)}}" id="mySelect2" multiple="multiple" style="width: 100%;">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->getWithLocale($lang) ? $tag->getWithLocale($lang)->tag: "" }}</option>
                                    @endforeach
                                </select>

                                @error('tag')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div style="flex:6;">
                    <div class="tab-content">
                        <div class=" " role="tabpanel" aria-labelledby="tab-">
                            <div class="mb-6 mt-6 input_group_second">
                                <select name="color_schemes" placeholder="{{TranslateUtility::getTranslate('admin_form', 'select_product_colors', $lang)}}" id="mySelect22" multiple="multiple" style="width: 100%;">
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}" {{ in_array($color->id, old('color_schemes', [])) ? 'selected' : '' }}>
                                            {{ $color->getWithLocale($lang) ? $color->getWithLocale($lang)->title : '' }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div style="flex:6;">
                    <div class="tab-content">
                        <div class=" " role="tabpanel" aria-labelledby="tab-">
                            <div class="mb-6 mt-6 input_group_second">
                                <select name="brand_id" class="form-select" aria-label="Default select example">
                                    <option value="0">{{TranslateUtility::getTranslate('admin_form', 'select_product_brand', $lang)}}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->getWithLocale($lang) ? $brand->getWithLocale($lang)->title : "" }}</option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div style="flex:6;">
                    <!-- Title Nav tabs -->

                    <div class="tab-content">
                        <div class="  " id="title-content-" role="tabpanel" aria-labelledby="title-tab-">
                            <div class="mb-6 input_group_second">
                                <input name="product_code" class="form-control @error('product_code') is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_code', $lang)}}" value="{{ old('product_code') }}" />
                                @error('product_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div style="flex:6;">
                    <!-- Title Nav tabs -->

                    <div class="tab-content">
                        <div class="  " id="title-content-" role="tabpanel" aria-labelledby="title-tab-">
                            <div class="mb-6 input_group_second">
                                <input name="price" class="form-control @error('price') is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_price', $lang)}}" value="{{ old('price') }}" />
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div style="flex:6;">
                    <!-- Title Nav tabs -->

                    <div class="tab-content">
                        <div class="  " id="title-content-" role="tabpanel" aria-labelledby="title-tab-">
                            <div class="mb-6 input_group_second">
                                <input name="video_link" class="form-control @error('video_link') is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_video_link', $lang)}}" value="{{ old('video_link') }}" />
                                @error('video_link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Title and Subtitle Row -->
                <div class="form-row" style="display: flex;">
                    <!-- Title -->
                    <div class="col-md-6">
                        <div style="flex:6;">
                            <!-- Title Nav tabs -->
                            <ul class="nav nav-tabs" id="titleLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="title-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#title-content-{{ $lang->code }}" role="tab" aria-controls="title-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="title-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="title-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <input name="title[{{ $lang->code }}]" class="form-control @error('title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_title', $lang->code)}}" value="{{ old('title.' . $lang->code) }}" />
                                            @error('title.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Subtitle -->
                    <div class="col-md-6">
                        <div style="flex:6;">
                            <!-- Subtitle Nav tabs -->
                            <ul class="nav nav-tabs" id="subtitleLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="subtitle-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#subtitle-content-{{ $lang->code }}" role="tab" aria-controls="subtitle-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="subtitle-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="subtitle-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <input name="subtitle[{{ $lang->code }}]" class="form-control @error('subtitle.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_subtitle', $lang->code)}}" value="{{ old('subtitle.' . $lang->code) }}" />
                                            @error('subtitle.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- How to Use and Product Details Row -->
                <div class="form-row" style="display: flex;">
                    <!-- How to Use -->
                    <div class="col-md-6">
                        <div style="flex:6;">
                            <!-- How to Use Nav tabs -->
                            <ul class="nav nav-tabs" id="howToUseLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="how-to-use-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#how-to-use-content-{{ $lang->code }}" role="tab" aria-controls="how-to-use-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="how-to-use-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="how-to-use-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_how_to_use', $lang->code)}}" id="summernote-how-to-use-{{ $lang->code }}" name="how_to_use[{{ $lang->code }}]" class="form-control @error('how_to_use.' . $lang->code) is-invalid @enderror">{{ old('how_to_use.' . $lang->code) }}</textarea>
                                            @error('how_to_use.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-6">
                        <div style="flex:6;">
                            <!-- Product Details Nav tabs -->
                            <ul class="nav nav-tabs" id="productDetailsLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="product-details-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#product-details-content-{{ $lang->code }}" role="tab" aria-controls="product-details-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="product-details-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="product-details-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_details', $lang->code)}}" id="summernote-product-details-{{ $lang->code }}" name="product_details[{{ $lang->code }}]" class="form-control @error('product_details.' . $lang->code) is-invalid @enderror">{{ old('product_details.' . $lang->code) }}</textarea>
                                            @error('product_details.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ingredients Row -->
                <div class="form-row" style="display: flex;">
                    <!-- Ingredients -->
                    <div class="col-md-12">
                        <div style="flex:6;">
                            <!-- Ingredients Nav tabs -->
                            <ul class="nav nav-tabs" id="ingredientsLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="ingredients-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#ingredients-content-{{ $lang->code }}" role="tab" aria-controls="ingredients-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="ingredients-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="ingredients-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_ingredients', TranslateUtility::getLang())}}" id="summernote-ingredients-{{ $lang->code }}" name="ingredients[{{ $lang->code }}]" class="form-control @error('ingredients.' . $lang->code) is-invalid @enderror">{{ old('ingredients.' . $lang->code) }}</textarea>
                                            @error('ingredients.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Row -->
                <div class="form-row" style="display: flex;">
                    <!-- SEO Title -->
                    <div class="col-md-6">
                        <div style="flex:6;">
                            <!-- SEO Title Nav tabs -->
                            <ul class="nav nav-tabs" id="seoTitleLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="seo-title-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#seo-title-content-{{ $lang->code }}" role="tab" aria-controls="seo-title-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="seo-title-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="seo-title-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <input name="seo_title[{{ $lang->code }}]" class="form-control @error('seo_title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_seo_title', $lang->code)}}" value="{{ old('seo_title.' . $lang->code) }}" />
                                            @error('seo_title.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- SEO Meta Keywords -->
                    <div class="col-md-6">
                        <div style="flex:6;">
                            <!-- SEO Meta Keywords Nav tabs -->
                            <ul class="nav nav-tabs" id="seoKeywordsLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="seo-keywords-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#seo-keywords-content-{{ $lang->code }}" role="tab" aria-controls="seo-keywords-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="seo-keywords-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="seo-keywords-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <input name="meta_keywords[{{ $lang->code }}]" class="form-control @error('meta_keywords.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_meta_keywords', $lang->code)}}" value="{{ old('meta_keywords.' . $lang->code) }}" />
                                            @error('meta_keywords.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Meta Description Row -->
                <div class="form-row" style="display: flex;">
                    <!-- SEO Meta Description -->
                    <div class="col-md-12">
                        <div style="flex:6;">
                            <!-- SEO Meta Description Nav tabs -->
                            <ul class="nav nav-tabs" id="seoDescriptionLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="seo-description-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#seo-description-content-{{ $lang->code }}" role="tab" aria-controls="seo-description-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="seo-description-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="seo-description-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_meta_description', $lang->code)}}" name="meta_description[{{ $lang->code }}]" class="form-control @error('meta_description.' . $lang->code) is-invalid @enderror">{{ old('meta_description.' . $lang->code) }}</textarea>
                                            @error('meta_description.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Link and Script Row -->
                <div class="form-row" style="display: flex;">
                    <!-- SEO Link -->
                    <div class="col-md-6">
                        <div style="flex:6;">
                            <div class="mb-6 input_group_second">
                                <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_seo_link', TranslateUtility::getLang())}}" name="seo_links" id="summernote-seo-link" class="form-control @error('seo_link') is-invalid @enderror">{{ old('seo_link') }}</textarea>
                                @error('seo_link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SEO Script -->
                    <div class="col-md-6">
                        <div style="flex:6;">
                            <div class="mb-6 input_group_second">
                                <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_seo_scripts', TranslateUtility::getLang())}}" name="seo_scripts" id="summernote-seo-script" class="form-control @error('seo_script') is-invalid @enderror">{{ old('seo_script') }}</textarea>
                                @error('seo_script')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Text Field -->
                <div class="form-row" style="display: flex;">
                    <div class="col-md-12">
                        <div style="flex:6;">
                            <!-- Text Nav tabs -->
                            <ul class="nav nav-tabs" id="textLangTabs" role="tablist">
                                @foreach($langs as $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($loop->first) active @endif" id="text-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#text-content-{{ $lang->code }}" role="tab" aria-controls="text-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="text-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="text-tab-{{ $lang->code }}">
                                        <div class="mb-6 input_group_second">
                                            <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_text', $lang->code)}}" id="summernote-text-{{ $lang->code }}" name="text[{{ $lang->code }}]" class="form-control @error('text.' . $lang->code) is-invalid @enderror">{{ old('text.' . $lang->code) }}</textarea>
                                            @error('text.' . $lang->code)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button style="margin-top: -46px;" class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'add_button', TranslateUtility::getLang())}}</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#mySelect2').select2({
                placeholder: $('#mySelect2').attr('placeholder'),
                allowClear: true
            });

            $('#mySelect22').select2({
                placeholder: $('#mySelect22').attr('placeholder'),
                allowClear: true
            });

            function initializeSummernote(selector) {
                $(selector).summernote({
                    placeholder: $(selector).attr('placeholder'),
                    height: 300,
                    minHeight: null,
                    maxHeight: null,
                    focus: true,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    popover: {
                        image: [
                            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                            ['float', ['floatLeft', 'floatRight', 'floatNone']],
                            ['remove', ['removeMedia']]
                        ],
                        link: [
                            ['link', ['linkDialogShow', 'unlink']]
                        ],
                        air: [
                            ['color', ['color']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['para', ['ul', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture']]
                        ]
                    }
                });
            }

            @foreach($langs as $lang)
            initializeSummernote('#summernote-how-to-use-{{ $lang->code }}');
            initializeSummernote('#summernote-product-details-{{ $lang->code }}');
            initializeSummernote('#summernote-ingredients-{{ $lang->code }}');
            initializeSummernote('#summernote-text-{{ $lang->code }}');
            @endforeach

            function handleTabSwitch(tabSelector, paneSelector) {
                document.querySelectorAll(tabSelector).forEach(tab => {
                    tab.addEventListener('click', function(e) {
                        e.preventDefault();
                        const targetTab = e.target.getAttribute('href').substring(1);
                        document.querySelectorAll(paneSelector).forEach(pane => {
                            if (pane.id === targetTab) {
                                pane.classList.add('show', 'active');
                            } else {
                                pane.classList.remove('show', 'active');
                            }
                        });
                    });
                });
            }

            handleTabSwitch('#titleLangTabs .nav-link', '#titleLangTabs .tab-pane');
            handleTabSwitch('#subtitleLangTabs .nav-link', '#subtitleLangTabs .tab-pane');
            handleTabSwitch('#howToUseLangTabs .nav-link', '#howToUseLangTabs .tab-pane');
            handleTabSwitch('#productDetailsLangTabs .nav-link', '#productDetailsLangTabs .tab-pane');
            handleTabSwitch('#ingredientsLangTabs .nav-link', '#ingredientsLangTabs .tab-pane');
            handleTabSwitch('#seoTitleLangTabs .nav-link', '#seoTitleLangTabs .tab-pane');
            handleTabSwitch('#seoKeywordsLangTabs .nav-link', '#seoKeywordsLangTabs .tab-pane');
            handleTabSwitch('#seoDescriptionLangTabs .nav-link', '#seoDescriptionLangTabs .tab-pane');
            handleTabSwitch('#textLangTabs .nav-link', '#textLangTabs .tab-pane');
        });
    </script>
@endsection
