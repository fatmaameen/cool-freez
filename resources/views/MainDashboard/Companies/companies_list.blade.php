
@extends('MainDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>/* Customize the table's border color and row colors */
    .table-bordered {
        border-color: #ADD8E6; /* Light blue */
    }
    body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
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
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection

@section('title')
{{ trans('main_trans.companies') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.companies') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.companies') }}</li>
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
                <br><br>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button type="button" class="blue-button" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fa-solid fa-plus"></i>  {{ trans('main_trans.create') }}
                        </button>
                    </div>
                </div>
                <table class="table table-bordered  w-100">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th scope="col">  {{ trans('main_trans.company_name') }}</th>
                            <th scope="col">  {{ trans('main_trans.phone') }}</th>
                            <th scope="col">  {{ trans('main_trans.address') }}</th>
                            <th scope="col">{{ trans('main_trans.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filteredData as $company)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $company['name'] }}</td>
                            <td>{{ $company['phone'] }}</td>
                            <td>{{ $company['address'] }}</td>
                            <td>
                                <a href="#editModal{{ $company['id'] }}"
                                    data-toggle="modal"> <i class="fas fa-pen-to-square fa-2xl" ></i></a>
                             <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{ $company['id'] }}')">     <i class="fa-solid fa-trash-can"></i></a>
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

<!-- Create brand Modal -->
<div class="modal fade" id="createModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">  {{ trans('main_trans.create') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name_en">{{ trans('main_trans.en_name') }}</label>
                        <input type="text" class="form-control" name="name_en">
                    </div>
                    <div class="form-group">
                        <label for="name_ar">{{ trans('main_trans.ar_name') }}</label>
                        <input type="text" class="form-control" name="name_ar">
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ trans('main_trans.phone') }}</label>
                        <input type="number" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="address">{{ trans('main_trans.address') }}</label>
                        <input type="text" class="form-control" name="address">
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
@foreach ($filteredData as $company)
<div class="modal fade" id="editModal{{ $company['id'] }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $company['id'] }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $company['id'] }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('companies.update', $company['id']) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name_en">{{ trans('main_trans.en_name') }}</label>
                        <input type="text" class="form-control" name="name_en"  value="{{ $company['name_en'] }}">
                    </div>
                    <div class="form-group">
                        <label for="name_ar">{{ trans('main_trans.ar_name') }}</label>
                        <input type="text" class="form-control" name="name_ar"  value="{{ $company['name_ar'] }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ trans('main_trans.phone') }}</label>
                        <input type="number" class="form-control" name="phone"  value="{{ $company['phone'] }}">
                    </div>
                    <div class="form-group">
                        <label for="address">{{ trans('main_trans.address') }}</label>
                        <input type="text" class="form-control" name="address" value="{{ $company['address'] }}">
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

<div class="modal fade" id="deleteModal{{ $company['id'] }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel{{ $company['id'] }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $company['id'] }}"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('companies.destroy' ,$company['id']) }}" method="POST" >
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
@endforeach
@endsection
<!-- Edit User Modals -->
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>


<script>

    function openDeleteModal(maintenanceId) {
        var deleteModalId = '#deleteModal' + maintenanceId;
        $(deleteModalId).modal('show');
    }
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
            toastr.error(message);
            var audio = new Audio('audio.mp3');
            audio.play();
            break;
    }
@endif

</script>
@endsection
