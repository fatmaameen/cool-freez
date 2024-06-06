@extends('MainDashboard.layouts.master')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .error-message {
            font-size: 1.1rem;
            /* يمكنك تعديل حجم الخط حسب الحاجة */
            color: red;
            /* أو أي لون تفضله */
            /* أي خصائص أخرى تريدها */
        }
        body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
}
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

        .form-select {
            width: 100%;
            /* يجعل العرض 100% من حجم الحاوية */
            font-size: 16px;
            /* لتكبير حجم النص داخل العنصر */
        }

        /* Customize the table's border color and row colors */
        .table-bordered {
            border-color: #12aee2;
            /* Light blue */
        }

        .table-bordered th,
        .table-bordered td {
            border-color: #12aee2;
            /* Light blue */
        }

        /* Customize the header background color */
        thead.bg-light {
            background-color: #21dff8;
            /* Light cyan */
        }

        .form-select {
            background-color: #94deec;
            padding: 5px !important;
        }
    </style>
@endsection

@section('title')
    {{ trans('main_trans.companies_admins') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.companies_admins') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                            class="default-color">{{ trans('main_trans.Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('main_trans.companies_admins') }}</li>
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
            <div class="col-md-15 mb-30">
                <div class="card card-statistics h-70">
                    <div class="card-body">
                        <div id="messageContainer"></div>
                        <br><br>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <button type="button" class="blue-button" data-bs-toggle="modal"
                                    data-bs-target="#createUserModal">
                                    <i class="fa-solid fa-plus"></i> {{ trans('main_trans.create') }}
                                </button>
                            </div>
                        </div>

                        <table class="table table-bordered w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.avatar') }}</th>
                                    <th scope="col">{{ trans('main_trans.user_name') }}</th>
                                    <th scope="col">{{ trans('main_trans.email') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>
                                    <th scope="col">{{ trans('main_trans.company_name') }}</th>
                                    <th scope="col">{{ trans('main_trans.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <div class="ul-widget-app__profile-pic">
                                                <img class="rounded-circle" src="{{ $user->image }}" width="60"
                                                    height="60">
                                            </div>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->company->name }}</td>
                                        <td>
                                            <a href="#editModal{{ $user->id }}" data-toggle="modal">
                                                <i class="fas fa-pen-to-square fa-2xl"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger"
                                                onclick="openDeleteModal('{{ $user->id }}')">
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
        <!-- row closed -->

        <!-- Create User Modal -->

        <div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.create') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <form id="createUserForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">{{ trans('main_trans.user_name') }}</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <span class="error-message" id="name-error"></span>
                            </div>

                            <div class="form-group">
                                <label for="email">{{ trans('main_trans.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <span class="error-message" id="email-error"></span>
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
                                <span class="error-message" id="password-error"></span>
                            </div>

                            <div class="form-group">
                                <label for="phone_number">{{ trans('main_trans.phone') }}</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number">
                                <span class="error-message" id="phone_number-error"></span>
                            </div>

                            <div class="form-group">
                                <label for="image">{{ trans('main_trans.avatar') }}</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <span class="error-message" id="image-error"></span>
                            </div>

                            <div class="form-group">
                                <h6><label for="company_id">{{ trans('main_trans.companies') }}</label></h6>
                                <select class="form-select" aria-label="Default select example" name="company_id"
                                    id="company_id">
                                    <option value="null">{{ trans('main_trans.open_menu') }}</option>
                                    @foreach ($companies as $company)

                                            <option value="{{ $company->id }}">{{ $company->name }}</option>

                                    @endforeach
                                </select>
                                <span class="error-message" id="company_id-error"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    {{ trans('main_trans.close') }}
                                </button>
                                <button type="button" class="btn btn-primary"
                                    id="submitForm">{{ trans('main_trans.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('submitForm').addEventListener('click', function() {
                var formData = new FormData();
                formData.append('name', document.getElementById('name').value);
                formData.append('company_id', document.getElementById('company_id').value);
                formData.append('email', document.getElementById('email').value);
                formData.append('password', document.getElementById('password-input').value);
                formData.append('phone_number', document.getElementById('phone_number').value);
                formData.append('image', document.getElementById('image').files[0]);

                fetch('/main-dashboard/companies-admins/store', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => Promise.reject(data));
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            toastr.success('{{ trans('main_trans.adding') }}', 'Success', {
                                timeOut: 5000
                            });
                            window.location.href = "/main-dashboard/companies-admins"; // Redirect immediately
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                        if (error.errors) {
                            for (const field in error.errors) {
                                const errorMessage = error.errors[field][0];
                                document.getElementById(`${field}-error`).textContent = errorMessage;
                            }
                        } else {
                            alert('An error occurred. Please try again later.');
                        }
                    });
            });
        </script>

        <!-- Edit User Modals -->
        @foreach ($users as $user)
            <div class="modal fade" id="editModal{{ $user->id }}" id="staticBackdrop" data-backdrop="static"
                tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">
                                {{ trans('main_trans.edit') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('companyAdmins.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ trans('main_trans.user_name') }}</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ trans('main_trans.email') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label"
                                        for="password-input">{{ trans('main_trans.password') }}</label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input type="password"
                                            class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                            name="password" id="password-input">
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                            type="button" id="password-addon">
                                            <i class="ri-eye-fill align-middle" id="eye-icon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">{{ trans('main_trans.phone') }}</label>
                                    <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $user->phone_number) }}">
                                    @error('phone_number')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">{{ trans('main_trans.avatar') }}</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image">
                                    @error('image')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="company_id">{{ trans('main_trans.company_name') }}</label>
                                    <select class="form-select @error('company_id') is-invalid @enderror"
                                        aria-label="Default select example" name="company_id">
                                        {{-- <option selected>{{ trans('main_trans.open_menu') }}</option> --}}
                                        @foreach ($companies as $company)
                                            @if ($company->id == $user->company_id)
                                                <option selected value="{{ $company->id }}">{{ $company->name }}
                                                </option>
                                            @else
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        {{ trans('main_trans.close') }}
                                    </button>
                                    <button type="submit"
                                        class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="deleteModal{{ $user->id }}" data-bs-backdrop="static" tabindex="-1"
                aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}"></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('companyAdmins.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <h5>{{ trans('main_trans.delete_text') }}</h5>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        {{ trans('main_trans.close') }}
                                    </button>
                                    <button type="submit"
                                        class="btn btn-danger">{{ trans('main_trans.delete') }}</button>
                                </div>
                            </form>
                        </div>
                        </divdiv>
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
            // Function to open delete modal
            function openDeleteModal(userId) {
                var deleteModalId = '#deleteModal' + userId;
                $(deleteModalId).modal('show');
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
                        toastr.error(message);
                        var audio = new Audio('audio.mp3');
                        audio.play();
                        break;
                }
            @endif
        </script>

    @endsection
