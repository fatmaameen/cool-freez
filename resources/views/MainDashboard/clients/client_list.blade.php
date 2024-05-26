@extends('MainDashboard.layouts.master')

@section('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>.circular-link {
    display: inline-block;
    width: 40px; /* يمكنك ضبط العرض حسب رغبتك */
    height: 40px; /* يمكنك ضبط الارتفاع حسب رغبتك */
    line-height: 40px; /* يجعل النص والأيقونة في منتصف العنصر */
    border-radius: 50%; /* يجعل العنصر دائري الشكل */
    background-color: lightblue; /* لون الخلفية اللبني */
    color: rgb(17, 17, 17); /* لون النص والأيقونة */
    text-align: center; /* محاذاة النص والأيقونة في الوسط */
    text-decoration: none; /* لإزالة أي خطوط تحتية من الرابط */
}




/* إضافة تأثير التحويم (hover) لتحسين التصميم */
.circular-link {
    margin-right: 40px; /* تضيف مساحة على اليمين */
}


</style>
<style>
     body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
}
.table-bordered {
    border-color: #ADD8E6; /* Light blue */
}

        .table-bordered th,
        .table-bordered td {
            border-color: #ADD8E6;
            /* Light blue */
        }

        /* Customize the header background color */
        thead.bg-light {
            background-color: #E0F7FA;
            /* Light cyan */
        }

        /* switch */
        *,
        *:after,
        *:before {
            box-sizing: border-box;
        }

        #td {
            text-align: center;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkbox {
            position: relative;
            display: inline-block;
        }

        .checkbox:after,
        .checkbox:before {
            font-family: FontAwesome;
            font-feature-settings: normal;
            -webkit-font-kerning: auto;
            font-kerning: auto;
            font-language-override: normal;
            font-stretch: normal;
            font-style: normal;
            font-synthesis: weight style;
            font-variant: normal;
            font-weight: normal;
            text-rendering: auto;
        }

        .checkbox label {
            width: 68px;
            height: 18px;
            background: #ccc;
            position: relative;
            display: inline-block;
            border-radius: 46px;
            transition: 0.4s;
            margin: 0 !important;
        }

        .checkbox label:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 100%;
            left: 0;
            top: -5px;
            z-index: 2;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transition: 0.4s;
        }

        .checkbox input {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 5;
            opacity: 0;
            cursor: pointer;
            background: #3fb454;
        }

        .checkbox input:hover+label:after {
            box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.2), 0 3px 8px 0 rgba(0, 0, 0, 0.15);
        }

        .checkbox input:checked+label:after {
            left: 40px;
        }

        .model-7 .checkbox label {
            background: none;
            border: 2.5px solid #329043;
            height: 19.5px;
        }

        .model-7 .checkbox label:after {
            background: #329043;
            box-shadow: none;
            top: 2px;
            left: 2px;
            width: 12px;
            height: 12px;
        }

        .model-7 .checkbox input:checked+label {
            border-color: #a82626;
        }

        .model-7 .checkbox input:checked+label:after {
            background: #a82626;
            left: 50px;
        }

        #search-btn {
            background-color: #fff;
            color: #91c5d0;
            margin-right: 3px !important;
            transition: 0.3s ease-in-out;
            border: 1px solid #91c5d0;
        }

        #search-btn:hover {
            background-color: #91c5d0;
            color: #fff;
        }

        #reset-btn {
            background-color: #fff;
            color: #a82626;
            transition: 0.3s ease-in-out;
            border: 1px solid #a82626;
        }

        #reset-btn:hover {
            background-color: #a82626;
            color: #fff;
        }

        #searchInput {
            padding: 13px !important;
            margin-right: 3px !important;
            margin-left: 3px !important;
        }

        .col-md-6 {
            display: flex !important;
            flex-direction: row !important;
        }
    </style>
@endsection

@section('title')
    {{ trans('main_trans.clients') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.clients') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                   <h6><li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                            class="default-color">{{ trans('main_trans.Dashboard') }}</a></li></h6>
                <h6><li class="breadcrumb-item active">/{{ trans('main_trans.clients') }}</li></h6>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="container-fluid">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center align-items-center ">
                            <div class="col-xm-10 col-sm-5 col-md-6">
                                <input type="text" class="form-control p-3" id="searchInput"
                                    placeholder="{{ trans('main_trans.search_by') }} ...">
                                <button id="search-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="searchOnKeyUp()"
                                    type="submit">{{ trans('main_trans.search') }}</button>
                                <button id="reset-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="allData()"
                                    type="reset">{{ trans('main_trans.reset') }}</button>
                            </div>
                        </div>


                        <div class="row mb-3"> <!-- إضافة مسافة تحتية للعنصر -->
                            <div class="col-md-6"> <!-- استخدام العمود لتحديد عرض العنصر -->

                            </div>
                        </div>
                        <table class="table table-bordered  w-100" id="clientTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.user_name') }}</th>
                                    <th scope="col">{{ trans('main_trans.email') }}</th>
                                    <th scope="col">{{ trans('main_trans.avatar') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>
                                    <th scope="col">{{ trans('main_trans.address') }}</th>
                                    <th id="td" scope="col">{{ trans('main_trans.status') }}</th>
                                    <th scope="col">{{ trans('main_trans.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>
                                            <div class="ul-widget-app__profile-pic">
                                                <img class="rounded-circle" src="{{ $client->image }}" width="60"
                                                    height="60">
                                            </div>
                                        </td>
                                        <td>{{ $client->phone_number }}</td>
                                        <td>{{ $client->address }}</td>
                                        <td id="td">
                                            <section class="model-7">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="switchCheckDefault{{ $client->id }}"
                                                        {{ $client->is_banned ? 'checked' : '' }}
                                                        data-client-id="{{ $client->id }}"
                                                        onchange="updateColumn(this)" />
                                                    <label></label>
                                                </div>
                                            </section>
                                        </td>
                                        <td>
                                            <a href="{{ route('clients.history', $client->id) }}" class="circular-link">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{ $client->id }}')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- Create User Modal -->

    <!-- Create User Modal -->

<!-- Edit User Modals -->
@foreach ($clients as $client)
<div class="modal fade" id="deleteModal{{ $client['id'] }}" data-bs-backdrop="static" tabindex="-1"
aria-labelledby="deleteModalLabel{{ $client['id'] }}" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel{{ $client['id'] }}"></h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('clients.delete', $client['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <h5>{{ trans('main_trans.delete_text') }}</h5>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ trans('main_trans.close') }}
                    </button>
                    <button type="submit" class="btn btn-danger">{{ trans('main_trans.delete') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


@endforeach
<!-- Edit User Modals -->

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </script>

    {{-- <script>
        const passwordInput = document.getElementById('password-input');
        const eyeIcon = document.getElementById('eye-icon');

        // Add event listener to toggle password visibility
        eyeIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Change eye icon based on password visibility
            if (type === 'password') {
                eyeIcon.classList.remove('ri-eye-off-fill');
                eyeIcon.classList.add('ri-eye-fill');
            } else {
                eyeIcon.classList.remove('ri-eye-fill');
                eyeIcon.classList.add('ri-eye-off-fill');
            }
        });
    </script> --}}


    <script>
        // Function to open delete modal
        function openDeleteModal(userId) {
            var deleteModalId = '#deleteModal' + userId;
            $(deleteModalId).modal('show');
        }
    </script>
    {{-- <script>
        // Get the checkbox element
        var assignedCheckbox = document.getElementById('assignedCheckbox');

        // Add event listener to checkbox change
        assignedCheckbox.addEventListener('change', function() {
            // Get the hidden input element
            var assignedInput = document.querySelector('input[name="is_banned"]');

            // Update the value based on checkbox state
            assignedInput.value = this.checked ? 1 : 0;

            // Get the form element
            var updateForm = document.getElementById('updateForm');

            // Submit the form
            updateForm.submit();
        });
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'success') }}";  // تغيير القيمة الافتراضية إلى 'success'
            toastr.options.timeOut = 10000;
            var message = "{{ Session::get('message') }}";

            switch (type) {
                case 'info':
                    toastr.info(message);
                    break;
                case 'success':
                    toastr.success(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                case 'error':
                    toastr.error(message); // هنا قمنا بتغيير اللون إلى الأحمر في حالة الخطأ
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
            }
        @endif
    </script>

    <script>
        function updateColumn(checkbox) {
            var clientId = checkbox.dataset.clientId;
            var assignedValue = checkbox.checked ? 1 : 0;

            fetch('/main-dashboard/clients/banned/' + clientId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        is_banned: assignedValue
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                        if (data.alertType === 'success') {
                            toastr.success(data.message);
                        } else {
                            toastr.success(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        toastr.error('Update failed. Please try again later.');
                    });
            }
        </script>
    <script>
        function searchOnKeyUp() {
            var input = document.getElementById("searchInput");
            var searchText = input.value.trim();
            if (searchText != '') {
                fetch('/main-dashboard/clients/search/' + searchText)
                    .then(response => response.json())
                    .then(data => {
                        updateTable(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function allData() {
            var input = document.getElementById("searchInput");
            if (input.value != '') {
                input.value = '';
                fetch('/main-dashboard/clients/search/null')
                    .then(response => response.json())
                    .then(data => {
                        updateTable(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function updateTable(data) {
            var table = document.getElementById("clientTable");
            var tbody = table.getElementsByTagName('tbody')[0];
            tbody.innerHTML = '';
            data.forEach(function(client, index) {
                var row = tbody.insertRow();
                row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>${client.name}</td>
                                <td>${client.email}</td>
                                <td>
                                    <img class="rounded-circle" src="${client.image}" width="60" height="60">
                                </td>
                                <td>${client.phone_number}</td>
                                <td>${client.address}</td>
                                <td id="td">
                                    <section class="model-7">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="switchCheckDefault${client.id }"
                                                        ${client.is_banned ? 'checked' : '' }
                                                        data-client-id="${client.id}"
                                                        onchange="updateColumn(this)" />
                                                    <label></label>
                                                </div>
                                            </section>
                                </td>
                            `;
            });
        }
    </script>

@endsection
