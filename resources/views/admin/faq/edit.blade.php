@extends('admin.app.app')
@section('links')
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
        <form enctype="multipart/form-data" method="post" action="{{route('admin.faq.store', $main_lang)}}">
            @csrf
            <div style="column-gap: 10px; align-items: center;">
                <div style="flex:6;">
                    <!-- Nav tabs for Question -->
                    <ul class="nav nav-tabs" id="questionLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="question-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#question-content-{{ $lang->code }}" role="tab" aria-controls="question-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }} Question</a>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tab panes for Question -->
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="question-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="question-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <input name="question[{{ $lang->code }}]" class="form-control @error('question.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'faq_question', $lang->code)}}" value="{{ old('question.' . $lang->code, $category->getWithLocale($main_lang)->question ?? ""  ) }}" />
                                    @error('question.' . $lang->code)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Nav tabs for Answer -->
                    <ul class="nav nav-tabs mt-3" id="answerLangTabs" role="tablist">
                        @foreach($langs as $lang)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($loop->first) active @endif" id="answer-tab-{{ $lang->code }}" data-bs-toggle="tab" href="#answer-content-{{ $lang->code }}" role="tab" aria-controls="answer-content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }} Answer</a>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tab panes for Answer -->
                    <div class="tab-content">
                        @foreach($langs as $lang)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="answer-content-{{ $lang->code }}" role="tabpanel" aria-labelledby="answer-tab-{{ $lang->code }}">
                                <div class="mb-6 input_group_second">
                                    <textarea name="answer[{{ $lang->code }}]" class="form-control summernote @error('answer.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'faq_answer', $lang->code)}}">{{ old('answer.' . $lang->code, $category->getWithLocale($lang->code)->answer ?? '') }}</textarea>
                                    @error('answer.' . $lang->code)
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
            <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'update_button', $lang->code)}}</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            function initializeSummernote(selector) {
                $(selector).summernote({
                    placeholder: $(selector).attr('placeholder'),
                    height: 150,
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
            initializeSummernote('#answer-content-{{ $lang->code }} .summernote');
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

            handleTabSwitch('#questionLangTabs .nav-link', '#questionLangTabs .tab-pane');
            handleTabSwitch('#answerLangTabs .nav-link', '#answerLangTabs .tab-pane');
        });
    </script>
@endsection
