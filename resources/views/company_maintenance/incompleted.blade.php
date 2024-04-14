@extends('layouts.master')

@section('css')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.maintenance') }}</li>
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

                    </div>
                </div>


                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">code</th>
                            <th scope="col">{{ trans('main_trans.address') }}</th>
                            <th scope="col">street_address</th>
                            <th scope="col">{{ trans('main_trans.phone') }}</th>
                            <th scope="col">device_type</th>
                            <th scope="col">type_of_malfunction</th>
                            <th scope="col">technical</th>
                            <th scope="col">expected_service_date</th>
                            <th scope="col">company_status</th>
                            <th scope="col">technical_status</th>
                            <th scope="col">{{ trans('main_trans.edit_status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maintenanceResources as $maintenance)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>

                            <td>{{ $maintenance->code }}</td>
                            <td>{{ $maintenance->address }}</td>
                            <td>{{ $maintenance->street_address }}</td>
                            <td>{{ $maintenance->phone_number }}</td>
                            <td>{{ $maintenance->device_type }}</td>
                            <td>{{ $maintenance->type_of_malfunction }}</td>
                            <td>{{ $maintenance->technical }}</td>
                            <td>{{ $maintenance->expected_service_date }}</td>

                            <td>
                                <span class="text-success" style="font-size: 20px">{{ $maintenance->company_status}}</span>
                               </td>
                               <td>
                                <span class="text-success" style="font-size: 20px">{{ $maintenance->technical_status}}</span>
                               </td>




                            <td>
                                <a href="#editModal{{ $maintenance->id }}" class="btn btn-primary"
                                    data-toggle="modal">{{ trans('main_trans.edit') }}</a>

    {{-- <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{ $maintenance->id }}')">{{ trans('main_trans.delete') }}</a> --}}
</td>
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
@foreach ($maintenanceResources as $maintenance)
<div class="modal fade" id="editModal{{ $maintenance->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $maintenance->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $maintenance->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company_maintenance.update', $maintenance->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="status">company_status</label>
                        <select class="form-select" aria-label="Default select example" name="company_status">
                            <option value="pending">pending</option>
                            <option value="confirmed">confirmed</option>
                            <option value="cancelled">cancelled</option>
                        </select>
                    </div>

                    {{-- <div class="form-group">
                        <label for="role">technical</label>
                        <select class="form-select" aria-label="Default select example" name="technical">
                            <option selected>{{ trans('main_trans.open_menu') }}</option>
                            @foreach ($technicals as $technical)
                            <option value="{{ $technical->id }}">{{ $technical->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label> expected_service_date</label>
                        <input class="form-control fc-datepicker" name="expected_service_date" placeholder="YYYY-MM-DD"
                            type="text" required>
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

<div class="modal fade" id="deleteModal{{ $maintenance->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel{{ $maintenance->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $maintenance->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('maintenance.delete' ,$maintenance->id) }}" method="POST" >
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

@endsection
