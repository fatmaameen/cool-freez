@extends('MainDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    <style>
        .form-select {
            width: 100%;
            /* يجعل العرض 100% من حجم الحاوية */
            font-size: 16px;
            /* لتكبير حجم النص داخل العنصر */
        }
    </style>

    <style>
        /* Customize the table's border color and row colors */
        .table-bordered {
            border-color: #ADD8E6;
            /* Light blue */
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
            background: #cccccc;
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
        }

        .checkbox input:hover+label:after {
            box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.2), 0 3px 8px 0 rgba(0, 0, 0, 0.15);
        }

        .checkbox input:checked+label:after {
            left: 40px;
        }

        .model-7 .checkbox label {
            background: none;
            border: 2.5px solid #555;
            height: 19.5px;
        }

        .model-7 .checkbox label:after {
            background: #555;
            box-shadow: none;
            top: 2px;
            left: 2px;
            width: 12px;
            height: 12px;
        }

        .model-7 .checkbox input:checked+label {
            border-color: #329043;
        }

        .model-7 .checkbox input:checked+label:after {
            background: #3fb454;
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
    {{ trans('main_trans.maintenance') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.maintenance') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                            class="default-color">{{ trans('main_trans.Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('main_trans.maintenance') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="container-fluid">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row d-flex justify-content-center align-items-center ">
                        <div class="col-xm-10 col-sm-5 col-md-6">
                            <input type="text" class="form-control p-3" id="searchInput"
                                placeholder="Search by code ...">
                            <button id="search-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="search()"
                                type="submit">Search</button>
                            <button id="reset-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="allData()"
                                type="reset">Reset</button>
                        </div>
                    </div>
                    <div id="messageContainer"></div>
                    {{-- @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <br><br>

                    <div class="row mb-3"> <!-- إضافة مسافة تحتية للعنصر -->
                        <div class="col-md-6"> <!-- استخدام العمود لتحديد عرض العنصر -->

                        </div>
                    </div>


                    <table class="table table-bordered" id="maintenanceTable">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>

                                <th scope="col">{{ trans('main_trans.code') }}</th>
                                <th scope="col">{{ trans('main_trans.address') }}</th>
                                <th scope="col">{{ trans('main_trans.street_address') }}</th>
                                <th scope="col">{{ trans('main_trans.phone') }}</th>
                                <th scope="col">{{ trans('main_trans.device_type') }}</th>
                                <th scope="col">{{ trans('main_trans.type_of_malfunction') }}</th>
                                <th scope="col">{{ trans('main_trans.admin_status') }}</th>

                                <th scope="col">{{ trans('main_trans.assigned') }}</th>
                                <th scope="col">{{ trans('main_trans.technical') }}</th>

                                <th scope="col">{{ trans('main_trans.company_status') }}</th>
                                <th scope="col"> {{ trans('main_trans.technical_status') }}</th>
                                <th scope="col">{{ trans('main_trans.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maintenances as $maintenance)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>

                                    <td>{{ $maintenance->code }}</td>
                                    <td>{{ $maintenance->address }}</td>
                                    <td>{{ $maintenance->street_address }}</td>
                                    <td>{{ $maintenance->phone_number }}</td>
                                    <td>{{ $maintenance->device_type }}</td>
                                    <td>{{ $maintenance->type_of_malfunction }}</td>

                                    <td>
                                        <span class="text-success"
                                            style="font-size: 20px">{{ $maintenance->admin_status }}</span>
                                    </td>
                                    <td id="td">
                                        <section class="model-7">
                                            <div class="checkbox">
                                                <input type="checkbox" id="switchCheckDefault{{ $maintenance->id }}"
                                                    {{ $maintenance->assigned ? 'checked' : '' }}
                                                    data-maintenance-id="{{ $maintenance->id }}"
                                                    onchange="updateColumn(this)" />
                                                <label></label>
                                            </div>
                                        </section>
                                    </td>
                                    @php
                                        // Fetch the technician with the given id
                                        $technical = App\Models\technician::find($maintenance->technical);
                                    @endphp
                                    <td>{{ $maintenance->technical_id }}</td>
                                    <td>
                                        <span class="text-success"
                                            style="font-size: 20px">{{ $maintenance->company_status }}</span>
                                    </td>
                                    <td>
                                        <span class="text-success"
                                            style="font-size: 20px">{{ $maintenance->technical_status }}</span>
                                    </td>
                                    <td>
                                        <a href="#editModal{{ $maintenance->id }}" data-toggle="modal"><i
                                                class="fas fa-pen-to-square fa-2xl"></i></a>

                                        <a href="#" class="btn btn-danger"
                                            onclick="openDeleteModal('{{ $maintenance->id }}')"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- Create User Modal -->

    <!-- Create User Modal -->

    <!-- Edit User Modals -->
    @foreach ($maintenances as $maintenance)
        <div class="modal fade" id="editModal{{ $maintenance->id }}" id="staticBackdrop" data-backdrop="static"
            tabindex="-1" aria-labelledby="editModalLabel{{ $maintenance->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $maintenance->id }}">
                            {{ trans('main_trans.edit') }}......</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
                            @csrf


                            <div class="form-group">
                                <h4> <label for="status">{{ trans('main_trans.technical') }}</label></h4>
                                <select class="form-select" aria-label="Default select example" name="admin_status">
                                    <option value="waiting">waiting</option>
                                    <option value="confirmed">confirmed</option>
                                    <option value="cancelled">cancelled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <h4> <label for="status">{{ trans('main_trans.admin_status') }}</label></h4>
                                <select class="form-select" aria-label="Default select example" name="admin_status">
                                    <option value="waiting">waiting</option>
                                    <option value="confirmed">confirmed</option>
                                    <option value="cancelled">cancelled</option>
                                </select>
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{ trans('main_trans.close') }}
                                </button>
                                <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal{{ $maintenance->id }}" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $maintenance->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $maintenance->id }}">
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('maintenance.delete', $maintenance->id) }}" method="POST">
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
        </div>
    @endforeach
    <!-- Edit User Modals -->

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>



    <script>
        function openDeleteModal(maintenanceId) {
            var deleteModalId = '#deleteModal' + maintenanceId;
            $(deleteModalId).modal('show');
        }
    </script>
    {{-- <script>
        // Get the checkbox element
        var assignedCheckbox = document.getElementById('assignedCheckbox');
        // Add event listener to checkbox change
        assignedCheckbox.addEventListener('change', function() {
            // Get the hidden input element
            var assignedInput = document.querySelector('input[name="assigned"]');
            // Update the value based on checkbox state
            assignedInput.value = this.checked ? 1 : 0;
        });
    </script> --}}
    <script>
        function updateColumn(checkbox) {
            var maintenanceId = checkbox.dataset.maintenanceId;
            var assignedValue = checkbox.checked ? 1 : 0;

            fetch('/main-dashboard/maintenance/assign/' + maintenanceId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        assigned: assignedValue
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    var messageContainer = document.getElementById('messageContainer');
                    messageContainer.innerHTML = '';
                    var messageDiv = document.createElement('div');
                    messageDiv.classList.add('alert');
                    if (data.error) {
                        messageDiv.classList.add('alert-danger');
                        messageDiv.textContent = 'Update failed. Please try again later.';
                    } else {
                        messageDiv.classList.add('alert-success');
                        messageDiv.textContent = data.message;
                    }
                    messageContainer.appendChild(messageDiv);
                    setTimeout(function() {
                        messageDiv.remove();
                    }, 5000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    var messageContainer = document.getElementById('messageContainer');
                    messageContainer.innerHTML = '';
                    var messageDiv = document.createElement('div');
                    messageDiv.classList.add('alert');
                    messageDiv.classList.add('alert-danger');
                    messageDiv.textContent = 'Update failed. Please try again later.';
                    messageContainer.appendChild(messageDiv);
                    setTimeout(function() {
                        messageDiv.remove();
                    }, 5000);
                });
        }
    </script>
    <script>
        function search() {
            var input = document.getElementById("searchInput");
            var searchText = input.value.trim();
            if (searchText != '') {
                fetch('/main-dashboard/maintenance/search/' + searchText)
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
                fetch('/main-dashboard/maintenance/search/null')
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
            var table = document.getElementById("maintenanceTable");
            var tbody = table.getElementsByTagName('tbody')[0];
            tbody.innerHTML = '';
            data.forEach(function(maintenance, index) {
                var row = tbody.insertRow();
                row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>${maintenance.code}</td>
                                <td>${maintenance.address}</td>
                                <td>${maintenance.street_address}</td>
                                <td>${maintenance.phone_number}</td>
                                <td>${maintenance.device_type}</td>
                                <td>${maintenance.type_of_malfunction}</td>
                                <td>
                                    <span class="text-success"style="font-size: 20px">${maintenance.admin_status}</span>
                                </td>
                                <td id="td">
                                    <section class="model-7">
                                            <div class="checkbox">
                                                <input type="checkbox" id="switchCheckDefault${maintenance.id}"
                                                    ${maintenance.assigned ? 'checked' : '' }
                                                    data-maintenance-id="${maintenance.id}"
                                                    onchange="updateColumn(this)" />
                                                <label></label>
                                            </div>
                                        </section>
                                </td>
                                <td>${maintenance.technical_id}</td>
                                    <td>
                                        <span class="text-success"
                                            style="font-size: 20px">${maintenance.company_status}</span>
                                    </td>
                                    <td>
                                        <span class="text-success"
                                            style="font-size: 20px">${maintenance.technical_status}</span>
                                    </td>
                                    <td>
                                        <a href="#editModal${maintenance.id}" data-toggle="modal"><i
                                                class="fas fa-pen-to-square fa-2xl"></i></a>

                                        <a href="#" class="btn btn-danger"
                                            onclick="openDeleteModal('${maintenance.id}')"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                    </td>
                            `;
            });
        }
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'error') }}";
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
@endsection
