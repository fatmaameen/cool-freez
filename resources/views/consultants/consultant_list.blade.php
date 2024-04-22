
@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection

@section('title')
{{ trans('main_trans.consultant') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.consultant') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.consultant') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if(session('message'))
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            {{ trans('main_trans.create') }}
                        </button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">  {{ trans('main_trans.avatar') }}</th>
                            <th scope="col">  {{ trans('main_trans.user_name') }}</th>

                            <th scope="col">  {{ trans('main_trans.job_title') }}</th>
                            <th scope="col">  {{ trans('main_trans.email') }}</th>
                            <th scope="col">  {{ trans('main_trans.phone') }}</th>

                            <th scope="col">  {{ trans('main_trans.rate') }}</th>
                            <th scope="col">{{ trans('main_trans.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultants as $consultant)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <div class="ul-widget-app__profile-pic">

                                <img class="rounded-circle"
                                src="{{'http://127.0.0.1:8000/consultants/'. $consultant->image}}"
                                width="60"
                                height="60"
>
                            </div>
                        </td>
                            <td>{{ $consultant->name }}</td>
                            <td>{{ $consultant->job_title }}</td>
                            <td>{{ $consultant->email }}</td>
                            <td>{{ $consultant->phone_number }}</td>


                            <td>{{ $consultant->rate }}</td>
                            <td>
                                <a href="#editModal{{ $consultant->id }}" class="btn btn-primary"
                                    data-toggle="modal">{{ trans('main_trans.edit') }}</a>

                             <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{ $consultant->id }}')">{{ trans('main_trans.delete') }}</a>
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

<!-- Create brand Modal -->
<div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">  {{ trans('main_trans.create') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('consultant.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ trans('main_trans.user_name') }}</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="job_title">{{ trans('main_trans.job_title') }}</label>
                        <input type="text" class="form-control" id="job_title" name="job_title">
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('main_trans.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="phone">{{ trans('main_trans.phone') }}</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="rate">{{ trans('main_trans.rate') }}</label>
                        <input type="number" class="form-control" id="rate" name="rate">
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


<!-- Edit User Modals -->
@foreach ($consultants as $consultant)
<div class="modal fade" id="editModal{{ $consultant->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $consultant->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $consultant->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('consultant.update', $consultant->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ trans('main_trans.user_name') }}</label>
                        <input type="text" class="form-control" id="name" name="name"  value="{{ $consultant->name }}">
                    </div>
                    <div class="form-group">
                        <label for="job_title">{{ trans('main_trans.job_title') }}</label>
                        <input type="text" class="form-control" id="job_title" name="job_title"  value="{{ $consultant->job_title }}">
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('main_trans.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email"  value="{{ $consultant->email }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">{{ trans('main_trans.phone') }}</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{ $consultant->phone_number }}">
                    </div>
                    <div class="form-group">
                        <label for="rate">{{ trans('main_trans.rate') }}</label>
                        <input type="number" class="form-control" id="rate" name="rate" value="{{ $consultant->rate }}">
                    </div>
                    <div class="form-group">
                        <label for="image">{{ trans('main_trans.avatar') }}</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ $consultant->image }}">
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

<div class="modal fade" id="deleteModal{{ $consultant->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel{{ $consultant->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $consultant->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('consultant.delete' ,$consultant->id) }}" method="POST" >
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
        </div>
    </div>
</div>
@endforeach
@endsection
<!-- Edit User Modals -->
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


<script>

    function openDeleteModal(maintenanceId) {
        var deleteModalId = '#deleteModal' + maintenanceId;
        $(deleteModalId).modal('show');
    }
</script>
<script>
    // Get the checkbox element
    var assignedCheckbox = document.getElementById('assignedCheckbox');
    // Add event listener to checkbox change
    assignedCheckbox.addEventListener('change', function() {
        // Get the hidden input element
        var assignedInput = document.querySelector('input[name="assigned"]');
        // Update the value based on checkbox state
        assignedInput.value = this.checked ? 1 : 0;
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+YE5O9wSFj/zIy4GfDMVNA/GpGFF93hXpG5KkN+" crossorigin="anonymous"></script>

@endsection
