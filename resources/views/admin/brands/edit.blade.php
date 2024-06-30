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

        <form enctype="multipart/form-data" method="post" action="{{route('admin.brands.update', ['lang' => TranslateUtility::getLang(), 'brand' => $brand->id])}}">
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
                                    <input name="title[{{ $lang->code }}]" class="form-control @error('title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'brand_title', $lang->code)}}" value="{{ old('title.' . $lang->code, $brand->getWithLocale($lang->code)->title ?? '') }}" />
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
                                    <input name="seo_title[{{ $lang->code }}]" class="form-control @error('seo_title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'brand_seo_title', $lang->code)}}" value="{{ old('seo_title.' . $lang->code, $brand->getWithLocale($lang->code)->seo_title ?? '') }}" />
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
                                    <input name="meta_keywords[{{ $lang->code }}]" class="form-control @error('meta_keywords.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'brand_meta_keywords', $lang->code)}}" value="{{ old('meta_keywords.' . $lang->code, $brand->getWithLocale($lang->code)->meta_keywords ?? '') }}" />
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
                                    <textarea name="meta_description[{{ $lang->code }}]" class="form-control @error('meta_description.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'brand_meta_description', $lang->code)}}">{{ old('meta_description.' . $lang->code, $brand->getWithLocale($lang->code)->meta_description ?? '') }}</textarea>
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

                <!-- SEO Link Section -->
                <div style="flex:6;">
                    <div class="mb-6 input_group_second">
                        <textarea name="seo_links" class="form-control summernote @error('seo_links') is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'brand_seo_links', TranslateUtility::getLang())}}">{{ old('seo_links', $brand->seo_links) }}</textarea>
                        @error('seo_links')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- SEO Script Section -->
                <div style="flex:6;">
                    <div class="mb-6 input_group_second">
                        <textarea name="seo_scripts" class="form-control summernote @error('seo_scripts') is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'brand_seo_scripts', TranslateUtility::getLang())}}">{{ old('seo_scripts', $brand->seo_scripts) }}</textarea>
                        @error('seo_scripts')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>
            <button style="margin-top: -46px;" class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'update_button', TranslateUtility::getLang())}}</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200
            });
        });
    </script>
@endsection
