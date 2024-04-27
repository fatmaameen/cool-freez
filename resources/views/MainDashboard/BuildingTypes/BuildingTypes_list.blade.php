@extends('MainDashboard.layouts.master')

@section('css')
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
{{ trans('main_trans.buildingTypes') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.buildingTypes') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_trans.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.buildingTypes') }}</li>
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
                        <button type="button" class="blue-button" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            <i class="fa-solid fa-plus"></i> {{ trans('main_trans.create') }}
                        </button>
                    </div>
                </div>


                <table class="table table-bordered  w-100">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>

                            <th scope="col">{{ trans('main_trans.user_name') }}</th>
                            <th scope="col">{{ trans('main_trans.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($BuildingTypes as $buildingtype)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $buildingtype->name }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="#"  data-toggle="modal" data-target="#editModal{{ $buildingtype->id }}">
                                        <i class="fas fa-pen-to-square fa-2xl" ></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $buildingtype->id }}">
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
    </div>
</div>
<!-- row closed -->

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.create') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('buildingTypes.store') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ trans('main_trans.user_name') }}</label>
                        <input type="text" class="form-control" id="name" name="name">
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
</div>
<!-- Create User Modal -->
@foreach ($BuildingTypes as $buildingtype)
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{ $buildingtype->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $buildingtype->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $buildingtype->id }}">{{ trans('main_trans.edit') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('buildingTypes.update', $buildingtype->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('main_trans.user_name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $buildingtype->name }}">
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

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $buildingtype->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $buildingtype->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $buildingtype->id }}"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>{{ trans('main_trans.delete_text') }}</h5>
                    <form action="{{ route('buildingTypes.delete', $buildingtype->id) }}" method="POST">
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
@endsection

