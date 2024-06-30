@extends('admin.app.app')
@section('content')

<div class="p-4 code-to-copy">
    <form method="post" action="{{route('admin.translates.store', $lang)}}">
        @csrf
        <div style="column-gap: 10px; align-items: center;">
            <div class="d-flex" style="column-gap: 12px">
                <div style="flex:6">
                    <div class="input_group_first">
                        <input name="group" class="form-control @error('group') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="Tərcümə qrupu" value="{{ old('group') }}" />
                        @error('group')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div style="flex:6">
                    <div class="input_group_first">
                        <input name="code" class="form-control @error('code') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="Tərcümə açar sözü" value="{{ old('code') }}" />
                        @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>
            <div style="flex:6; ">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="langTabs" role="tablist">
                    @foreach($langs as $lang)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link @if($loop->first) active @endif" id="tab-{{ $lang->code }}" data-bs-toggle="tab" href="#content-{{ $lang->code }}" role="tab" aria-controls="content-{{ $lang->code }}" aria-selected="true">{{ $lang->code }}</a>
                    </li>
                    @endforeach
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach($langs as $lang)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="content-{{ $lang->code }}" role="tabpanel" aria-labelledby="tab-{{ $lang->code }}">
                        <div class="mb-6 input_group_second">
                            <input name="locale[{{ $lang->code }}]" class="form-control @error('locale.' . $lang->code) is-invalid @enderror" type="text" placeholder="Tərcümə {{ $lang->code }}" value="{{ old('locale.' . $lang->code) }}" />
                            @error('locale.' . $lang->code)
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

        <button style="margin-top: -46px;" class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'add_button', TranslateUtility::getLang())}}</button>
    </form>
</div>

@endsection

