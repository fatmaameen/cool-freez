
@extends('MainDashboard.layouts.master')

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
{{ trans('main_trans.cfmRates') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.cfmRates') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.cfmRates') }}</li>
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


                <table class="table table-bordered  w-100">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th scope="col">  {{ trans('main_trans.poor_from') }}</th>
                            <th scope="col">  {{ trans('main_trans.poor_to') }}</th>
                            <th scope="col">  {{ trans('main_trans.good_from') }}</th>
                            <th scope="col">  {{ trans('main_trans.good_to') }}</th>
                            <th scope="col">  {{ trans('main_trans.excellent_from') }}</th>
                            <th scope="col">  {{ trans('main_trans.excellent_to') }}</th>
                            <th scope="col">{{ trans('main_trans.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $details)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>



                            <td>{{ $details->poor_from }}</td>
                            <td>{{ $details->poor_to }}</td>
                            <td>{{ $details->good_from }}</td>
                            <td>{{ $details->good_to }}</td>
                            <td>{{ $details->excellent_from }}</td>
                            <td>{{ $details->excellent_to }}</td>
                            <td>
                                <a href="#editModal{{ $details->id }}"
                                    data-toggle="modal">  <i class="fas fa-pen-to-square fa-2xl" ></i></a>
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



<!-- Edit User Modals -->
@foreach ($data as $details)
<div class="modal fade" id="editModal{{ $details->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $details->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $details->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cfmRates.update', $details->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="poor_from">{{ trans('main_trans.poor_from') }}</label>
                        <input type="text" class="form-control" id="poor_from" name="poor_from" value="{{ $details->poor_from }}">
                    </div>

                    <div class="form-group">
                        <label for="poor_to">{{ trans('main_trans.poor_to') }}</label>
                        <input type="text" class="form-control" id="poor_to" name="poor_to" value="{{ $details->poor_to }}">
                    </div>
                    <div class="form-group">
                        <label for="good_from">{{ trans('main_trans.good_from') }}</label>
                        <input type="text" class="form-control" id="good_from" name="good_from" value="{{ $details->good_from }}">
                    </div>
                    <div class="form-group">
                        <label for="good_to">{{ trans('main_trans.good_to') }}</label>
                        <input type="text" class="form-control" id="good_to" name="good_to" value="{{ $details->good_to }}">
                    </div>
                    <div class="form-group">
                        <label for="excellent_from">{{ trans('main_trans.excellent_from') }}</label>
                        <input type="text" class="form-control" id="excellent_from" name="excellent_from" value="{{ $details->excellent_from }}">
                    </div>
                    <div class="form-group">
                        <label for="excellent_to">{{ trans('main_trans.excellent_to') }}</label>
                        <input type="text" class="form-control" id="excellent_to" name="excellent_to" value="{{ $details->excellent_to }}">
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
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+YE5O9wSFj/zIy4GfDMVNA/GpGFF93hXpG5KkN+" crossorigin="anonymous"></script>

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
