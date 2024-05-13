@extends('CompanyDashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .blue-button {
            background-color: #94deec;
            /* لتغيير لون الخلفية إلى الأزرق */
            color: rgb(19, 18, 18);
            /* لتغيير لون النص إلى الأبيض */
            border: none;
            /* لإزالة الحدود */
            padding: 10px 20px;
            /* يمكنك تعديل حجم الوسادة */
            border-radius: 5px;
            /* يمكنك تعديل نصف القطر للإطار */
            cursor: pointer;
            /* لإظهار مؤشر اليد */
        }
    </style>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection

@section('title')
    {{ trans('main_trans.technician') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.technician') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                            class="default-color">{{ trans('main_trans.Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('main_trans.technician') }}</li>
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
                                    placeholder="Search by name or email ...">
                                <button id="search-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="searchOnKeyUp()"
                                    type="submit">Search</button>
                                <button id="reset-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="allData()"
                                    type="reset">Reset</button>
                            </div>
                        </div>
                        <div id="messageContainer"></div>
                        @if (session('message'))
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
                        @endif
                        <br><br>

                        <div class="row mb-3"> <!-- إضافة مسافة تحتية للعنصر -->
                            <div class="col-md-6"> <!-- استخدام العمود لتحديد عرض العنصر -->
                                <button type="button" class="blue-button" data-bs-toggle="modal"
                                    data-bs-target="#createUserModal">
                                    <i class="fa-solid fa-plus"></i> {{ trans('main_trans.create') }}
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered  w-100" id="technicianTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.avatar') }}</th>
                                    <th scope="col">{{ trans('main_trans.user_name') }}</th>
                                    <th scope="col">{{ trans('main_trans.email') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>
                                    <th scope="col">{{ trans('main_trans.status') }}</th>
                                    <th scope="col">{{ trans('main_trans.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($technicians as $technician)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <div class="ul-widget-app__profile-pic">
                                                <img class="rounded-circle" src="{{ $technician->image }}" width="60"
                                                    height="60">
                                            </div>
                                        </td>
                                        <td>{{ $technician->name }}</td>
                                        <td>{{ $technician->email }}</td>
                                        <td>{{ $technician->phone_number }}</td>
                                        <td id="td">
                                            <section class="model-7">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="switchCheckDefault{{ $technician->id }}"
                                                        {{ $technician->is_banned ? 'checked' : '' }}
                                                        data-technician-id="{{ $technician->id }}"
                                                        onchange="updateColumn(this)" />
                                                    <label></label>
                                                </div>
                                            </section>
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="#" data-toggle="modal"
                                                data-target="#editModal{{ $technician->id }}">
                                                <i class="fas fa-pen-to-square fa-2xl"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $technician->id }}">
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
    </div>
    <!-- row closed -->

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.create') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('technician.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('main_trans.user_name') }}</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('main_trans.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password-input">{{ trans('main_trans.password') }}</label>
                            <div class="position-relative auth-pass-inputgroup">
                                <input type="password" class="form-control pe-5 password-input"
                                    placeholder="{{ trans('main_trans.enter_password') }}" name="password"
                                    id="password-input">
                                <button
                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                    type="button" id="password-addon">
                                    <i class="ri-eye-fill align-middle" id="eye-icon"></i>
                                </button>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="phone_number">{{ trans('main_trans.phone') }}</label>
                            <input type="number" class="form-control" id="phone_number" name="phone_number">
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('main_trans.avatar') }}</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ trans('main_trans.close') }}
                            </button>
                            <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Create User Modal -->
    @foreach ($technicians as $technician)
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $technician->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $technician->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $technician->id }}">{{ trans('main_trans.edit') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('technician.update', $technician->id) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ trans('main_trans.user_name') }}</label>
                                <input type="text" class="form-control" id="name{{ $technician->id }}" name="name"
                                    value="{{ $technician->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ trans('main_trans.email') }}</label>
                                <input type="email" class="form-control" id="email{{ $technician->id }}" name="email"
                                    value="{{ $technician->email }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="password-input">{{ trans('main_trans.password') }}</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password" class="form-control pe-5 password-input" name="password"
                                        id="password-input{{ $technician->id }}">
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon{{ $technician->id }}">
                                        <i class="ri-eye-fill align-middle" id="eye-icon{{ $technician->id }}"></i>
                                    </button>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="phone_number">{{ trans('main_trans.phone') }}</label>
                                <input type="number" class="form-control" id="phone_number{{ $technician->id }}" name="phone_number"
                                    value="{{ $technician->phone_number }}">
                            </div>
                            <div class="form-group">
                                <label for="image">{{ trans('main_trans.avatar') }}</label>
                                <input type="file" class="form-control" id="image{{ $technician->id }}" name="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                                <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal{{ $technician->id }}" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $technician->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $technician->id }}"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>{{ trans('main_trans.delete_text') }}</h5>
                        <form action="{{ route('technician.delete', $technician->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                                <button type="submit" class="btn btn-danger">{{ trans('main_trans.delete') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
@section('js')


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


    <script>
        function updateColumn(checkbox) {
            var technicianId = checkbox.dataset.technicianId;
            var assignedValue = checkbox.checked ? 1 : 0;

            fetch('/company-dashboard/technician/banned/' + technicianId, {
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
        function searchOnKeyUp() {
            var input = document.getElementById("searchInput");
            var searchText = input.value.trim();
            if (searchText != '') {
                fetch('/company-dashboard/technician/search/' + searchText)
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
                fetch('/company-dashboard/technician/search/null')
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
            var table = document.getElementById("technicianTable");
            var tbody = table.getElementsByTagName('tbody')[0];
            tbody.innerHTML = '';
            data.forEach(function(technician, index) {
                var row = tbody.insertRow();
                row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>
                            <div class="ul-widget-app__profile-pic">
                                    <img class="rounded-circle" src="${technician.image}" width="60"
                                        height="60">
                            </div>
                            </td>
                            <td>${technician.name}</td>
                            <td>${technician.email}</td>
                            <td>${technician.phone_number}</td>
                            <td id="td">
                                <section class="model-7">
                                    <div class="checkbox">
                                        <input type="checkbox" id="switchCheckDefault${technician.id}"
                                            ${technician.is_banned ? 'checked' : '' }
                                            data-technician-id="${technician.id}"
                                            onchange="updateColumn(this)" />
                                        <label></label>
                                    </div>
                                </section>
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <a href="#" data-toggle="modal"
                                    data-target="#editModal${technician.id}">
                                    <i class="fas fa-pen-to-square fa-2xl"></i>
                                </a>
                                <!-- Delete Button -->
                                <a href="#" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deleteModal${technician.id}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        `;
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
