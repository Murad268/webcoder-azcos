@extends('admin.app.app')
@section('content')

<div class="p-4 code-to-copy">
    <div id="tableExample4" data-list='{"valueNames":["name","email","payment"],"page":5,"pagination":true,"filter":{"key":"payment"}}'>
        <div class="row justify g-0">

        </div>
        <div class="table-responsive">
            <div style="column-gap: 10px" class="d-flex">
                <a class="badge badge-phoenix badge-phoenix-primary mb-3" style="padding: 7px" href="{{route('admin.number.create', $lang)}}">{{TranslateUtility::getTranslate('admin_index', 'add', TranslateUtility::getLang())}}</a>
                <a data-link="{{route('admin.number.delete_selected_numbers')}}" class="badge badge-phoenix badge-phoenix-danger mb-3 delete-all" style="padding: 7px; cursor: pointer; text-decoration : none">{{TranslateUtility::getTranslate('admin_index', 'delete_selected', TranslateUtility::getLang())}}</a>
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
                        <th class=" border-top border-translucent">{{TranslateUtility::getTranslate('admin_index', 'phone_number',TranslateUtility::getLang())}}</th>
                        <th class=" border-top border-translucent pe-3">{{TranslateUtility::getTranslate('admin_index', 'status', TranslateUtility::getLang())}}</th>
                        <th class=" border-top border-translucent pe-3">{{TranslateUtility::getTranslate('admin_index', 'operations', TranslateUtility::getLang())}}</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @php
                    $index = 0;
                    @endphp
                    @foreach($numbers as $number)
                    @php
                    $index++;
                    @endphp
                    <tr>
                        <td class="align-middle ps-3 name">{{$index}}</td>
                        <td class="align-middle ">
                            @if(!$number->is_default)
                            <div class="form-check">
                                <input data-id='{{$number->id}}' class="form-check-input select-number" id="flexCheckChecked" type="checkbox" value="" />
                            </div>
                            @else
                            <input style="display: none" data-id='{{$number->id}}' class="form-check-input select-number" id="flexCheckChecked" type="checkbox" value="" />
                            @endif
                        </td>

                        <td class="align-middle ps-3 name">{{$number->data}}</td>


                        <td class="align-middle payment py-3 pe-3">
                            @if($number->status)
                            <div class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="fw-bold">{{TranslateUtility::getTranslate('admin_index', 'status_active', TranslateUtility::getLang())}}</span><span class="ms-1 fas fa-check"></span></div>
                            @else
                            <div class="badge badge-phoenix fs-10 badge-phoenix-danger"><span class="fw-bold">{{TranslateUtility::getTranslate('admin_index', 'status_passive', TranslateUtility::getLang())}}</span><span class="ms-1 fas fa-times"></span></div>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('admin.number.edit',['number'=>$number->id, 'lang' => TranslateUtility::getLang()] )}}" class="btn btn-phoenix-success me-1 mb-1" type="button"><i class="fa fa-pencil"></i></a>

                                @if($number->status)
                                @if($activenumbersCount < 2 or $numbers->count() < 2) <a style="cursor: none" class="btn btn-phoenix-danger me-1 mb-1 change_status_false" type="button"><i class="fas fa-info" aria-hidden="true"></i></a>
                                        @else
                                        <a href="{{route('admin.number.changeStatusFalse', $number->id)}}" class="btn btn-phoenix-secondary me-1 mb-1 change_status_false" type="button"><i class="fas fa-lock-open" aria-hidden="true"></i></a>
                                        @endif

                                        @else
                                        <a href="{{route('admin.number.changeStatusTrue', $number->id)}}" class="btn btn-phoenix-secondary me-1 mb-1 change_status_true" type="button"><i class="fas fa-lock" aria-hidden="true"></i></a>
                                        @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>

    let selectednumbers = [];
    document.querySelectorAll('.select-number').forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            const id = e.target.getAttribute('data-id');
            if (e.target.checked) {
                if (!selectednumbers.includes(id)) {
                    selectednumbers.push(id);
                }
            } else {
                const index = selectednumbers.indexOf(id);
                if (index > -1) {
                    selectednumbers.splice(index, 1);
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
                cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no',TranslateUtility::getLang())) !!},
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
                    title: {!! json_encode(TranslateUtility::getTranslate('notification', 'confirm_status_change', $lang)) !!},
                    showCancelButton: true,
                    confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes', $lang)) !!},
                    cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no', $lang)) !!},
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({!! json_encode(TranslateUtility::getTranslate('notification', 'status_changed', $lang)) !!}, "", "success")
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
                    title: {!! json_encode(TranslateUtility::getTranslate('notification', 'confirm_status_change', $lang)) !!},
                    showCancelButton: true,
                    confirmButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'yes', $lang)) !!},
                    cancelButtonText: {!! json_encode(TranslateUtility::getTranslate('notification', 'no', $lang)) !!},
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({!! json_encode(TranslateUtility::getTranslate('notification', 'status_changed', $lang)) !!}, "", "success")
                        window.location.href = e.target.getAttribute("href");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            }
        });
    });




    const tbody = document.querySelector('tbody');

    Sortable.create(tbody, {
        animation: 150,
        onEnd: function(evt) {
            const items = evt.from.children;
            const numberuages = [];

            // Iterate through all the rows to get their data-id and current order
            for (let i = 0; i < items.length; i++) {
                const dataId = items[i].querySelector('.select-number').getAttribute('data-id');
                numberuages.push({
                    id: dataId,
                    order: i + 1
                });
            }

            // Send the entire list of numberuages with their new order to the API
            fetch(`{{ url('/api/admin/number/changeOrder') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(numberuages)
                })
                .then(response => response.json())
                .then(data => {
                    // location.reload();
                    console.log(data)
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
@endsection
