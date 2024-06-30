@extends('admin.app.app')
@section('content')


<div class="p-4 code-to-copy">
    <form method="post" action="{{route('admin.socials.update', ['social' =>  $social->id, 'lang' => TranslateUtility::getLang()])}}">
        @method('PATCH')
        @csrf
        @if (session('success'))
            <div class="text-success mb-3" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="text-danger mb-3 " role="alert">{{ session('error') }}</div>
        @endif
        <div style="column-gap: 10px" class="d-flex">

            <div style="flex:6">
                <div class="mb-6 input_group_second">
                    <input name="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'facebook_link', TranslateUtility::getLang())}}" value="{{ old('facebook_link', $social->facebook_link) }}" />
                    @error('facebook_link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div style="flex:6">
                <div class="mb-6 input_group_second">
                    <input name="twitter_link" class="form-control @error('twitter_link') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'twitter_link',  TranslateUtility::getLang())}}" value="{{ old('twitter_link', $social->twitter_link) }}" />
                    @error('twitter_link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div style="flex:6">
                <div class="mb-6 input_group_second">
                    <input name="youtube_link" class="form-control @error('youtube_link') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'youtube_link',  TranslateUtility::getLang())}}" value="{{ old('youtube_link', $social->youtube_link) }}" />
                    @error('youtube_link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div style="flex:6">
                <div class="mb-6 input_group_second">
                    <input name="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'instagram_link',  TranslateUtility::getLang())}}" value="{{ old('instagram_link', $social->instagram_link) }}" />
                    @error('youtube_link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>


        <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'update_button',  TranslateUtility::getLang())}}</button>
    </form>
</div>
@endsection

