@extends('MainDashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .circular-link {
            display: inline-block;
            width: 40px;
            /* يمكنك ضبط العرض حسب رغبتك */
            height: 40px;
            /* يمكنك ضبط الارتفاع حسب رغبتك */
            line-height: 40px;
            /* يجعل النص والأيقونة في منتصف العنصر */
            border-radius: 50%;
            /* يجعل العنصر دائري الشكل */
            background-color: lightblue;
            /* لون الخلفية اللبني */
            color: rgb(17, 17, 17);
            /* لون النص والأيقونة */
            text-align: center;
            /* محاذاة النص والأيقونة في الوسط */
            text-decoration: none;
            /* لإزالة أي خطوط تحتية من الرابط */
        }

        .button-container {
            text-align: center;
            /* لمحاذاة العنصر إلى اليمين داخل العنصر */
        }



        /* إضافة تأثير التحويم (hover) لتحسين التصميم */
        .circular-link {
            margin-right: 40px;
            /* تضيف مساحة على اليمين */
        }
    </style>


    <style>
        .blue-button {
            background-color: #94deec;
            /* لتغيير لون الخلفية إلى الأزرق */
            color: rgb(19, 18, 18);
            /* لتغيير لون النص إلى الأبيض */
            border: none;
            /* لإزالة الحدود */
            padding: 10px 20px;
            /* يمكنك تعديل حجم الوسادة */
            border-radius: 5px;
            /* يمكنك تعديل نصف القطر للإطار */
            cursor: pointer;
            /* لإظهار مؤشر اليد */
        }
    </style>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <style>
        /* Customize the table's border color and row colors */
        .table-bordered {
            border-color: #ADD8E6;
            /* Light blue */
        }

        .table-bordered th,
        .table-bordered td {
            border-color: #ADD8E6;
            /* Light blue */
        }

        /* Customize the header background color */
        thead.bg-light {
            background-color: #E0F7FA;
            /* Light cyan */
        }

        #search-btn {
            background-color: #fff;
            color: #91c5d0;
            margin-right: 3px !important;
            transition: 0.3s ease-in-out;
            border: 1px solid #91c5d0;
        }

        #search-btn:hover {
            background-color: #91c5d0;
            color: #fff;
        }

        #reset-btn {
            background-color: #fff;
            color: #a82626;
            transition: 0.3s ease-in-out;
            border: 1px solid #a82626;
        }

        #reset-btn:hover {
            background-color: #a82626;
            color: #fff;
        }

        #searchInput {
            padding: 13px !important;
            margin-right: 3px !important;
            margin-left: 3px !important;
        }

        .col-md-6 {
            display: flex !important;
            flex-direction: row !important;
        }
    </style>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endsection

@section('title')
    {{ trans('main_trans.loadCalculation') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.loadCalculation') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                            class="default-color">{{ trans('main_trans.Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('main_trans.loadCalculation') }}</li>
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
                        <div class="row d-flex justify-content-center align-items-center ">
                            <div class="col-xm-10 col-sm-5 col-md-6">
                                <input type="text" class="form-control p-3" id="searchInput"
                                    placeholder="Search by code...">
                                <button id="search-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="searchOnKeyUp()"
                                    type="submit">Search</button>
                                <button id="reset-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="allData()"
                                    type="reset">Reset</button>
                            </div>
                        </div>
                        @if (session('message'))
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




                        <table class="table table-bordered  w-100" id="loadsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.details') }}</th>
                                    <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                                    <th scope="col">{{ trans('main_trans.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loads as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->code }}</td>

                                        <td class="button-container">
                                            <a href="{{ route('loadCalculation.show', $data->id) }}" class="circular-link">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>{{ $data->admin_status }}</td>
                                        <!-- Edit Button -->
                                        <td> <a href="#" data-toggle="modal"
                                                data-target="#editModal{{ $data->id }}">
                                                <i class="fas fa-pen-to-square fa-2xl"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $data->id }}">
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
    {{-- <div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.upload') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <h5 class="text-white bg-danger p-2">{{ trans('main_trans.text') }}</h5>


            <div class="modal-body">
                <form action="{{ route('usingFloors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">{{ trans('main_trans.file') }}</label>
                        <input type="file" class="form-control" id="file" name="file">
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

    @foreach ($loads as $data)
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $data->id }}">{{ trans('main_trans.edit') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('loadCalculation.update', $data->id) }}" method="POST">
                            @csrf

                            <style>
                                .form-select {
                                    width: 100%;
                                    /* يجعل العرض 100% من حجم الحاوية */
                                    font-size: 16px;
                                    /* لتكبير حجم النص داخل العنصر */
                                }
                            </style>
                            <div class="form-group">
                                <h5> <label for="status">{{ trans('main_trans.admin_status') }}</label></h5>
                                <select class="form-select" aria-label="Default select example" name="admin_status">
                                    <option value="waiting">waiting</option>
                                    <option value="confirmed">confirmed</option>
                                    <option value="cancelled">cancelled</option>
                                </select>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                                <button type="submit" class="btn btn-primary">{{ trans('main_trans.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>{{ trans('main_trans.delete_text') }}</h5>
                        <form action="{{ route('loadCalculation.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('main_trans.close') }}</button>
                                <button type="submit" class="btn btn-danger">{{ trans('main_trans.delete') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        function searchOnKeyUp() {
            var input = document.getElementById("searchInput");
            var searchText = input.value.trim();
            if (searchText != '') {
                fetch('/main-dashboard/loadCalculation/search/' + searchText)
                    .then(response => response.json())
                    .then(data => {
                        updateTable(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function allData() {
            var input = document.getElementById("searchInput");
            if (input.value != '') {
                input.value = '';
                fetch('/main-dashboard/loadCalculation/search/null')
                    .then(response => response.json())
                    .then(data => {
                        updateTable(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }

        function updateTable(data) {
            var table = document.getElementById("loadsTable");
            var tbody = table.getElementsByTagName('tbody')[0];
            tbody.innerHTML = '';
            data.forEach(function(data, index) {
                var row = tbody.insertRow();
                row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${data.code}</td>
                            <td class="button-container">
                                <a href="/main-dashboard/loadCalculation/${data.id}" class="circular-link">
                                <i class="fa-solid fa-eye"></i>
                            </a></td>
                            <td>${data.admin_status}</td>
                            <td> <a href="#"  data-toggle="modal" data-target="#editModal${data.id}">
                            <i class="fas fa-pen-to-square fa-2xl" ></i>
                            </a>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal${data.id}">
                            <i class="fa-solid fa-trash-can"></i>
                            </a>
                            </td>
                        `;
            });
        }
    </script>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
