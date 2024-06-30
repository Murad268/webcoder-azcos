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
@endsection
@section('content')

    <div class="p-4 code-to-copy">

        <form enctype="multipart/form-data" method="post" action="{{route('admin.address.update', ['lang' =>  TranslateUtility::getLang(), 'address' => $address->id])}}">
            @method('PATCH')
            @csrf
            <div style="column-gap: 10px; align-items: center;">

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
                                    <input name="title[{{ $lang->code }}]" class="form-control @error('title.' . $lang->code) is-invalid @enderror" type="text" placeholder="{{TranslateUtility::getTranslate('admin_form', 'address_name', $lang)}}" value="{{ old('locale.' . $lang->code, $address->getWithLocale($lang->code)->title ?? '') }}" />
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


            </div>

            <button style="margin-top: -46px;" class="btn btn-success" type="submit">{{TranslateUtility::getTranslate('admin_form', 'update_button',  TranslateUtility::getLang())}}</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        const fileInp = document.querySelectorAll(".file");

        function getFile() {
            fileInp.forEach(inp => {
                const allFiles = new DataTransfer();

                inp.addEventListener("change", (e) => {
                    e.stopPropagation();
                    const files = e.target.files;
                    const dropFileContainer = inp.parentElement.querySelector('.drop_file');

                    Array.from(files).forEach((file, index) => {
                        allFiles.items.add(file);

                        const reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = () => {
                            const imgContainer = document.createElement("div");
                            imgContainer.style.position = "relative";
                            imgContainer.style.display = "inline-block";

                            const newFile = document.createElement("img");
                            newFile.src = reader.result;
                            newFile.style.maxWidth = "100px";
                            newFile.style.margin = "5px";

                            const deleteBtn = document.createElement("button");
                            deleteBtn.innerHTML = "×";
                            deleteBtn.style.position = "absolute";
                            deleteBtn.style.top = "0";
                            deleteBtn.style.right = "0";
                            deleteBtn.style.background = "red";
                            deleteBtn.style.color = "white";
                            deleteBtn.style.border = "none";
                            deleteBtn.style.borderRadius = "50%";
                            deleteBtn.style.cursor = "pointer";

                            deleteBtn.addEventListener("click", (e) => {
                                e.preventDefault();
                                imgContainer.remove();

                                // Remove the file from the DataTransfer object
                                const dt = new DataTransfer();
                                Array.from(allFiles.files).forEach((file, i) => {
                                    if (i !== index) {
                                        dt.items.add(file);
                                    }
                                });
                                allFiles.items.clear();
                                Array.from(dt.files).forEach(file => {
                                    allFiles.items.add(file);
                                });

                                inp.files = allFiles.files;
                            });

                            imgContainer.appendChild(newFile);
                            imgContainer.appendChild(deleteBtn);
                            dropFileContainer.appendChild(imgContainer);
                        };
                    });

                    // Update the input files
                    inp.files = allFiles.files;
                });
            });
        }

        function removeImage(button, imageId) {
            button.parentElement.remove();
            const existingImages = document.querySelector('input[name="existing_images[]"][value="' + imageId + '"]');
            if (existingImages) {
                existingImages.remove();
            }
        }

        getFile();
    </script>
@endsection

