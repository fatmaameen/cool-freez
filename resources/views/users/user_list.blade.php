@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>/* Customize the table's border color and row colors */
.table-bordered {
    border-color: #12aee2; /* Light blue */
}

.table-bordered th,
.table-bordered td {
    border-color: #12aee2; /* Light blue */
}

/* Customize the header background color */
thead.bg-light {
    background-color: #21dff8; /* Light cyan */
}
</style>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection

@section('title')
      {{ trans('main_trans.admins') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.admins') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.admins') }}</li>
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

                @if(session('message'))
                <div class="alert alert-success">
                    <div id="messageContainer"></div>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            {{ trans('main_trans.create') }}
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
                            <th scope="col">{{ trans('main_trans.role') }}</th>
                            <th scope="col">{{ trans('main_trans.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <div class="ul-widget-app__profile-pic">
                                    <img class="rounded-circle" src="{{ $user->image }}" width="60" height="60">
                                </div>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ App\Models\Role::where('id', $user->role_id)->value('role') }}</td>
                            <td>
                                <a href="#editModal{{ $user->id }}" class="btn btn-primary" data-toggle="modal">
                                    {{ trans('main_trans.edit') }}
                                </a>
                                <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{ $user->id }}')">
                                    {{ trans('main_trans.delete') }}
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
<div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.create') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="password" class="form-control pe-5 password-input" placeholder="{{ trans('main_trans.enter_password') }}"  name="password" id="password-input">
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                                <i class="ri-eye-fill align-middle" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="phone">{{ trans('main_trans.phone') }}</label>
                        <input type="number" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="image">{{ trans('main_trans.avatar') }}</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="role">{{ trans('main_trans.role') }}</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option selected>{{ trans('main_trans.open_menu') }}</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                            @endforeach
                        </select>
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

<!-- Edit User Modals -->
@foreach ($users as $user)
<div class="modal fade" id="editModal{{ $user->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.update' ,$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="username">{{ trans('main_trans.user_name') }}</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('main_trans.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password-input">{{ trans('main_trans.password') }}</label>
                        <div class="position-relative auth-pass-inputgroup">
                            <input type="password" class="form-control pe-5 password-input"   name="password" id="password-input">
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                                <i class="ri-eye-fill align-middle" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="phone">{{ trans('main_trans.phone') }}</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="{{ $user->phone_number }}">
                    </div>
                    <div class="form-group">
                        <label for="image">{{ trans('main_trans.avatar') }}</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ $user->image }}">
                    </div>
                    <div class="form-group">
                        <label for="role">{{ trans('main_trans.role') }}</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option selected>{{ trans('main_trans.open_menu') }}</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                            @endforeach
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


<div class="modal fade" id="deleteModal{{ $user->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.delete' ,$user->id) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <p>{{ trans('main_trans.delete_text') }}</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ trans('main_trans.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">{{ trans('main_trans.delete') }}</button>
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
</script>

{{-- <script>
    // عرض الرسالة بعد تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function() {
        var message = "{{ session('message') }}";
        if (message) {
            alert(message);
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

@endsection
