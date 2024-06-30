@extends('admin.app.app')
@section('content')

<div class="p-4 code-to-copy">
    <form method="post" action="{{route('admin.lang.store')}}">
        @csrf
        <div style="column-gap: 10px" class="d-flex">
            <div style="flex:6">
                <div class="mb-6 input_group_first">
                    <input name="name" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'lang_name', $main_lang)}}" value="{{ old('name') }}" />
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div style="flex:6">
                <div class="mb-6 input_group_second">
                    <input name="site_code" class="form-control @error('site_code') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'lang_site__name', $main_lang)}}" value="{{ old('site_code') }}" />
                    @error('site_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>

        <div style="column-gap: 10px" class="d-flex">
            <div style="flex:6">
                <div class="mb-6 input_group_first">
                    <input name="code" class="form-control @error('code') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'lang_code', $main_lang)}}" value="{{ old('code') }}" />
                    @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'add_button', $main_lang)}}</button>
    </form>
</div>
@endsection

