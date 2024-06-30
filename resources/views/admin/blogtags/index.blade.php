@extends('admin.app.app')
@section('links')
<style>
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
    <div id="tableExample4" data-list='{"valueNames":["name","email","payment"],"page":5,"pagination":true,"filter":{"key":"payment"}}'>
        <div class="row justify g-0">

        </div>
        <div class="table-responsive">
            <div style="column-gap: 10px" class="d-flex">
                <a class="badge badge-phoenix badge-phoenix-primary mb-3" style="padding: 7px" href="{{route('admin.blog_tag.create',  TranslateUtility::getLang())}}">{{TranslateUtility::getTranslate('admin_index', 'add',  TranslateUtility::getLang())}}</a>
                <a data-link="{{route('admin.blog_tag.delete_selected_categories')}}" class="badge badge-phoenix badge-phoenix-danger mb-3 delete-all" style="padding: 7px; cursor: pointer; text-decoration : none">{{TranslateUtility::getTranslate('admin_index', 'delete_selected',  TranslateUtility::getLang())}}</a>
                <div>
                    <form>
                        <input value="{{$q}}" style=" padding: 4px" name="q" class="form-control" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_index', 'search',  TranslateUtility::getLang())}}" />
                    </form>
                </div>
                @if (session('success'))
                <div class="text-success" role="alert">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                <div class="text-danger" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <table class="table table-sm fs-9 mb-0">
                <thead>
                    <tr class="bg-body-highlight">
                        <th class=" border-top border-translucent ps-3">#</th>
                        <th class=" border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'choose',  TranslateUtility::getLang())}}</th>

                        <th class=" border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'tag',  TranslateUtility::getLang())}}</th>

                        <th class=" border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'status',  TranslateUtility::getLang())}}</th>
                        <th class=" border-top border-translucent pe-3">{{TranslateUtility::getTranslate('admin_index', 'operations',  TranslateUtility::getLang())}}</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @php
                    $index = 0;
                    @endphp
                    @foreach($categories as $category)
                    @php
                    $index++;
                    @endphp
                    <tr>
                        <td class="align-middle ps-3 name">{{$index}}</td>
                        <td class="align-middle ">
                            <div class="form-check">
                                <input data-id='{{$category->id}}' class="form-check-input select-lang" id="flexCheckChecked" type="checkbox" value="" />
                            </div>
                        </td>

                        <td class="align-middle ps-3 name">{{$category->getWithLocale($lang) ? $category->getWithLocale($lang)->tag: "" }}</td>
                        <td class="align-middle payment py-3 pe-3">
                            @if($category->status)
                            <div class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="fw-bold">{{TranslateUtility::getTranslate('admin_index', 'status_active', TranslateUtility::getLang())}}</span><span class="ms-1 fas fa-check"></span></div>
                            @else
                            <div class="badge badge-phoenix fs-10 badge-phoenix-danger"><span class="fw-bold">{{TranslateUtility::getTranslate('admin_index', 'status_passive',  TranslateUtility::getLang())}}</span><span class="ms-1 fas fa-times"></span></div>
                            @endif
                        </td>
                        <td class="align-middle ps-3 name">
                            <a href="{{route('admin.blog_tag.edit', ['lang' => $lang, 'blog_tag' => $category->id])}}" class="btn btn-phoenix-success me-1 mb-1" type="button"><i class="fa fa-pencil"></i></a>




                            @if($category->status)
                            @if($activeCount < 2 or $categories->count() < 2) <a style="cursor: none" class="btn btn-phoenix-danger me-1 mb-1 change_status_false" type="button"><i class="fas fa-info" aria-hidden="true"></i></a>
                                    @else
                                    <a href="{{route('admin.blog_tag.changeStatusFalse', $category->id)}}" class="btn btn-phoenix-secondary me-1 mb-1 change_status_false" type="button"><i class="fas fa-lock-open" aria-hidden="true"></i></a>
                                    @endif
                                    @else
                                    <a href="{{route('admin.blog_tag.changeStatusTrue', $category->id)}}" class="btn btn-phoenix-secondary me-1 mb-1 change_status_true" type="button"><i class="fas fa-lock" aria-hidden="true"></i></a>
                                    @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin: 0 auto; width: max-content; margin-top: 25px">
                {{$categories->links()}}
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    let selectedLangs = [];
    document.querySelectorAll('.select-lang').forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            const id = e.target.getAttribute('data-id');
            if (e.target.checked) {
                if (!selectedLangs.includes(id)) {
                    selectedLangs.push(id);
                }
            } else {
                const index = selectedLangs.indexOf(id);
                if (index > -1) {
                    selectedLangs.splice(index, 1);
                }
            }
        });
    });

    document.querySelector('.delete-all').addEventListener('click', (e) => {
        e.preventDefault();
        const url = e.target.getAttribute('data-link');
        if (selectedLangs.length > 0) {
            Swal.fire({
                title: {!! json_encode(TranslateUtility::getTranslate('notification', 'are_you_sure_to_delete',  TranslateUtility::getLang())) !!},
                showCancelButton: true,
                confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes',  TranslateUtility::getLang())) !!},
                cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no',  TranslateUtility::getLang())) !!},
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            ids: selectedLangs
                        })
                    }).then(response => response.json())
                        .then(data => {
                            console.log(data);
                            Swal.fire(data.success, "", "success").then(() => {
                                location.reload();
                            });
                        }).catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', "", "error");
                    });
                }
            });
        } else {
            Swal.fire({!! json_encode(TranslateUtility::getTranslate('notification', 'nothing_selected', $lang)) !!}, "", "info");
        }
    });

    document.querySelectorAll('.change_status_false').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            if (e.target.getAttribute("href")) {
                Swal.fire({
                    title: {!! json_encode(TranslateUtility::getTranslate('notification', 'confirm_status_change', TranslateUtility::getLang())) !!},
                    showCancelButton: true,
                    confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes',  TranslateUtility::getLang())) !!},
                    cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no',  TranslateUtility::getLang())) !!},
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({!! json_encode(TranslateUtility::getTranslate('notification', 'status_changed',  TranslateUtility::getLang())) !!}, "", "success")
                        window.location.href = e.target.getAttribute("href");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            }
        });
    });

    document.querySelectorAll('.change_status_true').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            if (e.target.getAttribute("href")) {
                Swal.fire({
                    title: {!! json_encode(TranslateUtility::getTranslate('notification', 'confirm_status_change',  TranslateUtility::getLang())) !!},
                    showCancelButton: true,
                    confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes',  TranslateUtility::getLang())) !!},
                    cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no',  TranslateUtility::getLang())) !!},
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({!! json_encode(TranslateUtility::getTranslate('notification', 'status_changed', TranslateUtility::getLang())) !!}, "", "success")
                        window.location.href = e.target.getAttribute("href");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            }
        });
    });

    document.querySelectorAll('.delete_image').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const href = e.target.getAttribute('href');
            Swal.fire({
                title: {!! json_encode(TranslateUtility::getTranslate('notification', 'confirm_delete_image', TranslateUtility::getLang())) !!},
                showCancelButton: true,
                confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes',  TranslateUtility::getLang())) !!},
                cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no',  TranslateUtility::getLang())) !!},
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });





    const tbody = document.querySelector('tbody');

    Sortable.create(tbody, {
        animation: 150,
        onEnd: function(evt) {
            const items = evt.from.children;
            const languages = [];

            // Iterate through all the rows to get their data-id and current order
            for (let i = 0; i < items.length; i++) {
                const dataId = items[i].querySelector('.select-lang').getAttribute('data-id');
                languages.push({
                    id: dataId,
                    order: i + 1
                });
            }

            // Send the entire list of languages with their new order to the API
            fetch(`{{ url('/api/admin/blog_tag/changeOrder') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(languages)
                })
                .then(response => response.json())
                .then(data => {
                    // location.reload();
                    console.log(data)
                })
                .catch(error => console.error('Error:', error));
        }
    });
    // Add the event listener for delete_image buttons

</script>
@endsection
