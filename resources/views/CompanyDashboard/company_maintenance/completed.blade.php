@extends('CompanyDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
.status {
    font-size: 20px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
    display: inline-block;
}

.status-pending {
    background-color: #ffc107;
    color: #fffefe;
}

.status-cancelled {
    background-color: #ff4d4d;
    color: #fff;
}

.status-confirmed {
    background-color: #28a745;
    color: #fff;
}

.status-out-to-service {
    background-color: #17a2b8; /* Info blue */
    color: #fff;
}

.status-completed {
    background-color: #28a745; /* Success green */
    color: #fff;
}

.status-icon {
    margin-right: 5px;
}

/* Hide horizontal scrollbar */
.container {
    overflow-x: hidden;
}

.blue-button {
    background-color: #94deec; /* لتغيير لون الخلفية إلى الأزرق */
    color: rgb(19, 18, 18); /* لتغيير لون النص إلى الأبيض */
    border: none; /* لإزالة الحدود */
    padding: 10px 20px; /* يمكنك تعديل حجم الوسادة */
    border-radius: 5px; /* يمكنك تعديل نصف القطر للإطار */
    cursor: pointer; /* لإظهار مؤشر اليد */
}

/* Customize the table's border color and row colors */
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
{{ trans('main_trans.complete_maintenance') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.complete_maintenance') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard') }}</a></li>
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
            <div class="row mb-3"> <!-- إضافة مسافة تحتية للعنصر -->
                <div class="col-md-6"> <!-- استخدام العمود لتحديد عرض العنصر -->
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th scope="col">{{ trans('main_trans.code') }}</th>
                        <th scope="col">{{ trans('main_trans.address') }}</th>
                        <th scope="col">{{ trans('main_trans.street_address') }}</th>
                        <th scope="col">{{ trans('main_trans.phone') }}</th>
                        <th scope="col">{{ trans('main_trans.device_type') }}</th>
                        <th scope="col">{{ trans('main_trans.type_of_malfunction') }}</th>
                        <th scope="col">{{ trans('main_trans.technical') }}</th>
                        <th scope="col">{{ trans('main_trans.expected_service_date') }}</th>
                        <th scope="col">{{ trans('main_trans.company_status') }}</th>
                        <th scope="col">{{ trans('main_trans.technical_status') }}</th>
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
                                    $name = App\Models\Technician::find($maintenance->technical_id);
                                @endphp
                                {{ $name ? $name->name : trans('main_trans.dont_have') }}
                            @else
                                {{ trans('main_trans.dont_have') }}
                            @endif
                        </td>
                        <td>{{ $maintenance->expected_service_date }}</td>
                        <td>
                            @if ($maintenance->company_status == 'pending')
                            <span class="status status-pending">
                                <i class="status-icon fas fa-clock"></i>
                                Pending
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
                            @elseif ($maintenance->technical_status == 'confirmed')
                            <span class="status status-confirmed">
                                <i class="status-icon fas fa-check-circle"></i>
                                Confirmed
                            </span>
                            @elseif ($maintenance->technical_status == 'out to service')
                            <span class="status status-out-to-service">
                                <i class="status-icon fas fa-wrench"></i>
                                Out to Service
                            </span>
                            @elseif ($maintenance->technical_status == 'completed')
                            <span class="status status-completed">
                                <i class="status-icon fas fa-check-circle"></i>
                                Completed
                            </span>
                            @endif
                        </td>
                        <td>
                            <a href="#editModal{{ $maintenance->id }}" data-toggle="modal">
                                <i class="fas fa-pen-to-square fa-2xl"></i>
                            </a>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $maintenance->id }}">
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
<!-- row closed -->

<!-- Edit User Modals -->
@foreach ($maintenanceResources as $maintenance)
<div class="modal fade" id="editModal{{ $maintenance->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $maintenance->id }}" aria-hidden="true">
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
                        <select class="form-select" name="company_status">
                            <option value="pending" {{ $maintenance->company_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="cancelled" {{ $maintenance->company_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="confirmed" {{ $maintenance->company_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h5><label for="status">{{ trans('main_trans.technical_status') }}</label></h5>
                        <select class="form-select" name="technical_status">
                            <option value="pending" {{ $maintenance->technical_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $maintenance->technical_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="out to service" {{ $maintenance->technical_status == 'out to service' ? 'selected' : '' }}>Out to Service</option>
                            <option value="completed" {{ $maintenance->technical_status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h5><label> {{ trans('main_trans.expected_service_date')}}:</label></h5>
                        <input class="form-control fc-datepicker" name="expected_service_date" placeholder="YYYY-MM-DD"
                            type="text">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Delete Modal -->
@foreach ($maintenanceResources as $maintenance)
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('main_trans.delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
