@extends('MainDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
<style>
    .circular-link {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        background-color: lightblue;
        color: rgb(17, 17, 17);
        text-align: center;
        text-decoration: none;
        margin-right: 40px;
    }

    .status {
        font-size: 20px;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .status-waiting {
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

    .status-icon {
        margin-right: 5px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
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
    {{ trans('main_trans.new_review') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main_trans.new_review') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                   <h6><li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                            class="default-color">{{ trans('main_trans.Dashboard') }}</a></li></h6>
                <h6><li class="breadcrumb-item active">/{{ trans('main_trans.new_review') }}</li></h6>
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
                                    placeholder="{{ trans('main_trans.search_code') }} ...">
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


                        <table class="table table-bordered  w-100" id="reviewsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">{{ trans('main_trans.code') }}</th>
                                    <th scope="col">{{ trans('main_trans.review_details') }}</th>
                                    <th scope="col">{{ trans('main_trans.admin_status') }}</th>
                                    <th scope="col">{{ trans('main_trans.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>

                                        <td>{{ $review->code }}</td>

                                        <td class="button-container">
                                            <a href="{{ route('details', $review->id) }}" class="circular-link">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>

                                      
                                        <td>
                                            @if ($review->admin_status == 'waiting')
                                            <span class="status status-waiting">
                                                <i class="status-icon fas fa-clock"></i>
                                                Waiting
                                            </span>
                                            @elseif ($review->admin_status == 'cancelled')
                                            <span class="status status-cancelled">
                                                <i class="status-icon fas fa-times-circle"></i>
                                                Cancelled
                                            </span>
                                            @elseif ($review->admin_status == 'confirmed')
                                            <span class="status status-confirmed">
                                                <i class="status-icon fas fa-check-circle"></i>
                                                Confirmed
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#editModal{{ $review->id }}" data-toggle="modal"><i
                                                    class="fas fa-pen-to-square fa-2xl"></i></a>


                                            <a href="#" class="btn btn-danger"
                                                onclick="openDeleteModal('{{ $review->id }}')">
                                                <i class="fa-solid fa-trash-can"></i></a>
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
    @foreach ($reviews as $review)
        <!-- Edit User Modals -->
        {{-- <div class="modal fade" id="exampleModal{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $review->id }}" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <!-- Modal content goes here -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{ $review->id }}">{{ trans('main_trans.client_data') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <table class="table">
                @php
                $client = App\Models\Client::where('id', $review->id)->first();
                 @endphp
                <thead>
                  <tr>
                    <th scope="col">{{ trans('main_trans.user_name') }}</th>
                    <th scope="col">{{ trans('main_trans.email') }}</th>
                    <th scope="col">{{ trans('main_trans.phone') }}</th>
                    <th scope="col">{{ trans('main_trans.address') }}</th>
                    <th scope="col">{{ trans('main_trans.avatar') }}</th>
                  </tr>
                </thead>
                <tbody>
                    <!-- Ensure that the client exists before trying to access its properties -->
                    @if ($review->client)
                    <tr>
                        <td>{{ $review->client->name }}</td>
                        <td>{{ $review->client->email }}</td>
                        <td>{{ $review->client->phone_number }}</td>
                        <td>{{ $review->client->address }}</td>
                        <td><img class="rounded-circle"
                            src="{{'http://127.0.0.1:8000/clients_images/'. $review->client->image}}"
                            width="60"
                            height="60"
                          ></td>
                    </tr>
                    @endif
                </tbody>
              </table>
        </div>
    </div>
</div>
</div> --}}


        <div class="modal fade" id="exampleModal{{ $review->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel{{ $review->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
                <div class="modal-content">
                    <!-- Modal content goes here -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{ $review->id }}">
                            {{ trans('main_trans.client_data') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            @php
                                $client = App\Models\Client::where('id', $review->id)->first();
                            @endphp
                            <thead>
                                <tr>
                                    <th scope="col">{{ trans('main_trans.user_name') }}</th>
                                    <th scope="col">{{ trans('main_trans.email') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>
                                    <th scope="col">{{ trans('main_trans.address') }}</th>
                                    <th scope="col">{{ trans('main_trans.avatar') }}</th>


                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ensure that the client exists before trying to access its properties -->
                                @if ($review->client)
                                    <tr>
                                        <td>{{ $review->client->name }}</td>
                                        <td>{{ $review->client->email }}</td>
                                        <td>{{ $review->client->phone_number }}</td>
                                        <td>{{ $review->client->address }}</td>
                                        <td><img class="rounded-circle" src="{{ $review->client->image }}" width="60"
                                                height="60"></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="consModal{{ $review->id }}" tabindex="-1" role="dialog"
            aria-labelledby="consModalLabel{{ $review->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <!-- Modal content goes here -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="consModalLabel{{ $review->id }}">
                            {{ trans('main_trans.consultant_data') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            @php
                                $consultant = App\Models\consultant::where('id', $review->id)->first();
                            @endphp
                            <thead>
                                <tr>
                                    <th scope="col">{{ trans('main_trans.job_title') }}</th>
                                    <th scope="col">{{ trans('main_trans.user_name') }}</th>
                                    <th scope="col">{{ trans('main_trans.email') }}</th>
                                    <th scope="col">{{ trans('main_trans.phone') }}</th>

                                    <th scope="col">{{ trans('main_trans.avatar') }}</th>
                                    <th scope="col">{{ trans('main_trans.rate') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ensure that the client exists before trying to access its properties -->
                                @if ($review->consultant)
                                    <tr>
                                        <td>{{ $review->consultant->job_title }}</td>
                                        <td>{{ $review->consultant->name }}</td>
                                        <td>{{ $review->consultant->email }}</td>
                                        <td>{{ $review->consultant->phone_number }}</td>

                                        <td><img class="rounded-circle" src="{{ $review->consultant->image }}"
                                                width="60" height="60"></td>
                                        <td>{{ $review->consultant->rate }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit User Modals -->
        <div class="modal fade" id="editModal{{ $review->id }}" id="staticBackdrop" data-backdrop="static"
            tabindex="-1" aria-labelledby="editModalLabel{{ $review->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $review->id }}">{{ trans('main_trans.edit') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
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
        <div class="modal fade" id="deleteModal{{ $review->id }}" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $review->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dleteModalLabel{{ $review->id }}">
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script> --}}


    {{-- <script>
   // Get the checkbox element
var assignedCheckbox = document.getElementById('assignedCheckbox');

// Add event listener to checkbox change
assignedCheckbox.addEventListener('change', function() {
    // Get the hidden input element
    var assignedInput = document.querySelector('input[name="is_banned"]');

    // Update the value based on checkbox state
    assignedInput.value = this.checked ? 1 : 0;

    // Get the form element
    var updateForm = document.getElementById('updateForm');

    // Submit the form
    updateForm.submit();
});

</script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openDeleteModal(reviewId) {
            var deleteModalId = '#deleteModal' + reviewId;
            $(deleteModalId).modal('show');
        }
    </script>
    <script>
        function searchOnKeyUp() {
            var input = document.getElementById("searchInput");
            var searchText = input.value.trim();
            if (searchText != '') {
                fetch('/main-dashboard/reviews/search/' + searchText)
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
                fetch('/main-dashboard/reviews/search/null')
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
            var table = document.getElementById("reviewsTable");
            var tbody = table.getElementsByTagName('tbody')[0];
            tbody.innerHTML = '';
            data.forEach(function(review, index) {
                var row = tbody.insertRow();
                row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${review.code}</td>
                            <td class="button-container">
                                <a href="/main-dashboard/reviews/${review.id}" class="circular-link">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                            <td>${review.admin_status}</td>
                            <td>
                            <a href="#editModal${review.id}"
                                data-toggle="modal"><i class="fas fa-pen-to-square fa-2xl"></i></a>
                       <a href="#" class="btn btn-danger"
                       onclick="openDeleteModal('${review.id}')">
                       <i class="fa-solid fa-trash-can"></i></a>
                       </td>
                        `;
            });
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
            toastr.error(message); // هنا قمنا بتغيير اللون إلى الأحمر في حالة الخطأ
            var audio = new Audio('audio.mp3');
            audio.play();
            break;
    }
@endif

</script>
@endsection
