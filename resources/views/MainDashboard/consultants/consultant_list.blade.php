
@extends('MainDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<style>/* Customize the table's border color and row colors */

.error-message {
            font-size: 1.1rem;
            /* يمكنك تعديل حجم الخط حسب الحاجة */
            color: red;
            /* أو أي لون تفضله */
            /* أي خصائص أخرى تريدها */
        }
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
{{ trans('main_trans.consultant') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.consultant') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
               <h6><li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                        class="default-color">{{ trans('main_trans.Dashboard') }}</a></li></h6>
            <h6><li class="breadcrumb-item active">/{{ trans('main_trans.consultant') }}</li></h6>
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

                <div class="row mb-3"> <!-- إضافة مسافة تحتية للعنصر -->
                    <div class="col-md-6"> <!-- استخدام العمود لتحديد عرض العنصر -->
                        <button type="button" class="blue-button" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            <i class="fa-solid fa-plus"></i>  {{ trans('main_trans.create') }}
                        </button>
                    </div>
                </div>
                <table class="table table-bordered  w-100">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th scope="col">  {{ trans('main_trans.avatar') }}</th>
                            <th scope="col">  {{ trans('main_trans.user_name') }}</th>

                            <th scope="col">  {{ trans('main_trans.job_title') }}</th>
                            <th scope="col">  {{ trans('main_trans.email') }}</th>
                            <th scope="col">  {{ trans('main_trans.phone') }}</th>

                            <th scope="col">  {{ trans('main_trans.rate') }}</th>
                            <th scope="col">{{ trans('main_trans.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultants as $consultant)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <div class="ul-widget-app__profile-pic">

                                <img class="rounded-circle"
                                src="{{$consultant->image}}"
                                width="60"
                                height="60">
                            </div>
                        </td>
                            <td>{{ $consultant->name }}</td>
                            <td>{{ $consultant->job_title }}</td>
                            <td>{{ $consultant->email }}</td>
                            <td>{{ $consultant->phone_number }}</td>


                            <td>{{ $consultant->rate }}</td>
                            <td>
                                <a href="#editModal{{ $consultant->id }}"
                                    data-toggle="modal"> <i class="fas fa-pen-to-square fa-2xl" ></i></a>

                             <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{ $consultant->id }}')">     <i class="fa-solid fa-trash-can"></i></a>
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
<div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1"
aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.create') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>

        </div>
            <div class="modal-body">
                <form id="createUserForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ trans('main_trans.user_name') }}</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <span class="error-message" id="name-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="job_title">{{ trans('main_trans.job_title') }}</label>
                        <input type="text" class="form-control" id="job_title" name="job_title">
                        <span class="error-message" id="job_title-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('main_trans.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <span class="error-message" id="email-error"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">{{ trans('main_trans.phone') }}</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number">
                        <span class="error-message" id="phone_number-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="rate">{{ trans('main_trans.rate') }}</label>
                        <input type="number" class="form-control" id="rate" name="rate">
                        <span class="error-message" id="rate-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="image">{{ trans('main_trans.avatar') }}</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span class="error-message" id="image-error"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            {{ trans('main_trans.close') }}
                            </button>
                        <button type="button" class="btn btn-primary"
                            id="submitForm">{{ trans('main_trans.save') }}</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('submitForm').addEventListener('click', function() {
        var formData = new FormData();
        formData.append('name', document.getElementById('name').value);
        formData.append('job_title', document.getElementById('job_title').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('phone_number', document.getElementById('phone_number').value);
        formData.append('rate', document.getElementById('rate').value);
        formData.append('image', document.getElementById('image').files[0]);

        fetch('{{ route('consultant.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => Promise.reject(data));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                toastr.success('{{ trans('main_trans.adding') }}', 'Success', {timeOut: 5000});
                setTimeout(function() {
                    window.location.href = "{{ route('consultant.consultant') }}";
                }, 2000); // Wait for 2 seconds before redirecting
            }
        })
        .catch(error => {
                    console.error('Error:', error);
                    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                    if (error.errors) {
                        for (const field in error.errors) {
                            const errorMessage = error.errors[field][0];
                            document.getElementById(`${field}-error`).textContent = errorMessage;
                        }
                    } else {
                        alert('{{ trans('main_trans.error') }}');
                    }
                });
            });
        </script>

<!-- Edit User Modals -->
@foreach ($consultants as $consultant)
<div class="modal fade" id="editModal{{ $consultant->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $consultant->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $consultant->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('consultant.update', $consultant->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ trans('main_trans.user_name') }}</label>
                        <input type="text" class="form-control" id="name" name="name"  value="{{ $consultant->name }}">
                    </div>
                    <div class="form-group">
                        <label for="job_title">{{ trans('main_trans.job_title') }}</label>
                        <input type="text" class="form-control" id="job_title" name="job_title"  value="{{ $consultant->job_title }}">
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('main_trans.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email"  value="{{ $consultant->email }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">{{ trans('main_trans.phone') }}</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{ $consultant->phone_number }}">
                    </div>
                    <div class="form-group">
                        <label for="rate">{{ trans('main_trans.rate') }}</label>
                        <input type="number" class="form-control" id="rate" name="rate" value="{{ $consultant->rate }}">
                    </div>
                    <div class="form-group">
                        <label for="image">{{ trans('main_trans.avatar') }}</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ $consultant->image }}">
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

<div class="modal fade" id="deleteModal{{ $consultant->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel{{ $consultant->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $consultant->id }}"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('consultant.delete' ,$consultant->id) }}" method="POST" >
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
