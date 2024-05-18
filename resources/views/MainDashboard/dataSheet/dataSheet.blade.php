@extends('MainDashboard.layouts.master')

@section('css')
    <!-- Link to Font Awesome and Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom styles -->
    <style>
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
        body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
}
        /* Button styles */
        .blue-button {
            background-color: #94deec; /* Light blue */
            color: #131212; /* Dark color for text */
            border: none; /* Remove borders */
            padding: 10px 20px; /* Adjust padding */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor */
        }
    </style>
@endsection

@section('title')
    {{ trans('main_trans.dataSheet') }}
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.dataSheet') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
               <h6><li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                        class="default-color">{{ trans('main_trans.Dashboard') }}</a></li></h6>
            <h6><li class="breadcrumb-item active">/{{ trans('main_trans.dataSheet') }}</li></h6>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        <div class="container-fluid">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">


                        <form action="{{ route('dataSheet.search') }}" method="POST" class="mb-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="search" class="form-control search-bar" placeholder="{{ trans('main_trans.search') }}..." value="{{ $currentSearch ?? '' }}">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i> <!-- أيقونة البحث -->
                                </button>
                            </div>
                        </form>




                        <!-- Upload button and modal trigger -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <button type="button" class="blue-button" data-bs-toggle="modal" data-bs-target="#createDataSheetModal">
                                    <i class="fa-solid fa-plus"></i> {{ trans('main_trans.upload') }}
                                </button>
                                <a href="{{ route('dataSheet.download') }}" type="button" class="blue-button">
                                    <i class="fa-solid fa-plus"></i> {{ trans('main_trans.download') }}
                                </a>
                            </div>
                        </div>






                        <!-- Data sheet table -->
                        <table class="table table-bordered w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('main_trans.brand') }}</th>
                                    <th>{{ trans('main_trans.type') }}</th>
                                    <th>{{ trans('main_trans.model') }}</th>
                                    <th>{{ trans('main_trans.btu') }}</th>
                                    <th>{{ trans('main_trans.cfm') }}</th>
                                    <th>{{ trans('main_trans.gas') }}</th>
                                    <th>{{ trans('main_trans.made_in') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataSheet as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->brand }}</td>
                                        <td>{{ $data->type }}</td>
                                        <td>{{ $data->model }}</td>
                                        <td>{{ $data->btu }}</td>
                                        <td>{{ $data->cfm }}</td>
                                        <td>{{ $data->gas }}</td>
                                        <td>{{ $data->made_in }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        {{-- <div class="pagination">
                            {{ $dataSheet->links() }}
                        </div> --}}
                        <div class="d-flex justify-content-center">
                            {{ $dataSheet->links('pagination::bootstrap-4') }}
                        </div>
                        <style>
                            .pagination .page-item.active .page-link {
    background: #94deec !important;
    border-color: #94deec !important;
    color: #ffffff;
}
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for uploading data sheets -->
    <div class="modal fade" id="createDataSheetModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createDataSheetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDataSheetModalLabel">{{ trans('main_trans.upload') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h5 class="text-white bg-danger p-2">{{ trans('main_trans.text') }}</h5>
                <!-- Form for file upload -->
                <div class="modal-body">
                    <form action="{{ route('dataSheet.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">{{ trans('main_trans.file') }}</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('main_trans.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
