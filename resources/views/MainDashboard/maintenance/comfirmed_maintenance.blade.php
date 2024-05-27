@extends('MainDashboard.layouts.master')

@section('css')

    <style>
        .status {
            font-size: 15px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .status-pending {
    background-color: #ffc107;
    color: #fff;
}


        .status-waiting {
            background-color: #ffc107;
            /* لون أصفر فاتح */
            color: #fffefe;
            /* نص أسود لتباين جيد */
        }

        .status-cancelled {
            background-color: #ff4d4d;
            /* لون أحمر فاتح */
            color: #fff;
            /* نص أبيض لتباين جيد */
        }

        .status-confirmed {
            background-color: #28a745;
            /* لون أخضر فاتح */
            color: #fff;
            /* نص أبيض لتباين جيد */
        }

.status-completed {
    background-color: #28a745;
    color: #fff;
}

.status-out-to-service {
    background-color: #28a745;
    color: #fff;
}


        .status-icon {
            margin-right: 5px;
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    <style>
          body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
}
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

        .form-select {
            background-color: #94deec;
            padding: 5px !important;
        }
    </style>
@endsection

@section('title')
    {{ trans('main_trans.comfirmed_maintenance') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.comfirmed_maintenance') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                   <h6><li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                            class="default-color">{{ trans('main_trans.Dashboard') }}</a></li></h6>
                <h6><li class="breadcrumb-item active">/{{ trans('main_trans.comfirmed_maintenance') }}</li></h6>
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
                                placeholder="{{ trans('main_trans.search_code') }}...">
                            <button id="search-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="search()"
                                type="submit">{{ trans('main_trans.search') }}</button>
                            <button id="reset-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="allData()"
                                type="reset">{{ trans('main_trans.reset') }}</button>
                        </div>

                    </div>


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
                                <th scope="col">{{ trans('main_trans.brand_name') }}</th>
                                <th scope="col">{{ trans('main_trans.device_type') }}</th>
                                <th scope="col">{{ trans('main_trans.type_of_malfunction') }}</th>
                                <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                                <th scope="col">{{ trans('main_trans.company_name') }}</th>
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
                                    <td>{{ $maintenance->brand }}</td>
                                    <td>{{ $maintenance->device_type }}</td>
                                    <td>{{ $maintenance->type_of_malfunction }}</td>

                                    <td>
                                        @if ($maintenance->admin_status == 'waiting')
                                            <span class="status status-waiting">
                                                <i class="status-icon fas fa-clock"></i>
                                                Waiting
                                            </span>
                                        @elseif ($maintenance->admin_status == 'cancelled')
                                            <span class="status status-cancelled">
                                                <i class="status-icon fas fa-times-circle"></i>
                                                Cancelled
                                            </span>
                                        @elseif ($maintenance->admin_status == 'confirmed')
                                            <span class="status status-confirmed">
                                                <i class="status-icon fas fa-check-circle"></i>
                                                Confirmed
                                            </span>
                                        @endif
                                        <td>

                                            <select id="select_{{ $maintenance->id }}" class="form-select form-select-sm"
                                                aria-label="Small select example"
                                                onchange="updateMaintenance({{ $maintenance->id }})">
                                                @if (!$maintenance->company_id)
                                                <option selected value="null">{{ trans('main_trans.not_assigned') }}</option>
                                                @endif
                                                @foreach ($companies as $company)
                                                    @if ($maintenance->company_id == $company->id)
                                                        <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @else
                                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                        @if ($maintenance->technical_id)
                                            @php
                                                $name = App\Models\technician::where(
                                                    'id',
                                                    $maintenance->technical_id,
                                                )->first();
                                            @endphp
                                            {{ $name->name }}
                                        @else
                                            {{ trans('main_trans.dont_have') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($maintenance->company_status == 'pending')
                                            <span class="status status-pending">
                                                <i class="status-icon fas fa-clock"></i>
                                                pending
                                            </span>
                                        @elseif ($maintenance->company_status == 'cancelled')
                                            <span class="status status-cancelled">
                                                <i class="status-icon fas fa-times-circle"></i>
                                                Cancelled
                                            </span>
                                        @elseif ($maintenance->company_status == 'confirmed')
                                            <span class="status status-confirmed">
                                                <i class="status-icon fas fa-check-circle"></i>
                                                Confirmed
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($maintenance->technical_status == 'pending')
                                            <span class="status status-pending">
                                                <i class="status-icon fas fa-clock"></i>
                                                Pending
                                            </span>
                                        @elseif ($maintenance->technical_status == 'cancelled')
                                            <span class="status status-cancelled">
                                                <i class="status-icon fas fa-times-circle"></i>
                                                Cancelled
                                            </span>
                                        @elseif ($maintenance->technical_status == 'completed')
                                            <span class="status status-completed">
                                                <i class="status-icon fas fa-check-circle"></i>
                                                Completed
                                            </span>
                                        @elseif ($maintenance->technical_status == 'out to service')
                                            <span class="status status-out-to-service">
                                                <i class="status-icon fas fa-wrench"></i>
                                                Out to Service
                                            </span>
                                        @endif
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
 <script>
    function updateMaintenance(maintenanceId) {
        var company_id = document.getElementById('select_' + maintenanceId).value;
        fetch('/main-dashboard/maintenance/assign/' + maintenanceId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    company_id: company_id
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    // في حالة وجود خطأ، تُظهر رسالة توستر للفشل
                    toastr.error('{{ trans('main_trans.deleting') }}', 'Success', {timeOut: 5000});
                } else {
                    // في حالة نجاح التحديث، تُظهر رسالة توستر للنجاح
                    toastr.success('{{ trans('main_trans.adding') }}', 'Success', {timeOut: 5000});
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // في حالة وجود خطأ في الشبكة، تُظهر رسالة توستر للفشل
                toastr.error('{{ trans('main_trans.deleting') }}', 'Success', {timeOut: 5000});
            });
    }
</script>
@endsection
