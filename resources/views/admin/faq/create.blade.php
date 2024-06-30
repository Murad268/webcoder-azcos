@extends('admin.app.app')
@section('links')
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
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="p-4 code-to-copy">
        <form enctype="multipart/form-data" method="post" action="{{route('admin.faq.store', $lang)}}">
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
                                    <input name="question[{{ $lang->code }}]" class="form-control @error('question.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'faq_question', $lang->code)}}" value="{{ old('question.' . $lang->code) }}" />
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
                                    <textarea name="answer[{{ $lang->code }}]" class="form-control summernote @error('answer.' . $lang->code) is-invalid @enderror" placeholder="{{TranslateUtility::getTranslate('admin_form', 'faq_answer', $lang->code)}}}">{{ old('answer.' . $lang->code) }}</textarea>
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
            <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'add_button', $lang->code)}}</button>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 150
            });
        });
    </script>
@endsection
