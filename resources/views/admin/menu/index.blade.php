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
                <a class="badge badge-phoenix badge-phoenix-primary mb-3" style="padding: 7px" href="{{route('admin.menu.create', $lang)}}">{{TranslateUtility::getTranslate('admin_index', 'add', TranslateUtility::getLang())}}</a>
                <a data-link="{{route('admin.menu.delete_selected_menu_items')}}" class="badge badge-phoenix badge-phoenix-danger mb-3 delete-all" style="padding: 7px; cursor: pointer; text-decoration : none">{{TranslateUtility::getTranslate('admin_index', 'delete_selected', TranslateUtility::getLang())}}</a>
                <div>
                    <form>
                        <input value="{{$q}}" style=" padding: 4px" name="q" class="form-control" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_index', 'search', TranslateUtility::getLang())}}" />
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
                        <th class=" border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'choose', TranslateUtility::getLang())}}</th>
                        <th class=" border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'name', TranslateUtility::getLang())}}</th>
                        <th class=" border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'slug', TranslateUtility::getLang())}}</th>
                        <th class=" border-top border-translucent pe-3">{{TranslateUtility::getTranslate('admin_index', 'operations', TranslateUtility::getLang())}}</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @php
                    $index = 0;
                    @endphp
                    @foreach($menus as $menu)
                    @php
                    $index++;
                    @endphp
                    <tr>
                        <td class="align-middle ps-3 name">{{$index}}</td>
                        <td class="align-middle ">
                            <div class="form-check">
                                <input data-id='{{$menu->id}}' class="form-check-input select-lang" id="flexCheckChecked" type="checkbox" value="" />
                            </div>
                        </td>
                        <td class="align-middle ps-3 name">{{$menu->code}}</td>
                        <td class="align-middle ps-3 name">{{$menu->getWithLocale(TranslateUtility::getLang()) ? $menu->getWithLocale(TranslateUtility::getLang())->slug: "" }}</td>






                        <td class="align-middle ps-3 name">
                            <a href="{{route('admin.menu.edit', ['lang' => TranslateUtility::getLang(), 'menu' => $menu->id])}}" class="btn btn-phoenix-success me-1 mb-1" type="button"><i class="fa fa-pencil"></i></a>


                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin: 0 auto; width: max-content; margin-top: 25px">
                {{$menus->links()}}
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
                title: {!! json_encode(TranslateUtility::getTranslate('notification', 'are_you_sure_to_delete',TranslateUtility::getLang())) !!},
                showCancelButton: true,
                confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes', TranslateUtility::getLang())) !!},
                cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no', TranslateUtility::getLang())) !!},
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
            Swal.fire({!! json_encode(TranslateUtility::getTranslate('notification', 'nothing_selected', TranslateUtility::getLang())) !!}, "", "info");
        }
    });













</script>
@endsection
