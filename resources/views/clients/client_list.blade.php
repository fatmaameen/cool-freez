@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.clients') }}</li>
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

                    </div>
                </div>


                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th scope="col">{{ trans('main_trans.user_name') }}</th>
                            <th scope="col">{{ trans('main_trans.email') }}</th>
                            <th scope="col">{{ trans('main_trans.avatar') }}</th>
                            <th scope="col">{{ trans('main_trans.phone') }}</th>
                            <th scope="col">{{ trans('main_trans.address') }}</th>
                            <th scope="col">{{ trans('main_trans.status') }}</th>
                            {{-- <th scope="col">{{ trans('main_trans.edit_status') }}</th> --}}
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

                                <img class="rounded-circle"
                                src="{{'http://127.0.0.1:8000/'. $client->image}}"
                                width="60"
                                height="60"
>
                            </div>
                        </td>


                            <td>{{ $client->phone_number }}</td>
                            <td>{{ $client->address }}</td>

                            <td>
                                <form id="updateForm" method="POST" action="{{ route('clients.assign', $client->id) }}">
                                    @csrf
                                    <input type="hidden" name="is_banned" value="{{ $client->is_banned ? 1 : 0 }}">
                                    <div class="form-check form-switch text-center">
                                        <input class="form-check-input" type="checkbox" role="switch" id="assignedCheckbox" @if ($client->is_banned) checked @endif>
                                    </div>
                                </form>
                            </td>

                                <script>
                                    function updateColumn() {
                                        var form = document.getElementById('updateForm');
                                        var assignedValue = document.getElementById('switchCheckDefault').checked ? 1 : 0;
                                        form.querySelector('input[name="is_banned"]').value = assignedValue;

                                        fetch(form.action, {
                                                method: 'POST',
                                                body: new FormData(form)
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                var messageContainer = document.getElementById('messageContainer');
                                                messageContainer.innerHTML = '';
                                                var messageDiv = document.createElement('div');
                                                messageDiv.classList.add('alert');
                                                if (data.error) {
                                                    messageDiv.classList.add('alert-danger');
                                                } else {
                                                    messageDiv.classList.add('alert-success');
                                                }
                                                messageDiv.textContent = data.message;
                                                messageContainer.appendChild(messageDiv);
                                                setTimeout(function() {
                                                    messageDiv.remove();
                                                }, 5000);
                                            })
                                            .catch(error => {
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

                                <style>
                                    .form-check-input:checked {
                                        background-color: rgb(248, 27, 75) !important;
                                        border-color: rgb(250, 30, 30) !important;
                                    }

                                    .form-switch .form-check-input {
                                        margin-right: 2em !important;
                                        width: 4em;
                                        height: 1.5em;
                                        background-color: #575757;
                                        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
                                    }

                                    .form-switch {
                                        margin-right: 1.7em !important;
                                        ;
                                    }
                                </style>
                            </td>
                            {{-- <td>
                                <a href="#editModal{{ $client->id }}" class="btn btn-primary"
                                    data-toggle="modal">{{ trans('main_trans.edit') }}</a>


</td> --}}

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
@foreach ($clients as $client)
<div class="modal fade" id="editModal{{ $client->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $client->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $client->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clients.update' ,$client->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="status">{{ trans('main_trans.status') }}</label>
                        <select class="form-select" aria-label="Default select example" name="is_banned">
                            <option value="1" {{ $client->is_banned == 1 ? 'selected' : '' }}>{{ trans('main_trans.active') }}</option>
                            <option value="0" {{ $client->is_banned == 0 ? 'selected' : '' }}>{{ trans('main_trans.block') }}</option>
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


@endforeach
<!-- Edit User Modals -->

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
    // Function to open delete modal
    function openDeleteModal(userId) {
        var deleteModalId = '#deleteModal' + userId;
        $(deleteModalId).modal('show');
    }
</script>
<script>
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

</script>
@endsection
