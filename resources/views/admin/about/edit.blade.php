@extends('admin.app.app')
@section('links')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
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
    @if (session('success'))
    <div class="text-success" role="alert">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="text-danger" role="alert">{{ session('error') }}</div>
    @endif
        <div class="mb-5" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 8fr)); gap: 10px;">
            @foreach($about->images->where('model_type', 'about_banner') as $image)
                <div class="image_block" style="position: relative; ">
                    <a href="{{ route('admin.about.delete_image', ['id' => $image->id]) }}" class="delete_image" style="position: absolute; top: 5px; right: 5px; color: red; text-decoration: none;">
                        &#x2715;
                    </a>
                    <a target="_blank" href="{{ asset('storage/' . $image->image_url) }}">
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . $image->image_url) }}" />
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mb-4
        ">
            <form class="d-flex" enctype="multipart/form-data" method="post" action="{{route('admin.about.add_images', ['type' => 'about_banner', 'id' => $about->id])}}">
                @csrf
                <div class="mb-1">
                    <input class="form-control" name="about_banner[]" multiple="multiple" type="file">
                </div>
                <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_index', 'add_new_about_banner_photo', $lang)}}</button>
            </form>
        </div>

    <div class="mb-5" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 8fr)); gap: 10px;">
        @foreach($about->images->where('model_type', 'about') as $image)
        <div class="image_block" style="position: relative; ">
            <a href="{{ route('admin.about.delete_image', ['id' => $image->id]) }}" class="delete_image" style="position: absolute; top: 5px; right: 5px; color: red; text-decoration: none;">
                &#x2715;
            </a>
            <a target="_blank" href="{{ asset('storage/' . $image->image_url) }}">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . $image->image_url) }}" />
            </a>
        </div>
        @endforeach
    </div>

    <div>
        <form class="d-flex" enctype="multipart/form-data" method="post" action="{{route('admin.about.add_images', ['type' => 'about', 'id' => $about->id])}}">
            @csrf
            <div class="mb-1">
                <input class="form-control" name="about[]" multiple="multiple" type="file">
            </div>
            <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_index', 'add_new_about_photo',TranslateUtility::getLang())}}</button>
        </form>
    </div>


     <div class="mb-5" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 8fr)); gap: 10px;">
            @foreach($about->images->where('model_type', 'certificate') as $image)
                <div class="image_block" style="position: relative; ">
                    <a href="{{ route('admin.about.delete_image', ['id' => $image->id]) }}" class="delete_image" style="position: absolute; top: 5px; right: 5px; color: red; text-decoration: none;">
                        &#x2715;
                    </a>
                    <a target="_blank" href="{{ asset('storage/' . $image->image_url) }}">
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . $image->image_url) }}" />
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mb-4
        ">
            <form class="d-flex" enctype="multipart/form-data" method="post" action="{{route('admin.about.add_images', ['type' => 'certificate', 'id' => $about->id])}}">
                @csrf
                <div class="mb-1">
                    <input class="form-control" name="certificate[]" multiple="multiple" type="file">
                </div>
                <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_index', 'add_new_certificate', $lang)}}</button>
            </form>
        </div>




    <form enctype="multipart/form-data" method="post" action="{{route('admin.about.update', ['lang' => TranslateUtility::getLang(), 'about' => $about->id])}}">
        @method('PATCH')
        @csrf
        <div style="column-gap: 10px; align-items: center;">

            <!-- Title First -->
            <div class="form-row">
                <div class="col-md-12">
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
                                <input name="title_first[{{ $lang->code }}]" class="form-control @error('title_first.' . $lang->code) is-invalid @enderror" type="text" placeholder=" {{TranslateUtility::getTranslate('admin_form', 'about_title_first', $lang)}}" value="{{ old('title_first.' . $lang->code, $about->getWithLocale($lang->code)->title_first ?? '') }}" />
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
            </div>

            <!-- Text First -->
            <div class="form-row">
                <div class="col-md-12">
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
                                <textarea placeholder=" {{TranslateUtility::getTranslate('admin_form', 'about_first_text', $lang)}}" id="summernote-text-first-{{ $lang->code }}" name="text_first[{{ $lang->code }}]" class="form-control @error('text_first.' . $lang->code) is-invalid @enderror">{{ old('text_first.' . $lang->code, $about->getWithLocale($lang->code)->text_first ?? '') }}</textarea>
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
            </div>

            <!-- Title Second -->
            <div class="form-row">
                <div class="col-md-12">
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
                                <input name="title_second[{{ $lang->code }}]" class="form-control @error('title_second.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'about_second_title', $lang)}}" value="{{ old('title_second.' . $lang->code, $about->getWithLocale($lang->code)->title_second ?? '') }}" />
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
            </div>

            <!-- Text Second -->
            <div class="form-row">
                <div class="col-md-12">
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
                                <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'about_second_text', $lang)}}" id="summernote-text-second-{{ $lang->code }}" name="text_second[{{ $lang->code }}]" class="form-control @error('text_second.' . $lang->code) is-invalid @enderror">{{ old('text_second.' . $lang->code, $about->getWithLocale($lang->code)->text_second ?? '') }}</textarea>
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
            </div>

            <!-- Title Third -->
            <div class="form-row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="titleThirdLangTabs" role="tablist">
                        @foreach($langs as $lang)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link @if($loop->first) active @endif" id="title-third-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#title-third-content-{{ $lang->code }}" role="tab" aria-controls="title-third-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="title-third-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="title-third-tab-{{ $lang->code }}">
                            <div class="mb-6 input_group_second">
                                <input name="title_third[{{ $lang->code }}]" class="form-control @error('title_third.' . $lang->code) is-invalid @enderror" type="text" placeholder="Title Third - {{TranslateUtility::getTranslate('admin_form', 'about_third_title', $lang)}}" value="{{ old('title_third.' . $lang->code, $about->getWithLocale($lang->code)->title_third ?? '') }}" />
                                @error('title_third.' . $lang->code)
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

            <!-- Text Third -->
            <div class="form-row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="textThirdLangTabs" role="tablist">
                        @foreach($langs as $lang)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link @if($loop->first) active @endif" id="text-third-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#text-third-content-{{ $lang->code }}" role="tab" aria-controls="text-third-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="text-third-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="text-third-tab-{{ $lang->code }}">
                            <div class="mb-6 input_group_second">
                                <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'about_third_text', $lang)}}" id="summernote-text-third-{{ $lang->code }}" name="text_third[{{ $lang->code }}]" class="form-control @error('text_third.' . $lang->code) is-invalid @enderror">{{ old('text_third.' . $lang->code, $about->getWithLocale($lang->code)->text_third ?? '') }}</textarea>
                                @error('text_third.' . $lang->code)
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

            <!-- YouTube Link -->
            <div class="form-row">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class=" " id="text-first-content-" role="tabpanel" aria-labelledby="text-first-tab-">
                            <div class="mb-6 input_group_second">
                                <input name="video_link" class="form-control @error('youtube_link') is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'about_youtube_link',TranslateUtility::getLang())}}" value="{{ old('video_link', $about->video_link ?? 'https://youtube.com/samplelink') }}" />
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

        </div>
        <button style="margin-top: -46px;" class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'update_button', TranslateUtility::getLang())}}</button>
    </form>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
        initializeSummernote('#summernote-text-first-{{ $lang->code }}');
        initializeSummernote('#summernote-text-second-{{  $lang->code }}');
        initializeSummernote('#summernote-text-third-{{  $lang->code }}');
        @endforeach

        // Function to handle tab switching
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

        // Handle tab switching for all tab groups
        handleTabSwitch('#titleFirstLangTabs .nav-link', '#titleFirstLangTabs .tab-pane');
        handleTabSwitch('#titleSecondLangTabs .nav-link', '#titleSecondLangTabs .tab-pane');
        handleTabSwitch('#titleThirdLangTabs .nav-link', '#titleThirdLangTabs .tab-pane');
        handleTabSwitch('#textFirstLangTabs .nav-link', '#textFirstLangTabs .tab-pane');
        handleTabSwitch('#textSecondLangTabs .nav-link', '#textSecondLangTabs .tab-pane');
        handleTabSwitch('#textThirdLangTabs .nav-link', '#textThirdLangTabs .tab-pane');
    });


    document.querySelectorAll('.delete_image').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const href = e.target.getAttribute('href');
            Swal.fire({
                title: {!! json_encode(TranslateUtility::getTranslate('notification', 'confirm_delete_image', TranslateUtility::getLang())) !!},
                showCancelButton: true,
                confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes', TranslateUtility::getLang())) !!},
                cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no', TranslateUtility::getLang())) !!},
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
</script>
@endsection
