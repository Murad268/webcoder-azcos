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
        <form enctype="multipart/form-data" method="post" action="{{ route('admin.team.update', ['lang' => TranslateUtility::getLang(), 'team' => $team->id]) }}">
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
                                    <input name="title[{{ $lang->code }}]" class="form-control @error('title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'team_member_name', $lang->code)}}" value="{{ old('title.' . $lang->code, $team->getWithLocale($lang->code)->title ?? '') }}" />
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

                <!-- Text Section -->
                <div style="flex:6;">
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
                                    <textarea placeholder="{{TranslateUtility::getTranslate('admin_form', 'team_member_about', $lang->code)}}" id="summernote-text-{{ $lang->code }}" name="text[{{ $lang->code }}]" class="form-control @error('text.' . $lang->code) is-invalid @enderror">{{ old('text.' . $lang->code, $team->getWithLocale($lang->code)->text ?? '') }}</textarea>
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

                <!-- Position Section -->
                <div style="flex:6;">
                    <ul class="nav nav-tabs" id="positionLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="position-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#position-content-{{ $lang->code }}" role="tab" aria-controls="position-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="position-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="position-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <input name="position[{{ $lang->code }}]" class="form-control @error('position.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'team_member_position', $lang->code)}}" value="{{ old('position.' . $lang->code, $team->getWithLocale($lang->code)->position ?? '') }}" />
                                    @error('position.' . $lang->code)
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
            <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'update_button',TranslateUtility::getLang())}}</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Summernote for all languages
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
            initializeSummernote('#summernote-text-{{ $lang->code }}');
            @endforeach

            // Handle tab switching
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
            handleTabSwitch('#textLangTabs .nav-link', '#textLangTabs .tab-pane');
            handleTabSwitch('#positionLangTabs .nav-link', '#positionLangTabs .tab-pane');
        });
    </script>
@endsection
