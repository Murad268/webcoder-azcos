@extends('admin.app.app')
@section('content')

<div class="p-4 code-to-copy">
    <div id="tableExample4" data-list='{"valueNames":["name","email","payment"],"page":5,"pagination":true,"filter":{"key":"payment"}}'>
        <div class="row justify g-0"></div>
        <div class="table-responsive">
            <div style="column-gap: 10px" class="d-flex">
                <a class="badge badge-phoenix badge-phoenix-primary mb-3" style="padding: 7px" href="{{route('admin.translates.create', $lang)}}">{{TranslateUtility::getTranslate('admin_index', 'add', $current_lag)}}</a>
                <a data-link="{{route('admin.translates.delete_selected_translates')}}" class="badge badge-phoenix badge-phoenix-danger mb-3 delete-all" style="padding: 7px; cursor: pointer; text-decoration: none">{{TranslateUtility::getTranslate('admin_index', 'delete_selected', $current_lag)}}</a>
                <div>
                    <form>
                        <input value="{{$q}}" style="padding: 4px" name="q" class="form-control" id="exampleFormControlInput" type="text" placeholder="{{TranslateUtility::getTranslate('admin_index', 'search', $current_lag)}}" />
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
                <thead class="change_one" data-link="{{route('admin.translates.update_one_translation')}}">
                    <tr class="bg-body-highlight">
                        <th class="border-top border-translucent ps-3">#</th>
                        <th class="border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'choose', TranslateUtility::getLang())}}</th>
                        <th class="border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'translate_group',TranslateUtility::getLang())}}</th>
                        <th class="border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'translate_code', TranslateUtility::getLang())}}</th>
                        <th class="border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'translate', TranslateUtility::getLang())}}</th>
                        <th class="border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'lang_code', TranslateUtility::getLang())}}</th>
                        <th class="border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'operations', TranslateUtility::getLang())}}</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @php
                    $index = 0;
                    @endphp
                    @foreach($translates as $translate)
                    @php
                    $index++;
                    @endphp
                    <tr>
                        <td class="align-middle ps-3 name">{{$index}}</td>
                        <td class="align-middle">
                            <div class="form-check">
                                <input data-id='{{$translate->translate->id}}' class="form-check-input select-lang" id="flexCheckChecked" type="checkbox" value="" />
                            </div>
                        </td>
                        <td class="align-middle ps-3 name">{{$translate->translate->group}}</td>
                        <td class="align-middle ps-3 name">{{$translate->translate->code}}</td>
                        <td class="align-middle ps-3 name">
                            <span class="editable" data-id="{{$translate->id}}" data-locale="{{$translate->locale}}" contenteditable="true" style="min-width: 150px; display: inline-block;">{{$translate->value}}</span>
                        </td>
                        <td class="align-middle ps-3 name">{{$translate->locale}}</td>
                        <td class="align-middle ps-3 name">
                            <a href="{{route('admin.translates.edit', ['translate' => $translate->translate->id, 'lang' => TranslateUtility::getLang()])}}" class="btn btn-phoenix-success me-1 mb-1" type="button"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin: 0 auto; width: max-content; margin-top: 25px">
                {{$translates->links()}}
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
                title: {!! json_encode(TranslateUtility::getTranslate('notification', 'are_you_sure_to_delete', TranslateUtility::getLang())) !!},
                showCancelButton: true,
                confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes', TranslateUtility::getLang())) !!},
                cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no', TranslateUtility::getLang())) !!},
                position: 'top-end'
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
                            Swal.fire({
                                icon: 'success',
                                title: data.success,
                                position: 'top-end',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        }).catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: {!! json_encode(TranslateUtility::getTranslate('notification', 'nothing_selected', TranslateUtility::getLang())) !!},
                position: 'top-end',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
document.querySelectorAll('.editable').forEach(element => {
    element.addEventListener('blur', (e) => {
        const id = e.target.getAttribute('data-id');
        const locale = e.target.getAttribute('data-locale');
        const newValue = e.target.innerText;

        fetch('{{route("admin.translates.update_one_translation")}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: id,
                locale: locale,
                value: newValue
            })
        }).then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            Swal.fire({
                icon: 'success',
                title: '',
                position: 'top-end',
                timer: 500,
                showConfirmButton: false,
                width: '300px',
                heightAuto: false
            });
        }).catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                position: 'top-end',
                timer: 500,
                showConfirmButton: false,
                width: '300px',
                heightAuto: false
            });
        });
    });
});

</script>
@endsection
