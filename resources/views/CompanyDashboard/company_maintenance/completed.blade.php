@extends('CompanyDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .blue-button {
        background-color: #94deec; /* لتغيير لون الخلفية إلى الأزرق */
        color: rgb(19, 18, 18); /* لتغيير لون النص إلى الأبيض */
        border: none; /* لإزالة الحدود */
        padding: 10px 20px; /* يمكنك تعديل حجم الوسادة */
        border-radius: 5px; /* يمكنك تعديل نصف القطر للإطار */
        cursor: pointer; /* لإظهار مؤشر اليد */
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection


@section('title')
{{ trans('main_trans.complete_maintenance') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.complete_maintenance') }} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.complete_maintenance') }}</li>
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

                {{-- @if ($errors->any())
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


                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">{{ trans('main_trans.code') }} </th>
                            <th scope="col">{{ trans('main_trans.address') }}</th>
                            <th scope="col">{{ trans('main_trans.street_address') }}</th>
                            <th scope="col">{{ trans('main_trans.phone') }}</th>
                            <th scope="col">{{ trans('main_trans.device_type') }}</th>
                            <th scope="col">{{ trans('main_trans.type_of_malfunction')}}</th>
                            <th scope="col">{{ trans('main_trans.technical')}}</th>

                            <th scope="col">{{ trans('main_trans.expected_service_date')}}</th>
                            <th scope="col">{{ trans('main_trans.company_status')}}</th>
                            <th scope="col"> {{ trans('main_trans.technical_status')}}</th>
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
                            <td>
                                @if($maintenance->technical_id)
                                    @php
                                        $name=App\Models\technician::where('id' ,$maintenance->technical_id)->first();
                                    @endphp
                                    {{ $name->name }}
                                @else
                                    {{ trans('main_trans.dont_have') }}
                                @endif
                            </td>
                            <td>{{ $maintenance->expected_service_date }}</td>

                            <td>
                                <span class="text-success" style="font-size: 20px">{{ $maintenance->company_status}}</span>
                               </td>
                               <td>
                                <span class="text-success" style="font-size: 20px">{{ $maintenance->technical_status}}</span>
                               </td>




                            <td>
                                <a href="#editModal{{ $maintenance->id }}"
                                     data-toggle="modal"> <i class="fas fa-pen-to-square fa-2xl" ></i></a>

                                    <!-- Delete Button -->
 <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{  $maintenance->id}}">
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
                    <style>
                        .form-select {
                            width: 100%; /* يجعل العرض 100% من حجم الحاوية */
                            font-size: 16px; /* لتكبير حجم النص داخل العنصر */
                        }
                    </style>
                    <div class="form-group">
                        <h5><label for="status">{{ trans('main_trans.company_status') }}</label></h5>
                        <select class="form-select" aria-label="Default select example" name="company_status">
                            <option value="pending">pending</option>
                            <option value="confirmed">confirmed</option>
                            <option value="cancelled">cancelled</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <h5><label for="role">{{ trans('main_trans.technical') }}:</label></h5>
                        <select class="form-select" aria-label="Default select example" name="technical">
                            @php
                            $technicals = App\Models\technician::all();
                            @endphp
                            @foreach ($technicals as $technical)
                                <option value="{{ $technical->id }}">{{ $technical->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>  <th scope="col">{{ trans('main_trans.expected_service_date')}}</th></label>
                        <input class="form-control fc-datepicker" name="expected_service_date" placeholder="YYYY-MM-DD"
                            type="text">
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $maintenance->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $maintenance->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('maintenance.delete', $maintenance->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <p>{{ trans('main_trans.delete_text') }}</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ trans('main_trans.close') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ trans('main_trans.delete') }}
                        </button>
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
