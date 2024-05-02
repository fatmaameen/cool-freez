@extends('MainDashboard.layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
    .form-select {
        width: 100%; /* يجعل العرض 100% من حجم الحاوية */
        font-size: 16px; /* لتكبير حجم النص داخل العنصر */
    }
</style>

       <style>/* Customize the table's border color and row colors */
            .table-bordered {
                border-color: #ADD8E6; /* Light blue */
            }

            .table-bordered th,
            .table-bordered td {
                border-color: #ADD8E6; /* Light blue */
            }

            /* Customize the header background color */
            thead.bg-light {
                background-color: #E0F7FA; /* Light cyan */
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
    <div class="container-fluid">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
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

                        </div>
                    </div>


                    <table class="table table-bordered  ">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>

                                <th scope="col">{{ trans('main_trans.code') }}</th>
                                <th scope="col">{{ trans('main_trans.address') }}</th>
                                <th scope="col">{{ trans('main_trans.street_address') }}</th>
                                <th scope="col">{{ trans('main_trans.phone') }}</th>
                                <th scope="col">{{ trans('main_trans.device_type') }}</th>
                                <th scope="col">{{ trans('main_trans.type_of_malfunction')}}</th>
                                <th scope="col">{{ trans('main_trans.admin_status')}}</th>

                                <th scope="col">{{ trans('main_trans.assigned')}}</th>
                                <th scope="col">{{ trans('main_trans.technical')}}</th>

                            <th scope="col">{{ trans('main_trans.company_status')}}</th>
                            <th scope="col"> {{ trans('main_trans.technical_status')}}</th>
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
                                    <td>
                                        {{ $maintenance->assigned }}</td>

                                      @php
    // جلب الفني باستخدام المعرف
    $technical = App\Models\Technician::find($maintenance->technical);
@endphp

<td>
    @if ($technical)
        {{ $technical->name }}
    @else
        No found
    @endif
</td>
                                    <td>
                                        <span class="text-success"
                                            style="font-size: 20px">{{ $maintenance->company_status }}</span>
                                    </td>
                                    <td>
                                        <span class="text-success"
                                            style="font-size: 20px">{{ $maintenance->technical_status }}</span>
                                    </td>




                                    <td>
                                        <a href="#editModal{{ $maintenance->id }}"
                                            data-toggle="modal"><i class="fas fa-pen-to-square fa-2xl" ></i></a>

                                        <a href="#" class="btn btn-danger"
                                            onclick="openDeleteModal('{{ $maintenance->id }}')"><i class="fa-solid fa-trash-can"></i></a>
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
@foreach ($maintenances as $maintenance)
<div class="modal fade" id="editModal{{ $maintenance->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $maintenance->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $maintenance->id }}">{{ trans('main_trans.edit') }}......</h5>
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
