@extends('admin.app.app')

@section('links')
    <style>
        .image_block {
            position: relative;
        }

        a {
            text-decoration: none;
        }

        .delete_image {
            position: absolute;
            top: -8px;
            right: -3px;
            cursor: pointer;
            background: white;
            color: black;
            font-weight: bold;
            padding: 0 6px;
            text-decoration: none;
        }

        .delete_image::hover {
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="p-4 code-to-copy">
        <form enctype="multipart/form-data" method="post" action="{{ route('admin.blog_category.update', ['lang' =>  TranslateUtility::getLang(), 'blog_category' => $blog->id]) }}">
            @method('PATCH')
            @csrf
            <div style="column-gap: 10px; align-items: center;">

                <!-- Title Section -->
                <div style="flex:6;">
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
                                    <input name="title[{{ $lang->code }}]" class="form-control @error('title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_category_name', $lang)}}" value="{{ old('title.' . $lang->code, $blog->getWithLocale($lang->code)->title ?? "") }}" />
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

                <!-- SEO Title Section -->
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
                                    <input name="seo_title[{{ $lang->code }}]" class="form-control @error('seo_title.' . $lang->code) is-invalid @enderror" type="text" placeholder="SEO Title - {{ $lang->code }}" value="{{TranslateUtility::getTranslate('admin_form', 'blog_category_seo_title', $lang->code)}}" />
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

                <!-- Meta Keywords Section -->
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
                                    <input name="meta_keywords[{{ $lang->code }}]" class="form-control @error('meta_keywords.' . $lang->code) is-invalid @enderror" type="text" placeholder="Meta Keywords - {{ $lang->code }}" value="{{TranslateUtility::getTranslate('admin_form', 'blog_category_meta_keywords', $lang->code)}}" />
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

                <!-- Meta Description Section -->
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
                                    <textarea name="meta_description[{{ $lang->code }}]" class="form-control @error('meta_description.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_category_meta_description', $lang->code)}}">{{ old('meta_description.' . $lang->code,$blog->getWithLocale($langMain)->meta_description ?? "") }}</textarea>
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

                <!-- SEO Links Section -->
                <div style="flex:6;">
                    <div class="mb-6 input_group_second">
                        <textarea name="seo_links" id="summernote-seo-links" class="form-control @error('seo_links') is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_category_seo_links',  TranslateUtility::getLang())}}">{{ old('seo_links', $blog->seo_links) }}</textarea>
                        @error('seo_links')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- SEO Scripts Section -->
                <div style="flex:6;">
                    <div class="mb-6 input_group_second">
                        <textarea name="seo_scripts" id="summernote-seo-scripts" class="form-control @error('seo_scripts') is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_category_seo_scripts',  TranslateUtility::getLang())}}">{{ old('seo_scripts', $blog->seo_scripts) }}</textarea>
                        @error('seo_scripts')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>
            <button style="margin-top: -46px;" class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'update_button',  TranslateUtility::getLang())}}</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote for SEO fields
            $('#summernote-seo-links').summernote({
                placeholder: $('#summernote-seo-links').attr('placeholder'),
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

            $('#summernote-seo-scripts').summernote({
                placeholder: $('#summernote-seo-scripts').attr('placeholder'),
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

            handleTabSwitch('#titleLangTabs .nav-link', '#titleLangTabs .tab-pane');
            handleTabSwitch('#seoTitleLangTabs .nav-link', '#seoTitleLangTabs .tab-pane');
            handleTabSwitch('#metaKeywordsLangTabs .nav-link', '#metaKeywordsLangTabs .tab-pane');
            handleTabSwitch('#metaDescriptionLangTabs .nav-link', '#metaDescriptionLangTabs .tab-pane');
        });
    </script>
@endsection
