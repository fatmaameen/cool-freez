@extends('MainDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
{{ trans('main_trans.customer_service') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.customer_service') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.customer_service') }}</li>
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
{{--
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                <br><br>

                {{-- <div class="row mb-3"> <!-- إضافة مسافة تحتية للعنصر -->
                    <div class="col-md-6"> <!-- استخدام العمود لتحديد عرض العنصر -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            {{ trans('main_trans.create') }}
                        </button>
                    </div>
                </div> --}}
                @if (count($messages)>0)
                <table class="table table-bordered  w-100">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>

                            <th scope="col">{{ trans('main_trans.user_name') }}</th>
                            <th scope="col">{{ trans('main_trans.email') }}</th>
                            <th scope="col">{{ trans('main_trans.phone') }}</th>
                            <th scope="col">{{ trans('main_trans.description') }}</th>
                            <th scope="col">{{ trans('main_trans.status') }}</th>

                            <th scope="col">{{ trans('main_trans.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->phone_number }}</td>
                                <td>{{ $message->description }}</td>
                                    <td>{{ $message->status }}</td>
                                    <td>
                                        <a href="#editModal{{ $message->id }}" data-toggle="modal">
                                            <i class="fas fa-pen-to-square fa-2xl" ></i>
                                        </a>

                                    <!-- Delete Button -->
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $message->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#replyyModal{{ $message->id }}">
                                        <i class="fa-regular fa-paper-plane"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h3>{{ trans('main_trans.no_messages') }}</h3>
                @endif
            </div>
        </div></div>
    </div>
    </div>
</div>
<!-- row closed -->

<!-- Create User Modal -->
{{-- <div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.create') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('floors.store') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="floor_number">{{ trans('main_trans.floor_number') }}</label>
                        <input type="text" class="form-control" id="floor_number" name="floor_number">
                    </div>
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
</div> --}}
 <!-- Create User Modal -->
 @foreach ($messages as $massage)
<div class="modal fade" id="editModal{{ $massage->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $massage->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $massage->id }}">{{ trans('main_trans.edit') }}</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer_service.update', $massage->id) }}" method="POST">
                    @csrf
<style>
                    .form-select {
                        width: 100%; /* يجعل العرض 100% من حجم الحاوية */
                        font-size: 16px; /* لتكبير حجم النص داخل العنصر */
                    }
</style>
                            <div class="form-group">
                               <h5> <label for="status">{{ trans('main_trans.edit_status') }}....</label></h5>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="Not Replied Yet">Not Replied Yet</option>
                                    <option value="Replied">Replied</option>

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
        <div class="modal fade" id="replyyModal{{ $massage->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="replyyModalLabel{{ $massage->id }}"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="replyyModalLabel{{ $massage->id }}">{{ trans('main_trans.send_reply') }}....</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">



                            <form action="{{ route('customer_sevices.sendemail' ,$massage->id) }}" method="POST" >
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ trans('main_trans.email') }}</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $massage->email }}" >
                                </div>
                                <div class="form-group">
                                    <label for="subject">{{ trans('main_trans.subject') }}</label>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                </div>
                                <div class="form-group">
                                    <label for="title">{{ trans('main_trans.title') }}</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="message">{{ trans('main_trans.massage') }}</label>
                                    <input type="text" class="form-control" id="message" name="message">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ trans('main_trans.send') }}</button>
                                </div>
                            </form>






                            </div>
                        </div>
                    </div>
                </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $massage->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $massage->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $massage->id }}"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>{{ trans('main_trans.delete_text') }}</h5>
                    <form action="{{ route('customer_sevices.delete', $massage->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
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

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
@if (count($messages)>0)
$('#replyyModal{{ $massage->id }}').on('hidden.bs.modal', function () {
    console.log('Modal is closed');
});
@endif
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

