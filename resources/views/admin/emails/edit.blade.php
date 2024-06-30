@extends('admin.app.app')
@section('content')


<div class="p-4 code-to-copy">
    <form method="post" action="{{route('admin.email.update',['email'=>$number->id, 'lang' => TranslateUtility::getLang()])}}">
        @method('PATCH')
        @csrf
        <div style="column-gap: 10px" class="d-flex">
            <div style="flex:6">
                <div class="mb-6 input_group_first">
                    <input name="data" class="form-control @error('data') is-invalid @enderror" id="exampleFormControlInput" type="text" placeholder="Email" value="{{ old('data', $number->data) }}" />
                    @error('data')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

        </div>


        <button class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'update_button', TranslateUtility::getLang())}}</button>
    </form>
</div>
@endsection

