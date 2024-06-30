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

        <form enctype="multipart/form-data" method="post" action="{{route('admin.blogs.store',  TranslateUtility::getLang())}}">
            @csrf
            <div style="column-gap: 10px; align-items: center;">
                <div style="flex:6;">
                    <div class="tab-content">
                        <div class=" " role="tabpanel" aria-labelledby="tab-">
                            <div class="mb-6 mt-6 input_group_second">
                                <select name="tags" placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_tags_select',  TranslateUtility::getLang())}}" id="mySelect2" multiple="multiple" style="width: 100%;">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->getWithLocale( TranslateUtility::getLang()) ? $tag->getWithLocale( TranslateUtility::getLang())->tag : "" }}</option>
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
                                <select name="category_id" class="form-select" aria-label="Default select example">
                                    <option value="0">{{TranslateUtility::getTranslate('admin_form', 'select_blog_category',  TranslateUtility::getLang())}}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->getWithLocale( TranslateUtility::getLang()) ? $brand->getWithLocale( TranslateUtility::getLang())->title : "" }}</option>
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

            </div>

            <!-- Title and Subtitle Row -->
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
                                    <input name="title[{{ $lang->code }}]" class="form-control @error('title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_title', $lang->code)}}" value="{{ old('title.' . $lang->code) }}" />
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
                                        <input name="seo_title[{{ $lang->code }}]" class="form-control @error('seo_title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_seo_title', $lang->code)}}" value="{{ old('seo_title.' . $lang->code) }}" />
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
                                        <input name="meta_keywords[{{ $lang->code }}]" class="form-control @error('meta_keywords.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_meta_keywords', $lang->code)}}" value="{{ old('meta_keywords.' . $lang->code) }}" />
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
                                        <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_meta_description', $lang->code)}}" name="meta_description[{{ $lang->code }}]" class="form-control @error('meta_description.' . $lang->code) is-invalid @enderror">{{ old('meta_description.' . $lang->code) }}</textarea>
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
                            <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'seo_links', TranslateUtility::getLang())}}" name="seo_links" id="summernote-seo-link" class="form-control @error('seo_link') is-invalid @enderror">{{ old('seo_link') }}</textarea>
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
                            <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'seo_scripts',  TranslateUtility::getLang())}}" name="seo_scripts" id="summernote-seo-script" class="form-control @error('seo_script') is-invalid @enderror">{{ old('seo_script') }}</textarea>
                            @error('seo_script')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Summernote Textarea -->
            <div class="form-row" style="display: flex;">
                <!-- Namesi -->
                <div class="col-md-12">
                    <div style="flex:6;">
                        <!-- Namesi Nav tabs -->
                        <ul class="nav nav-tabs" id="namesiLangTabs" role="tablist">
                            @foreach($langs as $lang)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($loop->first) active @endif" id="namesi-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#namesi-content-{{ $lang->code }}" role="tab" aria-controls="namesi-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($langs as $lang)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="namesi-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="namesi-tab-{{ $lang->code }}">
                                    <div class="mb-6 input_group_second">
                                        <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'blog_text', $lang->code)}}" name="text[{{ $lang->code }}]" id="summernote-namesi-{{ $lang->code }}" class="form-control @error('text.' . $lang->code) is-invalid @enderror">{{ old('text.' . $lang->code) }}</textarea>
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

            <button style="margin-top: -46px;" class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'add_button',  TranslateUtility::getLang())}}</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#mySelect2').select2({
            placeholder: $('#mySelect2').attr('placeholder'),
            allowClear: true
        });

        $('#mySelect22').select2({
            placeholder: $('#mySelect22').attr('placeholder'),
            allowClear: true
        });

        $(document).ready(function() {
            // Function to initialize Summernote editor
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

            // Initialize Summernote for all languages and sections
            @foreach($langs as $lang)
            initializeSummernote('#summernote-namesi-{{ $lang->code }}');
            @endforeach
        });
    </script>
@endsection
