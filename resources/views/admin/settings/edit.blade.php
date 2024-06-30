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
    @foreach($settings->images->where('model_type', 'settings_dark') as $image)
    <div class="image_block" style="position: relative;">
        <a href="{{ route('admin.settings.delete_image', ['id' => $image->id]) }}" class="delete_image" style="position: absolute; top: 5px; right: 5px; color: red; text-decoration: none;">
            &#x2715;
        </a>
        <a target="_blank" href="{{ asset('storage/' . $image->image_url) }}">
            @if (pathinfo($image->image_url, PATHINFO_EXTENSION) === 'svg')
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('https://azcosmetics.coder.az/storage/' . $image->image_url) }}" type="image/svg+xml"/>
            @else
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . $image->image_url) }}" />
            @endif
        </a>
    </div>
@endforeach

    </div>

    <div>
        <form class="d-flex" enctype="multipart/form-data" method="post" action="{{route('admin.settings.add_images', ['type' => 'settings_dark', 'id' => $settings->id])}}">
            @csrf
            <div class="mb-1">
                <input class="form-control" name="settings_dark[]" multiple="multiple" type="file">
            </div>
            <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_index', 'set_new_light_logo', $lang)}}</button>
        </form>
    </div>



        <div class="mb-5" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 8fr)); gap: 10px;">
            @foreach($settings->images->where('model_type', 'favicon') as $image)
                <div class="image_block" style="position: relative; ">
                    <a href="{{ route('admin.settings.delete_image', ['id' => $image->id]) }}" class="delete_image" style="position: absolute; top: 5px; right: 5px; color: red; text-decoration: none;">
                        &#x2715;
                    </a>
                    <a target="_blank" href="{{ asset('storage/' . $image->image_url) }}">
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . $image->image_url) }}" />
                    </a>
                </div>
            @endforeach
        </div>

        <div>
            <form class="d-flex" enctype="multipart/form-data" method="post" action="{{route('admin.settings.add_images', ['type' => 'favicon', 'id' => $settings->id])}}">
                @csrf
                <div class="mb-1">
                    <input class="form-control" name="favicon[]" multiple="multiple" type="file">
                </div>
                <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_index', 'set_new_favicon', $lang)}}</button>
            </form>
        </div>






        <div class="mb-5 mt-5" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 8fr)); gap: 10px;">
        @foreach($settings->images->where('model_type', 'settings_light') as $image)
        <div class="image_block" style="position: relative; ">
            <a href="{{ route('admin.settings.delete_image', ['id' => $image->id]) }}" class="delete_image" style="position: absolute; top: 5px; right: 5px; color: red; text-decoration: none;">
                &#x2715;
            </a>
            <a target="_blank" href="{{ asset('storage/' . $image->image_url) }}">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . $image->image_url) }}" />
            </a>
        </div>
        @endforeach
    </div>

    <div>
        <form class="d-flex" enctype="multipart/form-data" method="post" action="{{route('admin.settings.add_images', ['type' => 'settings_light', 'id' => $settings->id])}}">
            @csrf
            <div class="mb-1">
                <input class="form-control" name="settings_light[]" multiple="multiple" type="file">
            </div>
            <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_index', 'set_new_dark_logo', $lang)}}</button>
        </form>
    </div>
    <form enctype="multipart/form-data" method="post" action="{{route('admin.settings.update', ['lang' => TranslateUtility::getLang(), 'setting' => $settings->id])}}">
        @method('PATCH')
        @csrf
        <div style="column-gap: 10px; align-items: center;">

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
                                <input name="copyright_text[{{ $lang->code }}]" class="form-control @error('copyright_text.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'copyright_text', $lang->code)}}" value="{{ old('title_first.' . $lang->code, $settings->getWithLocale($lang->code)->copyright_text ?? '') }}" />
                                @error('copyright_text.' . $lang->code)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>


                         <div class="tab-pane  " id="title-first-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="title-first-tab-{{ $lang->code }}">
                            <div class="mb-6 input_group_second">
                                <input name="map" class="form-control @error('map') is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'map_placeholder', TranslateUtility::getLang())}}" value="{{ old('map', $settings->map) }}" />
                                @error('map')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="tab-pane  " id="title-first-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="title-first-tab-{{ $lang->code }}">
                            <div class="mb-6 input_group_second">
                                <input name="product_image_width" class="form-control @error('product_image_width') is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_image_width', TranslateUtility::getLang())}}" value="{{ old('product_image_width', $settings->product_image_width) }}" />
                                @error('product_image_width')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>



                        <div class="tab-pane  " id="title-first-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="title-first-tab-{{ $lang->code }}">
                            <div class="mb-6 input_group_second">
                                <input name="product_image_height" class="form-control @error('product_image_height') is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'product_image_height', TranslateUtility::getLang())}}" value="{{ old('product_image_width', $settings->product_image_height) }}" />
                                @error('product_image_width')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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
        initializeSummernote('#summernote-text-second-{{ $lang->code }}');
        initializeSummernote('#summernote-text-third-{{ $lang->code }}');
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
                  title: {!! json_encode(TranslateUtility::getTranslate('notification', 'are_you_sure_to_delete', TranslateUtility::getLang())) !!},
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
