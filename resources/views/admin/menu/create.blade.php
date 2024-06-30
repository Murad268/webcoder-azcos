@extends('admin.app.app')
@section('content')

    <div class="p-4 code-to-copy">

        <form enctype="multipart/form-data" method="post" action="{{route('admin.menu.store', TranslateUtility::getLang())}}">
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
                                    <input name="slug[{{ $lang->code }}]" class="form-control @error('slug.' . $lang->code) is-invalid @enderror" type="text" placeholder="Slug  - {{ $lang->code }}" value="{{ old('slug.' . $lang->code) }}" />
                                    @error('slug.' . $lang->code)
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
                                    <input name="seo_title[{{ $lang->code }}]" class="form-control @error('seo_title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'seo_title', $lang->code)}}" value="{{ old('seo_title.' . $lang->code) }}" />
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
                                    <input name="meta_keywords[{{ $lang->code }}]" class="form-control @error('meta_keywords.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'meta_keywords', $lang->code)}}" value="{{ old('meta_keywords.' . $lang->code) }}" />
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
                                    <textarea name="meta_description[{{ $lang->code }}]" class="form-control @error('meta_description.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'meta_description', $lang->code)}}">{{ old('meta_description.' . $lang->code) }}</textarea>
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
                        <textarea name="seo_links" class="form-control summernote @error('seo_link') is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'seo_links', TranslateUtility::getLang())}}">{{ old('seo_link') }}</textarea>
                        @error('seo_link')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- SEO Script Section -->
                <div style="flex:6;">
                    <div class="mb-6 input_group_second">
                        <textarea name="seo_scripts" class="form-control summernote @error('seo_script') is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'seo_scripts', TranslateUtility::getLang())}}">{{ old('seo_script') }}</textarea>
                        @error('seo_script')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- Code Section (Not Translated) -->
                <div style="flex:6;">
                    <div class="mb-6 input_group_second">
                        <input name="code" class="form-control @error('code') is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'menu_select_code', TranslateUtility::getLang())}}" value="{{ old('code') }}" />
                        @error('code')
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
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200
            });
        });
    </script>
@endsection
