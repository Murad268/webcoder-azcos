@extends('admin.app.app')

@section('links')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
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
    </style>
@endsection

@section('content')
    <div class="p-4 code-to-copy">
        <form enctype="multipart/form-data" method="post" action="{{ route('admin.categories.store', $langMain) }}">
            @csrf
            <div style="column-gap: 10px; align-items: center;">
                <!-- Color Schemes -->
                <div  style="flex:6;">
                    <div class="tab-content">
                        <div class="" role="tabpanel" aria-labelledby="tab-">
                            <div class="mb-6 mt-6 input_group_second">
                                <select placeholder="{{TranslateUtility::getTranslate('admin_form', 'select_product_colors', $langMain)}}" name="color_schemes[]" class="form-select2" multiple="multiple" aria-label="Default select example">
                                    <option value="0">Rəng tonu seçin</option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}">{{$color->getWithLocale($langMain) ? $color->getWithLocale($langMain)->title : "" }}</option>
                                    @endforeach
                                </select>

                                @error('color_schemes')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Types -->
                <div style="flex:6;">
                    <select placeholder="{{TranslateUtility::getTranslate('admin_form', 'select_product_types', $langMain)}}" id="productTypes" name="product_types[]" class="form-control @error('product_types') is-invalid @enderror" multiple>
                        @foreach($productTypes as $productType)
                            <option value="{{ $productType->id }}">{{ $productType->getWithLocale($langMain)->title ?? ''}}</option>
                        @endforeach
                    </select>
                    @error('product_types')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Translatable Titles -->
                <div class="mt-4" style="flex:6;">
                    <ul class="nav nav-tabs" id="translatableTitleLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="translatable-title-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#translatable-title-content-{{ $lang->code }}" role="tab" aria-controls="translatable-title-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="translatable-title-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="translatable-title-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <input name="title[{{ $lang->code }}]" class="form-control @error('title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_title', $lang->code)}}" value="{{ old('title.' . $lang->code) }}" />
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

                <!-- Translatable Title First -->
                <div style="flex:6;">
                    <ul class="nav nav-tabs" id="titleFirstLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="title-first-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#title-first-content-{{ $lang->code }}" role="tab" aria-controls="title-first-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="title-first-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="title-first-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <input name="title_first[{{ $lang->code }}]" class="form-control @error('title_first.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_title_first', $lang->code)}}" value="{{ old('title_first.' . $lang->code) }}" />
                                    @error('title_first.' . $lang->code)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Translatable Title Second -->
                <div style="flex:6;">
                    <ul class="nav nav-tabs" id="titleSecondLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="title-second-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#title-second-content-{{ $lang->code }}" role="tab" aria-controls="title-second-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="title-second-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="title-second-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <input name="title_second[{{ $lang->code }}]" class="form-control @error('title_second.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_title_second', $lang->code)}}" value="{{ old('title_second.' . $lang->code) }}" />
                                    @error('title_second.' . $lang->code)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Subtitle -->
                <div style="flex:6;">
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
                                    <input name="subtitle[{{ $lang->code }}]" class="form-control @error('subtitle.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_subtitle', $lang->code)}}" value="{{ old('subtitle.' . $lang->code) }}" />
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

                <!-- SEO Title -->
                <div style="flex:6;">
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
                                    <input name="seo_title[{{ $lang->code }}]" class="form-control @error('seo_title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_seo_title', $lang->code)}}" value="{{ old('seo_title.' . $lang->code) }}" />
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

                <!-- Meta Keywords -->
                <div style="flex:6;">
                    <ul class="nav nav-tabs" id="metaKeywordsLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="meta-keywords-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#meta-keywords-content-{{ $lang->code }}" role="tab" aria-controls="meta-keywords-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="meta-keywords-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="meta-keywords-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <input name="meta_keywords[{{ $lang->code }}]" class="form-control @error('meta_keywords.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_meta_keywords', $lang->code)}}" value="{{ old('meta_keywords.' . $lang->code) }}" />
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

                <!-- Meta Description -->
                <div style="flex:6;">
                    <ul class="nav nav-tabs" id="metaDescriptionLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="meta-description-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#meta-description-content-{{ $lang->code }}" role="tab" aria-controls="meta-description-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="meta-description-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="meta-description-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <textarea name="meta_description[{{ $lang->code }}]" class="form-control @error('meta_description.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_meta_description', $lang->code)}}">{{ old('meta_description.' . $lang->code) }}</textarea>
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

                <!-- Text First -->
                <div style="flex:6;">
                    <ul class="nav nav-tabs" id="textFirstLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="text-first-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#text-first-content-{{ $lang->code }}" role="tab" aria-controls="text-first-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="text-first-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="text-first-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <textarea name="text_first[{{ $lang->code }}]" id="summernote-text-first-{{ $lang->code }}" class="form-control @error('text_first.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_text_first', $lang->code)}}">{{ old('text_first.' . $lang->code) }}</textarea>
                                    @error('text_first.' . $lang->code)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Text Second -->
                <div style="flex:6;">
                    <ul class="nav nav-tabs" id="textSecondLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="text-second-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#text-second-content-{{ $lang->code }}" role="tab" aria-controls="text-second-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="text-second-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="text-second-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <textarea name="text_second[{{ $lang->code }}]" id="summernote-text-second-{{ $lang->code }}" class="form-control @error('text_second.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_text_second', $lang->code)}}">{{ old('text_second.' . $lang->code) }}</textarea>
                                    @error('text_second.' . $lang->code)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



                      <!-- Text Center -->
                <div style="flex:6;">
                    <ul class="nav nav-tabs" id="textCenterLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="text-second-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#text-center-content-{{ $lang->code }}" role="tab" aria-controls="text-second-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="text-center-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="text-center-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <textarea name="text_center[{{ $lang->code }}]" id="summernote-text-center-{{ $lang->code }}" class="form-control @error('text_center.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'text_center', $lang->code)}}">{{ old('text_center.' . $lang->code) }}</textarea>
                                    @error('text_center.' . $lang->code)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



                <!-- Video Link -->
                <div class="form-row mt-5">
                    <div class="col-md-12">
                        <div class="tab-content">
                            <div class="" id="text-first-content-" role="tabpanel" aria-labelledby="text-first-tab-">
                                <div class="mb-6 input_group_second">
                                    <input name="video_link" class="form-control @error('video_link') is-invalid @enderror" type="text" placeholder="{{ TranslateUtility::getTranslate('admin_form', 'category_video_link', $langMain) }}" value="{{ old('video_link') }}" />
                                    @error('video_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Links -->
                <div style="flex:6;">
                    <div class="mb-6 input_group_second">
                        <textarea name="seo_links" id="summernote-seo-links" class="form-control @error('seo_links') is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_seo_links', $langMain)}}">{{ old('seo_links') }}</textarea>
                        @error('seo_links')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- SEO Scripts -->
                <div style="flex:6;">
                    <div class="mb-6 input_group_second">
                        <textarea name="seo_scripts" id="summernote-seo-scripts" class="form-control @error('seo_scripts') is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'category_seo_scripts', $langMain)}}">{{ old('seo_scripts') }}</textarea>
                        @error('seo_scripts')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Summernote for all languages and sections
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
            initializeSummernote('#summernote-text-first-{{ $lang->code }}');
            initializeSummernote('#summernote-text-second-{{ $lang->code }}');
            initializeSummernote('#summernote-text-center-{{ $lang->code }}');
            @endforeach

            // Initialize Select2 for color schemes and product types
            $('.form-select2').select2({
                placeholder: $('.form-select2').attr('placeholder'),
                allowClear: true,
                width: '100%'
            });

            $('#productTypes').select2({
                placeholder: $('#productTypes').attr('placeholder'),
                allowClear: true,
                width: '100%'
            });

            // Handle tab switching for all tab groups
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

            handleTabSwitch('#titleFirstLangTabs .nav-link', '#titleFirstLangTabs .tab-pane');
            handleTabSwitch('#titleSecondLangTabs .nav-link', '#titleSecondLangTabs .tab-pane');
            handleTabSwitch('#subtitleLangTabs .nav-link', '#subtitleLangTabs .tab-pane');
            handleTabSwitch('#textFirstLangTabs .nav-link', '#textFirstLangTabs .tab-pane');
            handleTabSwitch('#textSecondLangTabs .nav-link', '#textSecondLangTabs .tab-pane');
            handleTabSwitch('#seoTitleLangTabs .nav-link', '#seoTitleLangTabs .tab-pane');
            handleTabSwitch('#metaKeywordsLangTabs .nav-link', '#metaKeywordsLangTabs .tab-pane');
            handleTabSwitch('#metaDescriptionLangTabs .nav-link', '#metaDescriptionLangTabs .tab-pane');
            handleTabSwitch('#translatableTitleLangTabs .nav-link', '#translatableTitleLangTabs .tab-pane');
            handleTabSwitch('#textCenterLangTabs .nav-link', '#textCenterLangTabs .tab-pane');
        });
    </script>
@endsection
