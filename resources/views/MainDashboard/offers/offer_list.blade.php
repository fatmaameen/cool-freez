
@extends('MainDashboard.layouts.master')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
      body {
    overflow-x: hidden; /* لإخفاء شريط التمرير الأفقي فقط */
    overflow-y: auto; /* السماح بظهور شريط التمرير الرأسي عند الحاجة */
}
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
{{ trans('main_trans.offers') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.offers') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
               <h6><li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                        class="default-color">{{ trans('main_trans.Dashboard') }}</a></li></h6>
            <h6><li class="breadcrumb-item active">/{{ trans('main_trans.offers') }}</li></h6>
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
                            <th scope="col">  {{ trans('main_trans.offer_image') }}</th>
                            <th scope="col">  {{ trans('main_trans.offer_type') }}</th>
                            <th scope="col">  {{ trans('main_trans.offer_link') }}</th>
                            <th scope="col">{{ trans('main_trans.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offers as $offer)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>

                            <td>
                                <div class="ul-widget-app__profile-pic">

                                <img class="rounded-circle"
                                src="{{$offer->offer}}"
                                width="60"
                                height="60"
>
                            </div>
                        </td>
                        <td>{{ $offer->type }}</td>
                            <td>{{ $offer->link }}</td>
                            <td>
                                <a href="#editModal{{ $offer->id }}"
                                    data-toggle="modal">  <i class="fas fa-pen-to-square fa-2xl" ></i></a>

    <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{ $offer->id }}')"><i class="fa-solid fa-trash-can"></i></a>
</td>
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
<div class="modal fade" id="createUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{ trans('main_trans.create') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('offer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="offer">{{ trans('main_trans.offer_image') }}</label>
                        <input type="file" class="form-control" id="offer" name="offer">
                    </div>

                    <div class="form-group">
                        <label for="offer">{{ trans('main_trans.offer_link') }}</label>
                        <input type="url" class="form-control" id="link" name="link">
                    </div>

                    <div class="form-group">
                        <label for="offer">{{ trans('main_trans.offer_type') }}</label>
                        <select id="select" class="form-select form-select-sm" name="type" aria-label="Small select example">
                            <option value="Latest Offers">Latest Offers</option>
                            <option value="Limited Offers">Limited Offers</option>
                        </select>
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
@foreach ($offers as $offer)
<div class="modal fade" id="editModal{{ $offer->id }}" id="staticBackdrop" data-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel{{ $offer->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $offer->id }}">{{ trans('main_trans.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('offer.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="offer">{{ trans('main_trans.offer_image') }}</label>
                        <input type="file" class="form-control" id="offer" name="offer" value="{{ $offer->offer }}">
                    </div>

                    <div class="form-group">
                        <label for="offer">{{ trans('main_trans.offer_link') }}</label>
                        <input type="url" class="form-control" id="link" name="link" value="{{ $offer->link }}">
                    </div>

                    <div class="form-group">
                        <label for="offer">{{ trans('main_trans.offer_type') }}</label>
                        <select id="select" class="form-select form-select-sm" name="type" aria-label="Small select example">
                            @if ($offer->type == 'Latest Offers')
                            <option selected value="Latest Offers">Latest Offers</option>
                            @else
                            <option value="Latest Offers">Latest Offers</option>
                            @endif
                            @if ($offer->type == 'Limited Offers')
                            <option selected value="Limited Offers">Limited Offers</option>
                            @else
                            <option value="Limited Offers">Limited Offers</option>
                            @endif
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

<div class="modal fade" id="deleteModal{{ $offer->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel{{ $offer->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $offer->id }}"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('offer.delete' ,$offer->id) }}" method="POST" >
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
<!-- Edit User Modals -->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    const passwordInput = document.getElementById('password-input');
    const eyeIcon = document.getElementById('eye-icon');

    // Add event listener to toggle password visibility
    eyeIcon.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Change eye icon based on password visibility
        if (type === 'password') {
            eyeIcon.classList.remove('ri-eye-off-fill');
            eyeIcon.classList.add('ri-eye-fill');
        } else {
            eyeIcon.classList.remove('ri-eye-fill');
            eyeIcon.classList.add('ri-eye-off-fill');
        }
    });
</script>


<script>

    function openDeleteModal(maintenanceId) {
        var deleteModalId = '#deleteModal' + maintenanceId;
        $(deleteModalId).modal('show');
    }
</script>
<script>
    // Get the checkbox element
    var assignedCheckbox = document.getElementById('assignedCheckbox');
    // Add event listener to checkbox change
    assignedCheckbox.addEventListener('change', function() {
        // Get the hidden input element
        var assignedInput = document.querySelector('input[name="assigned"]');
        // Update the value based on checkbox state
        assignedInput.value = this.checked ? 1 : 0;
    });
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
