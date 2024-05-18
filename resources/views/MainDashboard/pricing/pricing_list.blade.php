@extends('MainDashboard.layouts.master')

@section('css')
<style>
    .status {
        font-size: 20px;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .status-waiting {
        background-color: #ffc107; /* لون أصفر فاتح */
        color: #fffefe; /* نص أسود لتباين جيد */
    }

    .status-cancelled {
        background-color: #ff4d4d; /* لون أحمر فاتح */
        color: #fff; /* نص أبيض لتباين جيد */
    }

    .status-confirmed {
        background-color: #28a745; /* لون أخضر فاتح */
        color: #fff; /* نص أبيض لتباين جيد */
    }

    .status-icon {
        margin-right: 5px;
    }
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>.circular-link {
    display: inline-block;
    width: 40px; /* يمكنك ضبط العرض حسب رغبتك */
    height: 40px; /* يمكنك ضبط الارتفاع حسب رغبتك */
    line-height: 40px; /* يجعل النص والأيقونة في منتصف العنصر */
    border-radius: 50%; /* يجعل العنصر دائري الشكل */
    background-color: lightblue; /* لون الخلفية اللبني */
    color: rgb(17, 17, 17); /* لون النص والأيقونة */
    text-align: center; /* محاذاة النص والأيقونة في الوسط */
    text-decoration: none; /* لإزالة أي خطوط تحتية من الرابط */
}
.button-container {
    text-align: center; /* لمحاذاة العنصر إلى اليمين داخل العنصر */
}



/* إضافة تأثير التحويم (hover) لتحسين التصميم */
.circular-link {
    margin-right: 40px; /* تضيف مساحة على اليمين */
}


</style>
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
<style>/* Customize the table's border color and row colors */
    .table-bordered {
        border-color: #ADD8E6; /* Light blue */
    }

    .table-bordered th,
    .table-bordered td {
        border-color: #ADD8E6; /* Light blue */
    }
    body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
}
    /* Customize the header background color */
    thead.bg-light {
        background-color: #E0F7FA; /* Light cyan */
    }
    </style>
@endsection

@section('title')
{{ trans('main_trans.pricing') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.pricing') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
               <h6><li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                        class="default-color">{{ trans('main_trans.Dashboard') }}</a></li></h6>
            <h6><li class="breadcrumb-item active">/{{ trans('main_trans.pricing') }}</li></h6>
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
                            placeholder="{{ trans('main_trans.search_code') }}...">
                        <button id="search-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="searchOnKeyUp()"
                            type="submit">{{ trans('main_trans.search') }}</button>
                        <button id="reset-btn" class="btn pr-4 pl-4 pt-2 pb-2" onclick="allData()"
                            type="reset">{{ trans('main_trans.reset') }}</button>
                    </div>
                </div>


                <div class="row mb-3"> <!-- إضافة مسافة تحتية للعنصر -->
                    <div class="col-md-6"> <!-- استخدام العمود لتحديد عرض العنصر -->

                    </div>
                </div>


                <table class="table table-bordered  w-100" id="pricingtable">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>

                            <th scope="col">{{ trans('main_trans.code') }}</th>
                            <th scope="col">{{ trans('main_trans.pricing_details') }}</th>
                            <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                            <th scope="col">{{ trans('main_trans.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricing as $one)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>

                            <td>{{ $one->code }}</td>

                            <td class="button-container">
                                <a href="{{ route('pricing.show', $one->id) }}" class="circular-link">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>





                            {{-- <td>
                                <a href="#consModal{{ $review->id }}" class="btn btn-primary" data-toggle="modal">{{ trans('main_trans.show') }}</a>
                            </td>
                            <td>
                                @php
                                $files = json_decode($review->building_files, true);
                                @endphp
                                @foreach ($files as $file)
                                <a href="{{'http://127.0.0.1:8000/reviews_files/'.$file}}" class="btn btn-primary" target="_blank">{{ trans('main_trans.show') }}</a>
                                @endforeach

                                {{-- <a href="{{'http://127.0.0.1:8000/reviews_files/'. json_decode($review->building_files, true)}}" class="btn btn-primary">{{ trans('main_trans.show') }}</a> --}}
                            {{-- </td> --}}

                            <td>
                                @if ($one->admin_status == 'waiting')
                                    <span class="status status-waiting">
                                        <i class="status-icon fas fa-clock"></i>
                                        Waiting
                                    </span>
                                @elseif ($one->admin_status == 'cancelled')
                                    <span class="status status-cancelled">
                                        <i class="status-icon fas fa-times-circle"></i>
                                        Cancelled
                                    </span>
                                @elseif ($one->admin_status == 'confirmed')
                                    <span class="status status-confirmed">
                                        <i class="status-icon fas fa-check-circle"></i>
                                        Confirmed
                                    </span>
        @endif
                            </td>
                            <td>
                            <a href="#editModal{{ $one->id }}"
                                data-toggle="modal">  <i class="fas fa-pen-to-square fa-2xl" ></i></a>


                       <a href="#" class="btn btn-danger"
                       onclick="openDeleteModal('{{ $one->id }}')">   <i class="fa-solid fa-trash-can"></i></a>
<td>




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

<!-- Create User Modal -->
@foreach ($pricing as $one )



<!-- Edit User Modals -->
<div class="modal fade" id="editModal{{ $one->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $one->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $one->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pricing.update', $one->id) }}" method="POST">
                    @csrf

                    <style>
                        .form-select {
                            width: 100%; /* يجعل العرض 100% من حجم الحاوية */
                            font-size: 16px; /* لتكبير حجم النص داخل العنصر */
                        }
                    </style>
                            <div class="form-group">
                               <h6> <label for="status">{{ trans('main_trans.admin_status') }}</label></h6>
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
        <div class="modal fade" id="deleteModal{{ $one->id }}" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $one->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $one->id }}">
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pricing.destroy', $one->id) }}" method="POST">
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
        <script>
            function searchOnKeyUp() {
                var input = document.getElementById("searchInput");
                var searchText = input.value.trim();
                if (searchText != '') {
                    fetch('/main-dashboard/pricing/search/' + searchText)
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
                    fetch('/main-dashboard/pricing/search/null')
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
                var table = document.getElementById("pricingtable");
                var tbody = table.getElementsByTagName('tbody')[0];
                tbody.innerHTML = '';
                data.forEach(function(data, index) {
                    var row = tbody.insertRow();
                    row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>${data.code}</td>
                                <td class="button-container">
                                    <a href="/main-dashboard/pricing/${data.id}" class="circular-link">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openDeleteModal(reviewId) {
        var deleteModalId = '#deleteModal' + reviewId;
        $(deleteModalId).modal('show');
    }
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
            toastr.error(message);
            break;
    }
@endif
</script>

@endsection
